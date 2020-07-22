<?php
namespace Core\myvendor\defaults\os;

class Slash 
{

    public static function GetOsSlash(){
        
        // if windows return "\\" if linux  return "/";
        return "/";
    }
}
