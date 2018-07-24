<?php

namespace App\Http\ViewComposers;
use App\Event;
use App\SiteMeta;
use Illuminate\Contracts\View\View;

class BackendMasterComposer
{
    public function compose(View $view)
    {

        $siteInfo = [
            'name' => '',
            'logo' => '',
            'logo2x' => '',
            'favicon' => '',
            'facebook' => '',
            'google' => '',
            'twitter' => '',
            'youtube' => '',
        ];
        $settings = SiteMeta::where('meta_key','settings')->first();
        $info = null;
        if($settings){
            $info = json_decode($settings->meta_value);
            $siteInfo['name'] = $info->name;
            $siteInfo['logo'] = $info->logo;
            $siteInfo['logo2x'] = $info->logo2x;
            $siteInfo['favicon'] = $info->favicon;
            $siteInfo['facebook'] = $info->facebook;
            $siteInfo['google'] = $info->google;
            $siteInfo['twitter'] = $info->twitter;
            $siteInfo['youtube'] = $info->youtube;
        }


        /**
         * Acronyms generator of a phrase
         */
         $siteInfo['short_name'] = preg_replace('~\b(\w)|.~', '$1', $siteInfo['name']);


        $view->with('maintainer', 'ShanixLab');
        $view->with('maintainer_url', 'http://shanixlab.com');
        $view->with('siteInfo', $siteInfo);
    }
}