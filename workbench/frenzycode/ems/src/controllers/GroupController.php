<?php
namespace Frenzycode\Ems\Controllers;

/* ---------------------------- */
/*        GLOBALE USE           */
/* ---------------------------- */
use View;

/* ---------------------------- */
/*        LOCAL USE             */
/* ---------------------------- */
use Frenzycode\Ems\Config\PageType;

class GroupController extends BaseController {

    public function getGroups() {
        $pageData = $this->pageModel->createPage(PageType::PAGE_GROUPS);
        return $this->pageModel->generateView($pageData);
    }

    public function assignGroup($id) {
        $templateData = new \stdClass();
        $templateData->action = "update-fields";
        $templateData->id = $id;
        $pageData = $this->pageModel->createPage(PageType::PAGE_GROUP_ASSIGN, $templateData);
        return $this->pageModel->generateView($pageData);
    }

    public function addGroup() {
        $templateData = new \stdClass();
        $templateData->action = "add";
        $templateData->id = null;
        $pageData = $this->pageModel->createPage(PageType::PAGE_GROUP_ADD, $templateData);
        return $this->pageModel->generateView($pageData);
    }

    public function editGroup($id) {
        $templateData = new \stdClass();
        $templateData->action = "update";
        $templateData->id = $id;
        $pageData = $this->pageModel->createPage(PageType::PAGE_GROUP_EDIT, $templateData);
        return $this->pageModel->generateView($pageData);
    }

}
