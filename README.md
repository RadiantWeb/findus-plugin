findus-plugin
===========

A simple map/directions component for October CMS.
```php
      $$\  $$\    $$$$$$$\                  $$\ $$\                      $$\     $$\      $$\           $$\       
     $$  |$$  |   $$  __$$\                 $$ |\__|                     $$ |    $$ | $\  $$ |          $$ |      
    $$  /$$  /$$\ $$ |  $$ | $$$$$$\   $$$$$$$ |$$\  $$$$$$\  $$$$$$$\ $$$$$$\   $$ |$$$\ $$ | $$$$$$\  $$$$$$$\  
   $$  /$$  / \__|$$$$$$$  | \____$$\ $$  __$$ |$$ | \____$$\ $$  __$$\\_$$  _|  $$ $$ $$\$$ |$$  __$$\ $$  __$$\ 
  $$  /$$  /      $$  __$$<  $$$$$$$ |$$ /  $$ |$$ | $$$$$$$ |$$ |  $$ | $$ |    $$$$  _$$$$ |$$$$$$$$ |$$ |  $$ |
 $$  /$$  /   $$\ $$ |  $$ |$$  __$$ |$$ |  $$ |$$ |$$  __$$ |$$ |  $$ | $$ |$$\ $$$  / \$$$ |$$   ____|$$ |  $$ |
$$  /$$  /    \__|$$ |  $$ |\$$$$$$$ |\$$$$$$$ |$$ |\$$$$$$$ |$$ |  $$ | \$$$$  |$$  /   \$$ |\$$$$$$$\ $$$$$$$  |
\__/ \__/         \__|  \__| \_______| \_______|\__| \_______|\__|  \__|  \____/ \__/     \__| \_______|\_______/ 
```

## Displaying Maps On your Pages

The plugin includes the Findus component that can display mpas on your pages. Add the component to your page and render it with the component tag:

```php
{% component 'findus' %}
```

There are several Component Settings you will want check when adding the Findus Component:

* **location_title** - The title of your location.
* **address** - The address of your location.
* **template** - The view template to use.
   - link_only
   - map_only
   - map_info_right
   - info_small_map
* **color** - The Color Hue of your Map
   - none
   - red
   - blue
   - green
   - yellow
   - purple
   - grey
   - black
   - brown