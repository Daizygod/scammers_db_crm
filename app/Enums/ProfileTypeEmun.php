<?php

namespace App\Enums;

enum ProfileTypeEmun: string
{
    // LOWER CASE ONLY FOR VARIABLE NAMES
    case avito = 'avito';
    case vk = 'vk';
    case telegram = 'telegram';

    public function toString(): ?string
    {
        return match ($this) {
            self::avito => 'авито',
            self::vk => 'вк',
            self::telegram => 'телеграм',
        };
    }
}

