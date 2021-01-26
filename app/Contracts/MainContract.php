<?php


namespace App\Contracts;


interface MainContract
{
    const PATH  =   'http://127.0.0.1:8000';

    const ID    =   'id';

    const TITLE =   'title';
    const URL   =   'url';
    const IMG   =   'img';
    const ICON  =   'icon';

    const CATALOG_ID    =   'catalog_id';
    const CATEGORY_ID   =   'category_id';
    const MENU_ID       =   'menu_id';

    const PARENT_ID     =   'parent_id';
    const LFT           =   'lft';
    const RGT           =   'rgt';
    const DEPTH         =   'depth';

    const STATUS        =   'status';
    const ACTIVE        =   'active';
    const INACTIVE      =   'inactive';

    const STATUS_VALUES =   [
        self::ACTIVE,
        self::INACTIVE
    ];
}
