<?php


namespace App\Contracts;


class ProductContract implements MainContract
{
    const TABLE     =   'products';
    const FILLABLE  =   [
        self::MENU_ID,
        self::BARCODE,
        self::URL,
        self::TITLE,
        self::DESCRIPTION,
        self::PRICE,
        self::DISCOUNT,
        self::LIMIT,
        self::QUANTITY,

        self::ECLUB,
        self::ECLUB_LIMIT,
        self::ECLUB_DISCOUNT,

        self::TYPE,
        self::STATUS
    ];
}
