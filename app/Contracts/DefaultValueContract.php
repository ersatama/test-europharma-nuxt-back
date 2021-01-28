<?php


namespace App\Contracts;


class DefaultValueContract implements MainContract
{
    const TABLE     =   'default_values';

    const FILLABLE  =   [
        self::FILTER_ID,
        self::TITLE,
        self::STATUS
    ];
}
