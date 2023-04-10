<?php

namespace App\Enums;

enum PublishStatusEnum:Int {
    case ACTIVE = 1;
    case DRAFT = 2;

    public function label(): int {
        return static::getLabel($this);
    }

    public static function getLabel(self $value): int {
        return match ($value) {
            PublishStatusEnum::ACTIVE => 1,
            PublishStatusEnum::DRAFT => 2,
        };
    }

    public static function getValue(Int $value): string {
        return match ($value) {
            1 => 'ACTIVE',
            2 => 'DRAFT',
        };
    }
}
