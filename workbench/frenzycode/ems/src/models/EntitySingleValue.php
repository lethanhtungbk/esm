<?php
namespace Frenzycode\Ems\Models;
use Eloquent;

class EntitySingleValue extends Eloquent{
    protected $table = "entity_single_values";
    protected $fillable = array('entity_id', 'field_id', 'value');
    public $timestamps = false;
}
