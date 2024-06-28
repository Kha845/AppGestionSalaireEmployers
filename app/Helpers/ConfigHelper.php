<?php

namespace App\Helpers;

use App\Models\configurations;

class ConfigHelper{


public static function  getNameApp()
{
   $appName = configurations::where('type','APP_NAME')->value('value');

   return $appName;

}

}


