<?php

namespace Frenzycode\Ems\Controllers;

/* ---------------------------- */
/*        GLOBALE USE           */
/* ---------------------------- */
use URL;

/* ---------------------------- */
/*        LOCAL USE             */
/* ---------------------------- */
use Frenzycode\Ems\Config\PageType;

class FieldController extends BaseController {

    public function getFields() {
        $pageData = $this->pageModel->createPage(PageType::PAGE_FIELDS);
        return $this->pageModel->generateView($pageData);
    }

    public function addField() {
        $templateData = new \stdClass();
        $templateData->action = "add";
        $templateData->back = URL::to('setting/fields');
        $templateData->next = URL::to('setting/fields');
        $templateData->id = null;
        $pageData = $this->pageModel->createPage(PageType::PAGE_FIELD_ADD, $templateData);
        return $this->pageModel->generateView($pageData);
    }

    public function editField($id) {
        $templateData = new \stdClass();
        $templateData->action = "update";
        $templateData->back = URL::to('setting/fields');
        $templateData->next = URL::to('setting/fields');
        $templateData->id = $id;
        $pageData = $this->pageModel->createPage(PageType::PAGE_FIELD_EDIT, $templateData);
        return $this->pageModel->generateView($pageData);
    }

}
