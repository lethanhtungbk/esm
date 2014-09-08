<?php

namespace Frenzycode\Ems\ViewModels\General;

use Frenzycode\Ems\Libraries\FrenzyHelper;

class MenuItem {

    public $link;
    public $icon;
    public $title;
    public $children = array();
    public $isActive = false;
    public $parent = null;

    function __construct($array = null) {
        $this->title = FrenzyHelper::getValueFromArray('title', $array,'');
        $this->icon = FrenzyHelper::getValueFromArray('icon', $array,'');
        $this->link = FrenzyHelper::getValueFromArray('link', $array,'');
    }

    public function addMenuItem($menuItem) {
        array_push($this->children, $menuItem);
        $menuItem->parent = $this;
        return $menuItem;
    }

    public function setActive($isActive) {
        $this->isActive = $isActive;
        $parent = $this->parent;
        if ($parent != null) {
            $parent->setActive($isActive);
        }
    }
}
