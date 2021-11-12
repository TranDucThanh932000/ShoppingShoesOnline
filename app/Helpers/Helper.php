<?php

use App\Models\Setting;

function getConfigValueFromSetting($key){
    $setting = Setting::where('config_key',$key)->first();
    if(!empty($setting)){
        return $setting->config_value;
    }
    return null;
}