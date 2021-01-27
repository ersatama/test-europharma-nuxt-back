<?php


namespace App\Contracts;


class BrandContract implements MainContract
{
    const TABLE     =   'brands';
    const FILLABLE  =   [
        self::TITLE,
        self::ICON,
        self::IMG,
        self::STATUS
    ];
}
