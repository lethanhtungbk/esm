<?php

namespace Frenzycode\Ems\Models;

use Frenzycode\Ems\Models\Field;
use Frenzycode\Ems\Models\EntitySingleValue;
use Frenzycode\Ems\Models\EntityMultiValue;
use Frenzycode\Ems\Libraries\FrenzyHelper;
use DB;

class Entity {

    public $id;
    public $name;
    public $fieldValues = array();
    public $groupId;

    public static function getEntities($groupId, $includeIds = null) {
        if ($includeIds == null || count($includeIds) == 0) {
            return DB::table('entities')->select('id', 'name', 'group_id')->where('group_id', '=', $groupId)->get();
        } else {
            return DB::table('entities')->select('id', 'name', 'group_id')->where('group_id', '=', $groupId)->whereIn('id', $includeIds)->get();
        }
    }

    public static function getEntity($id) {
        $entityDb = DB::table('entities')->where('id', '=', $id)->select('id', 'group_id', 'name')->first();
        if ($entityDb != null) {
            $entity = FrenzyHelper::cast('Frenzycode\Ems\Models\Entity', $entityDb);
            $singleValues = DB::table('entity_single_values')->where('entity_id', '=', $entity->id)->select('field_id', 'value')->get();
            $entity->fieldValues += $singleValues;
            $multipleValues = DB::table('entity_multi_values')->where('entity_id', '=', $entity->id)->select('field_id', 'value')->orderBy('field_id')->get();
            $values = array();
            foreach ($multipleValues as $value) {
                if (!array_key_exists($value->field_id, $values)) {
                    $values[$value->field_id] = array();
                }
                array_push($values[$value->field_id], $value->value);
            }
            foreach ($values as $index => $value) {
                $fieldValue = new \stdClass();
                $fieldValue->field_id = $index;
                $fieldValue->value = $value;
                array_push($entity->fieldValues, $fieldValue);
            }
        }

        return $entity;
    }

    public static function getEntityFields($groupId) {
        $fieldIds = DB::table('group_fields')
                        ->join('fields', 'group_fields.field_id', '=', 'fields.id')
                        ->where('group_fields.group_id', '=', $groupId)
                        ->select('fields.id')->get();
        $fields = array();
        $fieldTypes = DB::table('field_types')->select('id', 'groupId', 'display')->get();
        foreach ($fieldIds as $fieldId) {
            $field = Field::getField($fieldId->id);
            foreach ($fieldTypes as $fieldType) {
                if ($fieldType->id == $field->field_type_id) {
                    $field->display = $fieldType->display;
                    $field->fieldValueType = $fieldType->groupId;
                    break;
                }
            }
            array_push($fields, $field);
        }
        return $fields;
    }

    private function updateEntityValue() {
        if ($this->fieldValues != null) {
            foreach ($this->fieldValues as $fieldValue) {
                if (is_array($fieldValue->value)) {
                    EntityMultiValue::where('entity_id', '=', $this->groupId)
                            ->where('field_id', '=', $fieldValue->field_id)
                            ->whereNotIn('value', $fieldValue->value)
                            ->delete();

                    foreach ($fieldValue->value as $v) {
                        EntityMultiValue::firstOrCreate(array(
                            "entity_id" => $this->id,
                            "field_id" => $fieldValue->field_id,
                            "value" => $v));
                    }
                } else {
                    $entityValue = EntitySingleValue::firstOrNew(array(
                                "entity_id" => $this->id,
                                "field_id" => $fieldValue->field_id));

                    if ($entityValue->value != $fieldValue->value) {
                        $entityValue->value = $fieldValue->value;
                        $entityValue->save();
                    }
                }
            }
        }
    }

    public function save() {
        $record = array();
        $record["name"] = $this->name;
        $record["group_id"] = $this->groupId;
        $this->id = DB::table('entities')->insertGetId($record);
        $this->updateEntityValue();
    }

