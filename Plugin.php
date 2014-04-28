<?php namespace Radiantweb\Findus;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'Findus',
            'description' => 'Add a Find Us Google Map to your Page.',
            'author'      => '://radiantweb',
            'icon'        => 'icon-map-marker'
        ];
    }

    public function registerComponents()
    {
        return [
            'Radiantweb\Findus\Components\Findus' => 'findus',
        ];
    }

    /*
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Findus',
                'description' => 'Manage Findus Settings.',
                'icon'        => 'icon-map-marker',
                'class'       => 'Radiantweb\Findus\Models\Settings',
                'order'       => 100
            ]
        ];
    }
    */
}