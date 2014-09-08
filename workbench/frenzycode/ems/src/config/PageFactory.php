<?php

namespace Frenzycode\Ems\Config;

class PageFactory {
    /* -- Templates -- */

    public static $templates = array(
        PageType::PAGE_FIELDS => 'template.fields',
        PageType::PAGE_FIELD_ADD => 'template.field-detail',
        PageType::PAGE_FIELD_EDIT => 'template.field-detail',
        PageType::PAGE_GROUPS => 'template.groups',
        PageType::PAGE_GROUP_ADD => 'template.group-detail',
        PageType::PAGE_GROUP_EDIT => 'template.group-detail',
        PageType::PAGE_GROUP_ASSIGN => 'template.group-assign',
        PageType::PAGE_ENTITIES => 'template.entities',
        PageType::PAGE_ENTITY_ADD => 'template.entity-detail',
        PageType::PAGE_ENTITY_EDIT => 'template.entity-detail',
    );

    /* -- Angular Scripts -- */
    public static $angularGeneral = array(
        'scripts/angular.min.js',
        'scripts/library/library.js',
        'scripts/ems.js',
        'scripts/service/base-service.js'
    );
    public static $angularScripts = array(
        PageType::PAGE_FIELDS => array(
            'scripts/service/field-service.js',
            'scripts/controller/fields.js'
        ),
        PageType::PAGE_FIELD_ADD => array(
            'scripts/service/field-service.js',
            'scripts/controller/fields.js'
        ),
        PageType::PAGE_FIELD_EDIT => array(
            'scripts/service/field-service.js',
            'scripts/controller/fields.js'
        ),
        PageType::PAGE_GROUPS => array(
            'scripts/service/group-service.js',
            'scripts/controller/groups.js'
        ),
        PageType::PAGE_GROUP_ADD => array(
            'scripts/service/group-service.js',
            'scripts/controller/groups.js'
        ),
        PageType::PAGE_GROUP_EDIT => array(
            'scripts/service/group-service.js',
            'scripts/controller/groups.js'
        ),
        PageType::PAGE_GROUP_ASSIGN => array(
            'scripts/service/group-service.js',
            'scripts/controller/groups.js'
        ),
        PageType::PAGE_ENTITIES => array(
            'scripts/service/entity-service.js',
            'scripts/controller/entities.js'
        ),
        PageType::PAGE_ENTITY_ADD => array(
            'scripts/service/entity-service.js',
            'scripts/controller/entities.js',
            'scripts/directive/image-upload.js',
        ),
        PageType::PAGE_ENTITY_EDIT => array(            
            'scripts/service/entity-service.js',
            'scripts/controller/entities.js',            
            'scripts/library/jquery.fileupload.js',            
            'scripts/library/jquery.fileupload-process.js',            
            'scripts/library/jquery.fileupload-validate.js',            
            'scripts/directive/file-upload.js',
        ),
    );

    /* -- Breadcrumbs -- */
    public static $breadcrumbsData = array(
        "root" => array('icon' => 'fa-home', 'title' => 'Dashboard', 'link' => '/'),
        "field" => array('icon' => '', 'title' => 'Fields', 'link' => 'setting/fields'),
        "field-add" => array('icon' => '', 'title' => 'Add field', 'link' => 'setting/fields/add'),
        "field-edit" => array('icon' => '', 'title' => 'Edit field', 'link' => 'setting/fields/edit'),
        "group" => array('icon' => '', 'title' => 'Groups', 'link' => 'setting/groups'),
        "group-add" => array('icon' => '', 'title' => 'Add group', 'link' => 'setting/groups/add'),
        "group-edit" => array('icon' => '', 'title' => 'Edit group', 'link' => 'setting/groups/edit'),
    );
    
    public static $breadcrumbs = array(
        PageType::PAGE_FIELDS => array("root", "field"),
        PageType::PAGE_FIELD_ADD => array("root", "field", "field-add"),
        PageType::PAGE_FIELD_EDIT => array("root", "field", "field-edit"),
        PageType::PAGE_GROUPS => array("root", "group"),
        PageType::PAGE_GROUP_ADD => array("root", "group", "group-add"),
        PageType::PAGE_GROUP_EDIT => array("root", "group", "group-edit"),
        PageType::PAGE_GROUP_ASSIGN => array("root", "group", "group-assign"),
    );
    
    
    public static $styles = array (
        PageType::PAGE_LOGIN => array(
            'assets/global/plugins/select2/select2.css',
            'assets/admin/pages/css/login.css',
        ),
    );
    
    public static $scripts = array (
        PageType::PAGE_LOGIN => array(
            'assets/global/plugins/jquery-validation/js/jquery.validate.min.js',
            'assets/global/plugins/select2/select2.min.js',
            'assets/admin/pages/scripts/login.js',
        ),
    );
    
    public static $initScripts = array (
        PageType::PAGE_LOGIN => 'Login.init();',
    );
}
