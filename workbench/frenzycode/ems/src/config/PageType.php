<?php
namespace Frenzycode\Ems\Config;
class PageType {
    const PAGE_FIELDS       = 1;
    const PAGE_FIELD_ADD    = 2;  
    const PAGE_FIELD_EDIT   = 3;
    const PAGE_GROUPS       = 4;
    const PAGE_GROUP_ADD    = 5;
    const PAGE_GROUP_EDIT   = 6;
    const PAGE_GROUP_ASSIGN = 7;
    const PAGE_ENTITIES     = 8;
    const PAGE_ENTITY_ADD   = 9;
    const PAGE_ENTITY_EDIT  = 10;
    const PAGE_LOGIN        = 11;
    
    
    public static function isValidPage($pageType) {
        return ($pageType >= self::PAGE_FIELDS && $pageType <= self::PAGE_LOGIN);
    }
}
