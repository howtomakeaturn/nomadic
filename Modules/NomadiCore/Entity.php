<?php

namespace Modules\NomadiCore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Config;
use Modules\NomadiCore\Cafe\Presenter;
use Modules\NomadiCore\Cafe\Api;
use Modules\NomadiCore\Facebook\FanPage;
use Modules\NomadiCore\BusinessHour;
use Laravel\Scout\Searchable;

class Entity extends Model
{
    //use Searchable;

    public $incrementing = false;
    protected $needsIndexing = true;
    protected $attributesForIndex = [
        'id',
        'name',
        'city',
        'area',
        'mrt',
        'address'
    ];

    const ISSUE_STATUS = -60;

    const OTHER_TYPE_STATUS = -50;

    const RESTAURANT_TYPE_STATUS = -40;

    const DUPLICATE_STATUS = -30;

    const CLOSED_STATUS = -20;

    const HIDDEN_STATUS = -10;

    const CREATED_STATUS = 0;

    const APPROVED_STATUS = 10;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'has_wifi' => 'boolean',
        'has_single_origin' => 'boolean',
        'has_dessert' => 'boolean',
        'has_meal' => 'boolean',
        'wifi' => 'float',
        'seat' => 'float',
        'quiet' => 'float',
        'tasty' => 'float',
        'food' => 'float',
        'cheap' => 'float',
        'music' => 'float',
        'opening_date' => 'date',
        'is_starred' => 'boolean',
        'is_donated' => 'boolean',
        'recommendation_count' => 'integer',
    ];

    public function searchable()
    {
        if ($this->needsIndexing && $this->status == Cafe::APPROVED_STATUS)
        {
            Collection::make([$this])->searchable();
        }
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();
        return array_only($array, $this->attributesForIndex);
    }

    protected $presenterInstance;

	public function present()
	{
		if ( ! $this->presenterInstance)
		{
			$this->presenterInstance = new Presenter($this);
		}

		return $this->presenterInstance;
	}

    protected $apiInstance;

    public function api()
	{
		if ( ! $this->apiInstance)
		{
			$this->apiInstance = new Api($this);
		}

		return $this->apiInstance;
	}

    public function save(array $options = [])
    {
        if ($this->exists)
        {
            $this->needsIndexing = collect($this->attributesForIndex)->contains(function ($attribute, $index) {
                return $this->isDirty($attribute);
            });
        }
        return parent::save();
    }

    function presentCity()
    {
        $city = $this->city;

        return Config::get("city.$city.zh");
    }

    function fan_page()
    {
        return $this->hasOne('Modules\NomadiCore\Facebook\FanPage');
    }

    function place_detail()
    {
        return $this->hasOne('Modules\NomadiCore\GooglePlaceDetail');
    }

    function recommendations()
    {
        return $this->hasMany('Modules\NomadiCore\Recommendation');
    }

    function reviews()
    {
        return $this->hasMany('Modules\NomadiCore\Review');
    }

    function comments()
    {
        return $this->hasMany('Modules\NomadiCore\Comment');
    }

    function wishes()
    {
        return $this->hasMany('Modules\NomadiCore\Wish');
    }

    function photos()
    {
        return $this->hasMany('Modules\NomadiCore\Photo');
    }

    public function tags()
    {
        return $this->belongsToMany('Modules\NomadiCore\Tag');
    }

    function business_hours()
    {
        return $this->hasMany('Modules\NomadiCore\BusinessHour');
    }

    function donations()
    {
        return $this->hasMany('Modules\NomadiCore\Donation');
    }

    function uniqueTags()
    {
        $tags = collect([]);

        foreach ($this->tags as $rawTag) {
            foreach ($tags as $tag) {
                if ($tag->id === $rawTag->id) continue 2;
            }

            $tags->push($rawTag);
        }

        return $tags;
    }

    function validPhotos()
    {
        return $this->photos->filter(function($r){
            return $r->status >= 0;
        });
    }

    function validReviews()
    {
        return $this->reviews->filter(function($r){
            return $r->status >= 0;
        });
    }

    function getReviewFieldValue($fieldName)
    {
        $arr = json_decode($this->review_fields, true);

        if ($arr === null) return 0;

        if (array_key_exists($fieldName, $arr)) return $arr[$fieldName];

        return 0;
    }

    function getInfoFieldValue($fieldName)
    {
        $arr = json_decode($this->info_fields, true);

        if ($arr === null) return '';

        if (array_key_exists($fieldName, $arr)) return $arr[$fieldName];

        return '';
    }

    function presentWifi()
    {
        if ($this->has_wifi === false) {
            return 'No wifi';
        } else {
            return $this->presentStar('wifi');
        }
    }

    function presentWifiMobile()
    {
        if ($this->has_wifi === false) {
            return 'No';
        } else {
            return extractRate($this->wifi);
        }
    }

    function presentWifiClass()
    {
        if ($this->has_wifi === false) {
            return 'yellow';
        } else {
            return starClass($this->wifi);
        }
    }

    function presentStar($field)
    {
        $value = $this->$field;

        if ( is_numeric($value) ) {
            if ($value == 0) return '';

            $result = number_format( (float) $value, 1, '.', '' );

            $result .= ' ★';

            return $result;
        } else {
            return $value;
        }
    }

    function summaryScore()
    {
        $sum = 0;

        $sum += extractScore($this->wifi);
        $sum += extractScore($this->seat);
        $sum += extractScore($this->quiet);
        $sum += extractScore($this->tasty);
        $sum += extractScore($this->music);
        $sum += extractScore($this->cheap);

        return $sum;
    }

    function isGoodForWorking()
    {
        if ($this->seat >= 3 && $this->quiet >= 3 && $this->recommendation_count >= 3) return true;

        return false;
    }


    function quickParsePage()
    {
        if (strpos($this->url, 'facebook') !== false) {
            if (count(explode('/', $this->url)) < 4) return 'cannot read the format';

            $id = explode('/', $this->url)[3];

            if ($id === 'pg') $id = explode('/', $this->url)[4];

            if (strpos($id, '-') !== false) $id = substr($id, strrpos($id, '-') + 1);

            if (FanPage::find($id)) return 'ALREADY EXIST';

            $page = new FanPage();

            $page->cafe_id = $this->id;

            $page->id = $id;

            $page->save();

            return $id;
        } else {
            return 'THIS IS NOT A FACEBOOK URL';
        }
    }

    function createBusinessHours($json)
    {
        BusinessHour::where('cafe_id', $this->id)->delete();

        $data = json_decode($json, true);

        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        foreach ($days as $index => $day) {
            $businessHour = new BusinessHour();

            $businessHour->cafe_id = $this->id;

            $businessHour->day = $index + 1;

            if ($data[$days[$index]]['open'] === null) {
                $businessHour->open_time = null;

                $businessHour->close_time = null;
            } else {
                $businessHour->open_time = $data[$days[$index]]['open'];

                $businessHour->close_time = $data[$days[$index]]['close'];
            }

            $businessHour->save();
        }
    }

    function generateBusinessHoursJson()
    {
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        $data = [];

        foreach ($days as $day) {
            $data[$day] = [
                'open' => null,
                'close' => null
            ];
        }

        foreach ($this->business_hours->sortByDesc('day') as $index => $business_hour) {
            if ($business_hour->open_time == null) {
                $data[$days[$index]]['open'] = null;
                $data[$days[$index]]['close'] = null;
            } else {
                $data[$days[$index]]['open'] = $business_hour->open_time->format('H:i');
                $data[$days[$index]]['close'] = $business_hour->close_time->format('H:i');
            }
        }

        return json_encode($data);
    }

    function getBusinessHoursJson()
    {
        if ($this->business_hours_json === '') {
            $this->business_hours_json = $this->generateBusinessHoursJson();

            $this->save();

            return $this->business_hours_json;
        } else {
            return $this->business_hours_json;
        }
    }

    function importFromFb($hours)
    {
        $map = [
            '1' => 'mon',
            '2' => 'tue',
            '3' => 'wed',
            '4' => 'thu',
            '5' => 'fri',
            '6' => 'sat',
            '7' => 'sun',
        ];

        foreach ($this->business_hours as $businessHour) {
            if (array_key_exists($map[$businessHour->day] . '_1_open', $hours)) {
                $open_time = $hours[$map[$businessHour->day] . '_1_open'];
                $close_time = $hours[$map[$businessHour->day] . '_1_close'];
            } else {
                $open_time = null;
                $close_time = null;
            }

            \Modules\NomadiCore\BusinessHour::where('cafe_id', $this->id)->where('day', $businessHour->day)->update([
                'open_time' => $open_time,
                'close_time' => $close_time
            ]);
        }
    }

    function getAnyImages($number)
    {
        $images = collect([]);

        foreach ($this->validPhotos()->shuffle()->take($number) as $photo) {
            $images->push([
                'width' => $photo->width,
                'height' => $photo->height,
                'src' => '/upload_photos/width-300/' . $photo->name
            ]);
        }

        if ($this->place_detail && $this->place_detail->response && array_key_exists('photos', $this->place_detail->response['result'])) {
            foreach ($this->place_detail->response['result']['photos'] as $index => $photo) {
                if ($images->count() == $number) break;

                $images->push([
                    'width' => $photo['width'],
                    'height' => $photo['height'],
                    'src' => generate_photo_url($photo['photo_reference'], 1000, 300)
                ]);
            }
        }

        for ($i = $images->count(); $i < $number; $i ++) {
            $images->push([
                'width' => 192,
                'height' => 192,
                'src' => '/android-chrome-192x192.png'
            ]);
        }

        return $images;
    }

    function isVeryGoodFromDatabase()
    {
        if ($this->validReviews()->count() < 5) {
            return false;
        }

        return $this->summaryScore() >= 27 ? true : false;

        $fields = ['wifi', 'seat', 'quiet', 'tasty', 'cheap', 'music'];

        $perfectFieldsNum = 0;

        foreach ($fields as $field) {
            if ($this->$field < 4) return false;
            if ($this->$field == 5) $perfectFieldsNum += 1;
        }

        if ($perfectFieldsNum < 3) return false;

        return true;
    }

    function isVeryGoodFromWeb()
    {
        if (!$this->fan_page) return false;

        if ($this->fan_page->overall_star_rating < 4.5) return false;

        if (!$this->place_detail) return false;

        if ($this->place_detail->rating < 4.5) return false;

        return true;
    }

    function isStarred()
    {
        return $this->isVeryGoodFromDatabase() && $this->isVeryGoodFromWeb();
    }

}
