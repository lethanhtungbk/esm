<?php
namespace Frenzycode\Ems\Controllers;

/* ---------------------------- */
/*        GLOBALE USE           */
/* ---------------------------- */
use View;

/* ---------------------------- */
/*        LOCAL USE             */
/* ---------------------------- */
use Frenzycode\Ems\Models\Group;

use Frenzycode\Ems\Config\PageType;

class EntityController extends BaseController{
    public function getEntities($link)
    {
        $group = Group::getGroupByLink($link);
        $templateData = new \stdClass();
        $templateData->action = "add";
        $templateData->id = null;
        $templateData->portletTitle = $group->name;
        $templateData->groupId = $group->id;
        $templateData->groupLink = $group->link;
        $pageData = $this->pageModel->createPage(PageType::PAGE_ENTITIES, $templateData);
        return $this->pageModel->generateView($pageData);
    }
    
    public function addEntitiy($link)
    {
        $group = Group::getGroupByLink($link);
        $templateData = new \stdClass();
        $templateData->action = "add";
        $templateData->id = null;
        $templateData->portletTitle = $group->name;
        $templateData->groupLink = $group->link;
        $pageData = $this->pageModel->createPage(PageType::PAGE_ENTITY_ADD, $templateData);
        return $this->pageModel->generateView($pageData);
    }
    
    public function editEntity($link,$id)
    {
        $group = Group::getGroupByLink($link);
        $templateData = new \stdClass();
        $templateData->action = "update";
        $templateData->id = $id;
        $templateData->portletTitle = $group->name;
        $templateData->groupLink = $group->link;
        $pageData = $this->pageModel->createPage(PageType::PAGE_ENTITY_EDIT, $templateData);
        
        $pageData->addStyle('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css');
        $pageData->addScript('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js');
        
        return $this->pageModel->generateView($pageData);
    }
}
