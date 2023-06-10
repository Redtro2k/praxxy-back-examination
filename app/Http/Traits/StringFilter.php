<?php 
namespace App\Http\Traits;

trait StringFilter{
    function excerpText($text, $limit){
        $get_text = strip_tags($text);
        $length = strlen($get_text);
        if($length > $limit){
            $get_text = mb_substr($get_text, 0, $limit - 3) . '...';
        }
        return $get_text;
    }
    function UpperFirstCharacter($text){
        $arr = explode("_", $text);
        foreach($arr as &$element){
            $element = ucfirst($element);
        }
        return implode(" ", $arr);
    }
}