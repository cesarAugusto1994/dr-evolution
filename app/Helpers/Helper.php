<?php

namespace App\Helpers;

/**
 *
 */
class Helper
{
    public static function config($slug)
    {
        $config = \App\Models\Config::where('slug', $slug)->get();

        if($config->isEmpty()) {
          return false;
        }

        return $config->first()->valor;
    }
}
