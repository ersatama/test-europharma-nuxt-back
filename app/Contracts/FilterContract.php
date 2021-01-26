<?php


namespace App\Contracts;


class FilterContract implements MainContract
{
    const TABLE     =   'filters';

    const FILLABLE  =   [
        self::MENU_ID,
        self::TITLE,
        self::STATUS
    ];
}
