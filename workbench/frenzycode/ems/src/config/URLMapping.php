<?php

namespace Frenzycode\Ems\Config;

class URLMapping {

    public static $namespace = "Frenzycode\\Ems\\Controllers";
    public static $httpGet = array(
        array("url" => "setting", "handle" => ""),
        //fields
        array("url" => "setting/fields", "handle" => "FieldController@getFields"),
        array("url" => "setting/fields/add", "handle" => "FieldController@addField"),
        array("url" => "setting/fields/edit/{id}", "handle" => "FieldController@editField"),
        //groups
        array("url" => "setting/groups", "handle" => "GroupController@getGroups"),
        array("url" => "setting/groups/add", "handle" => "GroupController@addGroup"),
        array("url" => "setting/groups/edit/{id}", "handle" => "GroupController@editGroup"),
        array("url" => "setting/groups/assign/{id}", "handle" => "GroupController@assignGroup"),
        //entities
        array("url" => "entities", "handle" => "EntityController@assignGroup"),
        array("url" => "entities/{name}", "handle" => "EntityController@getEntities"),
        array("url" => "entities/{name}/add", "handle" => "EntityController@addEntitiy"),
        array("url" => "entities/{name}/edit/{id}", "handle" => "EntityController@editEntity"),
        
        //login
        array("url" => "login", "handle" => "UserController@showLogin"),
        array("url" => "logout", "handle" => "UserController@doLogout"),
        
        //admin
        array("url" => "admin", "handle" => "AdminController@index"),
        array("url" => "admin/import", "handle" => "AdminController@import"),
    );
    public static $httpPost = array(
        //fields
        array("url" => "restapi/fields", "handle" => "EmsRestController@getFields", "type" => "post"),
        array("url" => "restapi/field", "handle" => "EmsRestController@getField", "type" => "post"),
        array("url" => "restapi/field/save", "handle" => "EmsRestController@saveField", "type" => "post"),
        //groups
        array("url" => "restapi/groups", "handle" => "EmsRestController@getGroups", "type" => "post"),
        array("url" => "restapi/group", "handle" => "EmsRestController@getGroup", "type" => "post"),
        array("url" => "restapi/group/save", "handle" => "EmsRestController@saveGroup", "type" => "post"),
        array("url" => "restapi/group-fields", "handle" => "EmsRestController@getGroupFields", "type" => "post"),
        array("url" => "restapi/group-fields/save", "handle" => "EmsRestController@saveGroupFields", "type" => "post"),
        //entities
        array("url" => "restapi/entities", "handle" => "EmsRestController@getEntities", "type" => "post"),
        array("url" => "restapi/entities/search", "handle" => "EmsRestController@searchEntities", "type" => "post"),
        array("url" => "restapi/entity", "handle" => "EmsRestController@getEntity", "type" => "post"),
        array("url" => "restapi/entity/save", "handle" => "EmsRestController@saveEntity", "type" => "post"),
        
        
        
        
        array("url" => "restapi/upload", "handle" => "EmsRestController@upload", "type" => "post"),
        
        //login
        array("url" => "login", "handle" => "UserController@doLogin"),
    );

}
