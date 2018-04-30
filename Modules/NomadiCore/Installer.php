<?php

namespace Modules\NomadiCore;

class Installer
{
    function checkInfoFieldsSetting()
    {
        $keys = [];

        foreach (config('info-fields') as $field) {
            $keys[] = $field['key'];
        }

        if (count($keys) !== count(array_unique($keys))) dd('Config error: Duplicated info fields key exist.');

        foreach (config('info-fields') as $field) {
            if (!in_array($field['type'], ['input_text', 'select', 'input_radio'])) dd('Config error: Invalid info field type: ' . $field['type']);
        }
    }
}
