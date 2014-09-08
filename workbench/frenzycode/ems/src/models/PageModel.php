<?php

namespace Frenzycode\Ems\Models;

use Frenzycode\Ems\ViewModels\Page\PageData;
use Frenzycode\Ems\ViewModels\General\MenuItem;
use Frenzycode\Ems\Config\PageFactory;
use Frenzycode\Ems\Config\MenuConfig;
use View;
use Frenzycode\Ems\Libraries\FrenzyHelper;

class PageModel {

    private $pageData;
    private $pageType;

    private function createMenu() {
        FrenzyHelper::addMenuItem($this->pageData->body, MenuConfig::$menuData, FrenzyHelper::getActivePath());
        $groups = Group::getGroups();
        foreach ($groups as $group) {
            $this->pageData->body->addMenuItem(new MenuItem(array('title' => $group->name, 'link' => 'entities/' . $group->link, 'icon' => $group->icon)));
        }
    }

    private function createBreadcrumbs() {
//        if (array_key_exists($this->pageType, $this->breadcrumbs)) {
//            foreach ($this->breadcrumbs[$this->pageType] as $b) {
//                if (array_key_exists($b, $this->breadcrumbsData)) {
//                    $this->pageData->body->addBreadcrumbItem(new BreadcrumbItem($this->breadcrumbsData[$b]));
//                }
//            }
//        }
    }

    private function addAngularJS() {
        foreach (PageFactory::$angularGeneral as $script) {
            $this->pageData->addScript($script);
        }

        foreach (PageFactory::$angularScripts[$this->pageType] as $script) {
            $this->pageData->addScript($script);
        }
    }

    private function addStyle() {
        if (array_key_exists($this->pageType, PageFactory::$styles)) {
            foreach (PageFactory::$styles[$this->pageType] as $style) {
                $this->pageData->addStyle($style);
            }
        }
    }

    private function addScript() {
        if (array_key_exists($this->pageType, PageFactory::$scripts)) {
            foreach (PageFactory::$scripts[$this->pageType] as $script) {
                $this->pageData->addScript($script);
            }
        }
    }

    private function addInitScript() {
        if (array_key_exists($this->pageType, PageFactory::$initScripts)) {
            $this->pageData->addInitScript(PageFactory::$initScripts[$this->pageType]);
        }
    }

    private function createBodyTemplate($data = null) {
        $this->pageData->body->template = PageFactory::$templates[$this->pageType];
        $this->pageData->body->templateData = $data;
    }

    public function createPage($pageType, $data = null) {
        if (\Frenzycode\Ems\Config\PageType::isValidPage($pageType) == false) {
            return null;
        }


        $this->pageData = new PageData();
        $this->pageType = $pageType;

        $this->pageData->head->title = "EMS | Entity management system";

        $this->addStyle();
        $this->addScript();
        $this->addInitScript();

        if ($pageType == \Frenzycode\Ems\Config\PageType::PAGE_LOGIN) {
            return $this->pageData;
        }

        $this->pageData->bodyTemplate = 'frenzycode::page-body-content';

        $this->createMenu();
        $this->createBreadcrumbs();
        $this->createBodyTemplate($data);
        $this->addAngularJS();

        return $this->pageData;
    }

    public function generateView($pageData) {
        return View::make('frenzycode::page-index', array('pageData' => $pageData));
    }

    public function generateLoginView($pageData) {
        return View::make('frenzycode::page-login', array('pageData' => $pageData));
    }

}
