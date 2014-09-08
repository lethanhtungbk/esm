<?php

namespace Frenzycode\Ems\Models;

use DB;
use Frenzycode\Ems\Libraries\FrenzyHelper;

class Group {

    public $name = '';
    public $icon = '';
    public $link = '';
    public $id;
    public $fields;

    function __construct() {
        
    }

    public function save() {
        $record = array();
        $record["name"] = $this->name;
        $record["link"] = $this->link;
        $record["icon"] = $this->icon;
        $this->id = DB::table('groups')->insertGetId($record);
    }

    public function update() {
        $record = array();
        $record["name"] = $this->name;
        $record["link"] = $this->link;
        $record["icon"] = $this->icon;

        DB::table('groups')->where('id', '=', $this->id)->update($record);
    }

    public static function getGroups() {
        return DB::table('groups')->select("id", "name", 'link', 'icon')->get();
    }

    public static function getGroup($id) {
        $groupdb = DB::table('groups')
                        ->where('id', '=', $id)
                        ->select('id', 'name', 'link', 'icon')->first();
        if ($groupdb != null) {
            $group = FrenzyHelper::cast('Frenzycode\Ems\Models\Group', $groupdb);
            return $group;
        }
        return null;
    }
    
    public static function getGroupByLink($link)
    {
        $groupdb = DB::table('groups')
                        ->where('link', '=', $link)
                        ->select('id', 'name', 'link', 'icon')->first();
        if ($groupdb != null) {
            $group = FrenzyHelper::cast('Frenzycode\Ems\Models\Group', $groupdb);
            return $group;
        }
        return null;
    }
    
    
    
    public function getFields() {
        $fieldsdb = DB::table('group_fields')
                        ->leftJoin('fields', 'group_fields.field_id', '=', 'fields.id')
                        ->where('group_fields.group_id', '=', $this->id)
                        ->select('group_fields.group_id', 'fields.id', 'fields.name')->get();
        $groupFields = array();
        foreach ($fieldsdb as $fielddb) {
            array_push($groupFields, FrenzyHelper::cast('Frenzycode\Ems\Models\Field', $fielddb));
        }
        $this->fields = $groupFields;
    }
    
    

    public static function getFreeFields() {
        $usedFields = DB::table('group_fields')->select('field_id')->get();

        $idArr = array();
        foreach ($usedFields as $field) {
            array_push($idArr, $field->field_id);
        }
        $freeFielddbs = DB::table('fields')->whereNotIn('id', $idArr)->select('id', 'name')->get();
        $freeFields = array();
        foreach ($freeFielddbs as $field) {
            array_push($freeFields, FrenzyHelper::cast('Frenzycode\Ems\Models\Field', $field));
        }
        return $freeFields;
    }
    
    

    private function findIdInArray($id, $array) {
        $hasFound = false;
        foreach ($array as $item) {
            if ($item->id == $id) {
                $hasFound = true;
                break;
            }
        }
        return $hasFound;
    }

    public function saveFields() {
        $assignFields = $this->fields;
        $this->getFields();
        //find new field assign
        foreach ($assignFields as $assignField) {
            $hasFound = $this->findIdInArray($assignField->id, $this->fields);
            if (!$hasFound) {
                DB::table('group_fields')->insert(
                        array('group_id' => $this->id, 'field_id' => $assignField->id,)
                );
            }
        }
        //remove old assign fields        
        foreach ($this->fields as $field) {
            $hasFound = $this->findIdInArray($field->id, $assignFields);
            if (!$hasFound) {
                DB::table('group_fields')
                        ->where('group_id', '=', $this->id)
                        ->where('field_id', '=', $field->id)
                        ->delete();
            }
        }
    }
}