    public function update() {
        $record = array();
        $record["name"] = $this->name;
        $record["group_id"] = $this->groupId;
        DB::table('entities')->where('id', '=', $this->id)->update($record);
        $this->updateEntityValue();
    }

    public static function getEntitiesFieldsForSearch($groupId, &$hasTextSearch) {
        $fields = self::getEntityFields($groupId);
        foreach ($fields as $index => $field) {
            if ($field->fieldValueType == 1) {
                $hasTextSearch = true;
                unset($fields[$index]);
            } else if ($field->fieldValueType == 2) {
                //add no selected
                array_unshift($field->defineValues, array("id" => 0, "value" => "-- Select --"));
            }
        }
        $fields = array_values($fields);
        return $fields;
    }

    public static function searchEntities($groupId, $searchFields, $textsearch) {
        $entities = array();

        //get all entityId in group
        $entityIds = DB::table("entities")->where("group_id", "=", 5)->select("id")->get();
        $ids = self::getIdArray($entityIds);

        if (count($ids) == 0) {
            return $entities;
        }

        //search text first
        if ($textsearch != "") {
            //1. Get all text-field type
            $textSearchFields = DB::table('fields')
                    ->join('group_fields', 'fields.id', '=', 'group_fields.field_id')
                    ->join('field_types', 'fields.field_type_id', '=', 'field_types.id')
                    ->where('group_fields.group_id', '=', $groupId)
                    ->where('field_types.groupId', '=', 1)
                    ->select('fields.id')
                    ->get();

            $textSearchFieldIds = self::getIdArray($textSearchFields);
            if (count($textSearchFieldIds) > 0) {
                $entityIds = DB::table("entity_single_values")
                        ->whereIn("entity_id", $ids)
                        ->whereIn("field_id", $textSearchFieldIds)
                        ->where("value", "LIKE", "%" . $textsearch . "%")
                        ->select("entity_id as id")
                        ->distinct()
                        ->get();
                $ids = self::getIdArray($entityIds);
                if (count($ids) == 0) {
                    return $entities;
                }
            }
        }

        //search value selected fields
        foreach ($searchFields as $searchField) {
            $searchField = (object) $searchField;
            if ($searchField->fieldValueType == 2) {
                $entityIds = DB::table("entity_single_values")
                                ->whereIn("entity_id", $ids)
                                ->where("field_id", "=", $searchField->fieldId)
                                ->where("value", "=", $searchField->selected)
                                ->select("entity_id as id")->get();
                $ids = self::getIdArray($entityIds);
            } else if ($searchField->fieldValueType == 3) {
                $selected = $searchField->selected;
                foreach ($selected as $index => $s) {
                    $entityIds = DB::table("entity_multi_values")
                                    ->whereIn("entity_id", $ids)
                                    ->where("field_id", "=", $searchField->fieldId)
                                    ->where("value", "=", $s)
                                    ->select("entity_id as id")->get();

                    if (count($ids) == 0) {
                        return $entities;
                    }
                }
            }

            if (count($ids) == 0) {
                return $entities;
            }
        }

        $entities = self::getEntities($groupId, $ids);
        return $entities;
    }

    private static function getIdArray($array) {
        $ids = array();
        if ($array != null) {
            foreach ($array as $a) {
                array_push($ids, $a->id);
            }
        }
        return $ids;
    }

    public static function testSearch() {
//        $searchFields = array(
//            array("fieldId" => 107, "selected" => "1", "fieldValueType" => "2"),
//            array("fieldId" => 108, "selected" => "5", "fieldValueType" => "2"),
//            array("fieldId" => 109, "selected" => array(9), "fieldValueType" => "3"),
//            array("fieldId" => 110, "selected" => array("13", "14"), "fieldValueType" => "3"),
//        );
//
//
//        return self::searchEntities(5, $searchFields, "T");
        
        
    }

}
