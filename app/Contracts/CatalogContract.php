<?php


namespace App\Contracts;


class CatalogContract implements MainContract
{
    const TABLE     =   'catalogs';

    const FILLABLE  =   [
        self::TITLE,
        self::URL,
        self::ICON,
        self::IMG,
        self::STATUS
    ];
}
