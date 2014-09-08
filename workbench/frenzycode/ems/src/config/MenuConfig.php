<?php
namespace Frenzycode\Ems\Config;
class MenuConfig {
    public static $menuData = array(
        array('icon' => 'icon-home', 'title' => 'Dashboard', 'link' => '/'),
        array('icon' => 'icon-home', 'title' => 'Setting', 'link' => 'setting', 'children' => array(
                array('icon' => 'icon-home', 'title' => 'Fields', 'link' => 'setting/fields'),
                array('icon' => 'icon-home', 'title' => 'Groups', 'link' => 'setting/groups'),
            )),
    );
    
    public static $activeLevel = 2;
}
