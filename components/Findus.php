<?php namespace Radiantweb\Findus\Components;

use Cms\Classes\ComponentBase;
use Request;
use Cache;

class Findus extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'Findus',
            'description' => 'Displays a simple map & or directions link on your page.'
        ];
    }

    public function defineProperties()
    {
        return [
            'location_title' => [
                'description' => 'Title of Location',
                'title'       => 'Location Title',
                'default'     => '',
                'type'        => 'string'
            ],
            'address' => [
                'description' => 'Your location address',
                'title'       => 'Address',
                'default'     => '',
                'type'        => 'string'
            ],
            'template' => [
                'description' => 'Type of map/link to use',
                'title'       => 'Map Style',
                'default'     => 'map_only',
                'type'        => 'dropdown',
                'options'     => ['map_only'=>'Large Map','popup'=>'Popup','info_small_map'=>'Small Map']
            ],
            'color' => [
                'description' => 'Color Hue',
                'title'       => 'Color Hue',
                'default'     => 'none',
                'type'        => 'dropdown',
                'options'     => ['black'=>'black','red'=>'red','blue'=>'blue','green'=>'green','yellow'=>'yellow','purple'=>'purple','brown'=>'brown','grey'=>'grey']
            ]
        ];
    }

    public function onRun(){

        $this->addCss('/plugins/radiantweb/findus/assets/css/findus.css');
        $this->addJs('/modules/backend/assets/js/vendor/jquery-2.0.3.min.js');

        $this->addCss('/plugins/radiantweb/findus/assets/fancybox/jquery.fancybox.css');
        $this->addJs('/plugins/radiantweb/findus/assets/fancybox/jquery.fancybox.pack.js');

        $this->page['map_template'] = $this->property('template'); 

        //Cache::forget('findus_latlon_'.$this->id);
        $findus_latlon = Cache::get('findus_latlon_'.$this->id);
        $findus_address = Cache::get('findus_address_'.$this->id);
        $findus_formatted_address = Cache::get('findus_formatted_address_'.$this->id);
        if(!$findus_latlon || $findus_address != $this->property('address')){
            $coords = $this->getGeoCode($this->property('address'));
            $findus_latlon = $coords['lat'].','.$coords['lon'];
            $findus_formatted_address = $coords['formatted'];
            Cache::forever('findus_latlon_'.$this->id,$findus_latlon);
            Cache::forever('findus_address_'.$this->id,$this->property('address'));
            Cache::forever('findus_formatted_address_'.$this->id,$coords['formatted']);
        }
        $coords = explode(',',$findus_latlon);
        $this->page['address'] = $this->property('address'); 

        $this->page['location_title'] = $this->property('location_title');

        $address_array = explode(',',$findus_formatted_address);
        $this->page['address1'] = $address_array[0]; 
        $this->page['city'] = $address_array[1]; 
        $this->page['state_zip'] = $address_array[2]; 

        $colors = array(
            'none'=>'',
            'black'=>'black',
            'red'=>'#ff0000',
            'blue'=>'#0077ff',
            'green'=>'#22ff00',
            'yellow'=>'#ffc300',
            'purple'=>'#aa00ff',
            'brown'=>'#ff6e00',
            'grey'=>'grey'
        );

        $this->page['color'] = $colors[strtolower($this->property('color'))]; 
        $this->page['lat'] = $coords[0]; 
        $this->page['lon'] = $coords[1]; 
    }

    private function getGeoCode($address){
        //build url
        $base_url = "http://maps.google.com/maps/api/geocode/json?sensor=false";
        $request_url = $base_url . "&address=".urlencode($address);

        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $request_url,
            CURLOPT_USERAGENT => 'October CMS Site'
        ));
        // Send the request & save response to $resp
        $reslt = curl_exec($curl);

        $res = json_decode($reslt);

        switch($res->status) {
            case 'OK':
                $lat = $res->results[0]->geometry->location->lat;
                $lng = $res->results[0]->geometry->location->lng;
                //var_dump($address_array);exit;
                return array('lat'=>$lat,'lon'=>$lng,'formatted'=>$res->results[0]->formatted_address);
                break;
        }

        // Close request to clear up some resources
        curl_close($curl);
    }
}