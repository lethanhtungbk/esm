<?php

namespace Frenzycode\Ems\Config;

class MenuConfig {

    public static $menuData = array(
        array('icon' => 'icon-home', 'title' => 'Dashboard', 'link' => '/'),
        array('icon' => 'icon-lock-open', 'title' => 'Admin', 'link' => 'admin'),
        array('icon' => 'icon-settings', 'title' => 'Setting', 'link' => 'setting', 'children' => array(
                array('title' => 'Group', 'link' => 'setting/groups', 'icon' => 'icon-grid'),
                array('title' => 'Field', 'link' => 'setting/fields', 'icon' => 'icon-puzzle'),
            )),
    );
    public static $activeLevel = 2;

}
