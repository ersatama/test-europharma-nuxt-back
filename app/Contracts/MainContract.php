<?php


namespace App\Contracts;


interface MainContract
{
    const PATH          =   'http://127.0.0.1:8000';

    const ID            =   'id';

    const TITLE         =   'title';
    const DESCRIPTION   =   'description';
    const BARCODE       =   'barcode';
    const URL           =   'url';
    const PRICE         =   'price';
    const DISCOUNT      =   'discount';

    const ECLUB             =   'eclub';
    const ECLUB_LIMIT       =   'eclub_limit';
    const ECLUB_DISCOUNT    =   'eclub_discount';

    const LIMIT         =   'limit';
    const QUANTITY      =   'quantity';
    const TYPE          =   'quantity_type';

    const IMG           =   'img';
    const ICON          =   'icon';
    const ICON_PATH     =   'public/storage/icon';
    const IMG_PATH      =   'public/storage/img';

    const PRODUCT_ID    =   'product_id';
    const FILTER_ID     =   'filter_id';
    const BRAND_ID      =   'brand_id';
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
