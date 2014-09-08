<?php
namespace Frenzycode\Ems\Models;
use Eloquent;

class EntityMultiValue extends Eloquent{
    protected $table = "entity_multi_values";
    protected $fillable = array('entity_id', 'field_id', 'value');
    public $timestamps = false;
}
