<?php

namespace Frenzycode\Ems\Libraries;

use URL;
use ReflectionObject;
use Request;
use Frenzycode\Ems\ViewModels\General\MenuItem;
use Frenzycode\Ems\Config\MenuConfig;
class FrenzyHelper {

    public static function arrayToObject($array, $class) {
        $object = new $class;
        foreach ($array as $key => $value) {
            $object->$key = $value;
        }
        return $object;
    }

    public static function cast($destination, $sourceObject) {
        if (is_string($destination)) {
            $destination = new $destination();
        }
        $sourceReflection = new ReflectionObject($sourceObject);
        $destinationReflection = new ReflectionObject($destination);
        $sourceProperties = $sourceReflection->getProperties();
        foreach ($sourceProperties as $sourceProperty) {
            $sourceProperty->setAccessible(true);
            $name = $sourceProperty->getName();
            $value = $sourceProperty->getValue($sourceObject);
            if ($destinationReflection->hasProperty($name)) {
                $propDest = $destinationReflection->getProperty($name);
                $propDest->setAccessible(true);
                $propDest->setValue($destination, $value);
            } else {
                $destination->$name = $value;
            }
        }
        return $destination;
    }

    public static function getValueFromArray($index, $array, $default = '') {
        if ($array == null || !is_array($array)) {
            return $default;
        }

        if (array_key_exists($index, $array)) {
            return $array[$index];
        }
        return $default;
    }

    public static function generateMenu($menus) {
        if ($menus == null || !is_array($menus)) {
            return '';
        }

        $output = '';
        foreach ($menus as $index => $menu) {
            $liclass = '';
            if ($index == 0) {
                $liclass = 'start ';
            }

            if ($menu->isActive) {
                $liclass .= ' active';
            }
            $itag = ($menu->icon == '') ? '' : 'class="' . $menu->icon . '"';

            $hasSubItem = count($menu->children) > 0;
            $href = $hasSubItem ? 'javascript;;' : URL::to($menu->link);

            $subMenu = $hasSubItem ? sprintf('<ul class="sub-menu">%s</ul>', self::generateMenu($menu->children)) : '';

            if ($hasSubItem) {
                $arrowtag = $menu->isActive ? '<span class="arrow open"></span>' : '<span class="arrow"></span>';
            } else {
                $arrowtag = '';
            }

            $title = sprintf('<li class="%s"><a href="%s"><i %s></i> <span class="title">%s</span>%s</a>%s</li>', $liclass, $href, $itag, $menu->title, $arrowtag, $subMenu);
            $output .= $title;
        }
        return $output;
    }
    
    public static function addMenuItem(&$parent, $children, $activePath) {
        foreach ($children as $menu) {
            $subItem = $parent->addMenuItem(new MenuItem($menu));
            if ($subItem->link == $activePath) {
                $subItem->setActive(true);
            }
            if (array_key_exists('children', $menu)) {
                self::addMenuItem($subItem, $menu['children'], $activePath);
            }
        }
    }
    
    
    public static function getActivePath() {
        $paths = Request::segments();
        return implode('/', array_slice($paths, 0, MenuConfig::$activeLevel));
    }

}
