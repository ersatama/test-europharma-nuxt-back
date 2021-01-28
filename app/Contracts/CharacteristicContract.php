<?php


namespace App\Contracts;


class CharacteristicContract implements MainContract
{
    const TABLE     =   'characteristics';

    const FILLABLE  =   [
        self::PRODUCT_ID,
        self::FILTER_ID,
        self::TITLE,
        self::STATUS
    ];
}
