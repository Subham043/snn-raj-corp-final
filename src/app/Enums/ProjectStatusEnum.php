<?php

namespace App\Enums;

enum ProjectStatusEnum:Int {
    case COMPLETED = 0;
    case ONGOING = 1;

    public function label(): int {
        return static::getLabel($this);
    }

    public static function getLabel(self $value): int {
        return match ($value) {
            ProjectStatusEnum::COMPLETED => 0,
            ProjectStatusEnum::ONGOING => 1,
        };
    }

    public static function getValue(Int $value): string {
        return match ($value) {
            0 => 'COMPLETED',
            1 => 'ONGOING',
        };
    }
}
