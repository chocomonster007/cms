<?php

namespace App\HTML;

class Form{
    public static function input(string $name,string $label,bool $required, string $value=''){
        $oui = $required === true ? ' required' : '';
        $type = str_starts_with($name,'password')  ? 'password' : 'text';
        return "<label for='$name'>$label</label>
        <input type='$type' id='$name' value='$value' name='$name'$oui>";
    }
}