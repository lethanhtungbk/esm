<?php

namespace Frenzycode\Ems\ViewModels\Page;
use URL;

class PageHead {

    public $title;
    public $customMetas = array();
    public $customStyles = array();

    public function addMeta($meta) {
        array_push($this->customMetas, $meta);
    }

    public function addStyle($style) {
        $style = URL::asset($style);
        if (!in_array($style, $this->customStyles))
        {
            array_push($this->customStyles, $style);
        }
    }

}
