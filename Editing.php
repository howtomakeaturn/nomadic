<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Editing\Presenter;

class Editing extends Model
{
    const PENDING_STATUS = -20;

    const HIDDEN_STATUS = -10;

    const CREATED_STATUS = 0;

    const APPROVED_STATUS = 10;

    protected $casts = [
        'has_wifi' => 'boolean',
        'has_single_origin' => 'boolean',
        'has_dessert' => 'boolean',
        'has_meal' => 'boolean',
    ];

    protected $presenterInstance;

	public function present()
	{
		if ( ! $this->presenterInstance)
		{
			$this->presenterInstance = new Presenter($this);
		}

		return $this->presenterInstance;
	}

    function entity()
    {
        return $this->belongsTo('App\Entity');
    }

    function user()
    {
        return $this->belongsTo('App\User');
    }

    function isChanged($field)
    {
        if ($this->$field === $this->cafe->$field) return false;

        return true;
    }

    static function makeNewDiff($cafe, $params)
    {
        $editing = new self();

        $stringFields = [
            'name', 'url', 'limited_time', 'socket', 'standing_desk', 'business_type',
            'open_time', 'mrt', 'address', 'latitude', 'longitude'
        ];

        $booleanFields = ['has_wifi', 'has_single_origin', 'has_dessert', 'has_meal'];

        $fields = array_merge($stringFields, $booleanFields);

        foreach ($params as $key => $value) {
            if (in_array($key, $fields)) {
                if ($cafe->$key !== $params[$key]) {
                    $editing->$key = $value;
                }
            }
        }

        if (array_key_exists('business_hours', $params) && $params['business_hours'] !== $cafe->generateBusinessHoursJson()) {
            $editing->business_hours = $params['business_hours'];
        }

        $editing->save();

        return $editing;
    }

    function getValue($fieldName)
    {
        $arr = json_decode($this->info_fields, true);

        if ($arr === null) return '';

        if (array_key_exists($fieldName, $arr)) return $arr[$fieldName];

        return '';
    }

    function approve()
    {
        $this->status = Editing::APPROVED_STATUS;

        $this->save();

        $arr = json_decode($this->entity->info_fields, true);

        foreach (getInfoKeys() as $field) {
            if ($this->getValue($field) !== '') $arr[$field] = $this->getValue($field);
        }

        $this->entity->name = $this->name;

        $this->entity->info_fields = json_encode($arr);

        $this->entity->address = $this->address;

        setupEntityCoordinate($this->entity);

        $this->entity->save();
    }

}
