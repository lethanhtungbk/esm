<?php

namespace Frenzycode\Ems\Controllers;

/* ---------------------------- */
/*        GLOBALE USE           */
/* ---------------------------- */


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
        $templateData->id = null;
        $pageData = $this->pageModel->createPage(PageType::PAGE_FIELD_ADD, $templateData);
        return $this->pageModel->generateView($pageData);
    }

    public function editField($id) {
        $templateData = new \stdClass();
        $templateData->action = "update";
        $templateData->id = $id;
        $pageData = $this->pageModel->createPage(PageType::PAGE_FIELD_EDIT, $templateData);
        return $this->pageModel->generateView($pageData);
    }

}
