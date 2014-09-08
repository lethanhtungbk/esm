<?php
namespace Frenzycode\Ems\Config;
class MenuConfig {
    public static $menuData = array(
        array('icon' => 'icon-home', 'title' => 'Dashboard', 'link' => '/'),
        array('icon' => 'icon-settings', 'title' => 'Setting', 'link' => 'setting', 'children' => array(
                array('title' => 'Group', 'link' => 'setting/groups'),
                array('title' => 'Field', 'link' => 'setting/fields'),
            )),
    );
    
    public static $activeLevel = 2;
}
