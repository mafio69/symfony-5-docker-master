<?php


namespace App\Services;


final class PersonStateConstants
{
    const STATE_ACTIVE = 1;
    const STATE_BANED = 2;
    const STATE_DELETED = 3;
    const STATE_ARRAY = [
        self::STATE_ACTIVE => 'active',
        self::STATE_BANED => 'baned',
        self::STATE_DELETED => 'deleted',
    ];

    private function __construct()
    {
    }
}