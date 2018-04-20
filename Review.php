<?php

namespace Modules\NomadiCore;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    const HIDDEN_STATUS = -10;

    const CREATED_STATUS = 0;

    function user()
    {
        return $this->belongsTo('App\User');
    }

    function entity()
    {
        return $this->belongsTo('App\Entity');
    }

    function getValue($fieldName)
    {
        $arr = json_decode($this->review_fields, true);

        if ($arr === null) return 0;

        if (array_key_exists($fieldName, $arr)) return $arr[$fieldName];

        return 0;
    }

    function presentSummary()
    {
        $text = '';

        foreach (config('review-fields') as $field) {
            $text .= $field['label'] . ' ' . number_format($this->getValue($field['key']), 1) . '★ / ';
        }

        return substr($text, 0, -2);

        if ($this->wifi != 0) $text .= 'wifi ' . $this->wifi . ' ★ / ';

        $text .= '有位 ' . $this->seat . ' ★ / ';

        $text .= '安靜 ' . $this->quiet . ' ★ / ';

        $text .= '好喝 ' . $this->tasty . ' ★ / ';

        if ($this->food != 0) $text .= '好吃 ' . $this->food . ' ★ / ';

        $text .= '便宜 ' . $this->cheap . ' ★ / ';

        $text .= '裝潢音樂 ' . $this->music . ' ★';

        return $text;
    }

    function presentRichSummary()
    {
        return view( 'partial/_review-summary', [ 'review' => $this ] );
    }

    function presentRichSummarySmall()
    {
        return view( 'partial/_review-summary-small', [ 'review' => $this ] );
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

    function checkin()
    {
        $rec = Recommendation::where('cafe_id', $this->cafe_id)
            ->where('user_id', $this->user_id)
            ->first();

        if (!$rec) {
            if ($this->user_id != 0) {
                $rec = new Recommendation();
                $rec->cafe_id = $this->cafe_id;
                $rec->user_id = $this->user_id;
                $rec->save();
            }
        }
    }
}
