<?php


namespace App\Contracts;


class CategoryContract implements MainContract
{
    const TABLE =   'categories';

    const FILLABLE  =   [
        self::CATALOG_ID,
        self::TITLE,
        self::URL,
        self::ICON,
        self::IMG,
        self::STATUS
    ];
}
