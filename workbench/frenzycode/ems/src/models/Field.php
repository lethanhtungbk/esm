<?php

namespace Frenzycode\Ems\Models;

use DB;
use Log;
use Frenzycode\Ems\Libraries\FrenzyHelper;

class Field {

    public $name;
    public $id;
    public $field_type_id;
    public $value_type;
    public $object_id;
    public $attribute_id;
    public $defineValues;
    
    function __construct() {
    }
    
    public function getFieldTypes() {
        return FieldTypes::select("id", "name", "group", "groupId")->get();
    }

    public function getValueTypes() {
        return array(
            array("id" => 1, "name" => "Self-Defined Value"),
            array("id" => 2, "name" => "Object Value"),
        );
    }

    public static function getFields() {
        return DB::table('fields')
                        ->join('field_types', 'fields.field_type_id', '=', 'field_types.id')
                        ->select("fields.id", "fields.name", "field_types.name as field_type")
                        ->orderBy("fields.id","DESC")
                        ->get();
    }
    
    public static function getField($id) {
        $fielddb = DB::table('fields')
                        ->where('id', '=', $id)
                        ->select('id', 'name', 'field_type_id', 'value_type', 'object_id', 'attribute_id')->first();
        if ($fielddb != null) {
            $field = FrenzyHelper::cast('Frenzycode\Ems\Models\Field', $fielddb);
            
            $defineValues = DB::table('field_define_values')->where('field_id', '=', $id)
                            ->select('id', 'value', 'ordering')->get();

            if (count($defineValues) > 0) {
                $field->defineValues = $defineValues;
            }
            return $field;
        }
        return null;
    }

    public function save() {
        $record = array();
        $record["name"] = $this->name;
        $record["field_type_id"] = $this->field_type_id;
        if ($this->value_type != null) {
            $record["value_type"] = $this->value_type;
        }
        if ($this->object_id != null) {
            $record["object_id"] = $this->object_id;
        }
        if ($this->attribute_id != null) {
            $record["attribute_id"] = $this->attribute_id;
        }
        $this->id = DB::table('fields')->insertGetId($record);
        $this->updateDefineValues();
    }

    public function update() {
        $record = array();
        $record["name"] = $this->name;
        $record["field_type_id"] = $this->field_type_id;
        if ($this->value_type != null) {
            $record["value_type"] = $this->value_type;
        }
        if ($this->object_id != null) {
            $record["object_id"] = $this->object_id;
        }
        if ($this->attribute_id != null) {
            $record["attribute_id"] = $this->attribute_id;
        }
        DB::table('fields')->where('id', '=', $this->id)->update($record);
        $this->updateDefineValues();
    }

    public function updateDefineValues() {
        if ($this->defineValues != null)
        {
            $ordering = 1;
            foreach ($this->defineValues as $defineValue)
            {
                $record = array("value" => $defineValue->value,"ordering" => $ordering,"field_id" => $this->id);
                if ($defineValue->id == -1)
                {
                    //create new one
                    if ($defineValue->value != "")
                    {
                        DB::table('field_define_values')->insert($record);
                        $ordering++;
                    }
                }
                else
                {
                    //update exist one
                    if ($defineValue->value != "")
                    {
                        DB::table('field_define_values')->where('id','=',$defineValue->id)->update($record);
                        $ordering++;
                    }
                }
            }
        }
    }

}
