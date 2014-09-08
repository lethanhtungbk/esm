<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $this->down();
        
        Schema::create('field_types', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('groupId')->default(1);
            $table->string('group');
            $table->string('display');
        });
        
        Schema::create('fields', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('field_type_id')->default(0);
            $table->integer('value_type')->default(0);
            $table->integer('object_id')->default(0);
            $table->integer('attribute_id')->default(0);
        });
        
        Schema::create('field_define_values',function(Blueprint $table) {
            $table->increments('id');
            $table->integer('field_id');
                $table->string('value');
            $table->integer('ordering');
        });
        
        Schema::create('groups', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('link');
            $table->string('icon');
        });
        
        Schema::create('group_fields', function(Blueprint $table) {
            $table->increments('id');
            $table->string('group_id');
            $table->string('field_id');
        });
        
        Schema::create('entities', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id');
            $table->string('name');
        });
        
        Schema::create('entity_single_values',function(Blueprint $table) {
            $table->increments('id');
            $table->integer('entity_id');
            $table->integer('field_id');
            $table->string('value');
        });
        
        
        Schema::create('entity_multi_values',function(Blueprint $table) {
            $table->increments('id');
            $table->integer('entity_id');
            $table->integer('field_id');
            $table->string('value');
        });
        Schema::create('users', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username', 32);
            $table->string('email', 320);
            $table->string('password', 64);
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        }); //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
        Schema::dropIfExists('field_types');
        Schema::dropIfExists('fields');
        Schema::dropIfExists('field_define_values');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('group_fields');
        Schema::dropIfExists('entities');
        Schema::dropIfExists('entity_single_values');
        Schema::dropIfExists('entity_multi_values');
    }

}
