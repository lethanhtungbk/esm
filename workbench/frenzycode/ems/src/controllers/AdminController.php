<?php

namespace Frenzycode\Ems\Controllers;

/* ---------------------------- */
/*        GLOBALE USE           */
/* ---------------------------- */

use DB;
use Redirect;
/* ---------------------------- */
/*        LOCAL USE             */
/* ---------------------------- */
use Frenzycode\Ems\Config\PageType;
use Frenzycode\Ems\Libraries\FrenzyHelper;

class AdminController extends BaseController {

    public function index() {
        $pageData = $this->pageModel->createPage(PageType::PAGE_ADMIN);
        return $this->pageModel->generateView($pageData);
    }

    private function defaultDb() {
        DB::table('fields')->delete();
        DB::table('field_define_values')->delete();
        DB::table('groups')->delete();
        DB::table('group_fields')->delete();
        DB::table('entities')->delete();
        DB::table('entity_single_values')->delete();
        DB::table('entity_multi_values')->delete();
    }

    public function import($file) {
        $this->defaultDb();
        $fileContents = file_get_contents('data-template/'.$file);
        $json = FrenzyHelper::xmlToJson($fileContents);
        $groups = $json->data->group;
        if (is_array($groups)) {
            foreach ($groups as $group)
            {
                $this->parseGroup($group);
            }
        } else {
            $this->parseGroup($groups);
        }
        
        return Redirect::to('admin')->with('success', 'Import successfully.');
    }

    private function findFieldTypeByDisplay($fieldTypes, $display) {
        foreach ($fieldTypes as $fieldType) {
            if ($fieldType->display == strtolower($display)) {
                return $fieldType;
            }
        }
        return null;
    }

    private function parseGroup($group) {
        $fieldTypes = DB::table('field_types')->select('id', 'groupId', 'display')->get();
        $group = FrenzyHelper::cast('Frenzycode\Ems\Models\Group', $group);
        $group->fields = $group->fields->field;
        $group->save();
        if ($group->fields != null) {
            foreach ($group->fields as $index => $field) {

                $field = FrenzyHelper::cast('Frenzycode\Ems\Models\Field', $field);

                $fieldType = $this->findFieldTypeByDisplay($fieldTypes, $field->displayType);
                if ($fieldType != null) {
                    $field->field_type_id = $fieldType->id;
                } else {
                    //handle error here..
                    echo "Cannot find field type";
                    var_dump($field);
                    return;
                }

                if ($fieldType->groupId == 2 || $fieldType->groupId == 3) {
                    //$field->value_type = $field->valueType;

                    if ($field->value_type == 2) {
                        $field->object_id = $field->objectId;
                        $field->attribute_id = $field->attributeId;
                    } else {
                        $field->defineValues = $field->defineValues->defineValue;
                        foreach ($field->defineValues as $df) {
                            $df->id = -1;
                        }
                    }
                }
                //var_dump($field);
                $field->save();
                $group->fields[$index] = $field;
            }
        }
        //var_dump($group);
        $group->saveFields();
    }

}
