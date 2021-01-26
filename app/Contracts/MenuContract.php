<?php


namespace App\Contracts;


class MenuContract implements MainContract
{
    const TABLE     =   'menus';

    const FILLABLE  =   [
        self::CATEGORY_ID,
        self::TITLE,
        self::URL,
        self::ICON,
        self::IMG,
        self::STATUS
    ];
}
