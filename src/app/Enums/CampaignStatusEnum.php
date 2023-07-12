<?php

namespace App\Enums;

enum CampaignStatusEnum:Int {
    case UPCOMING = 1;
    case COMPLETED = 2;

    public function label(): int {
        return static::getLabel($this);
    }

    public static function getLabel(self $value): int {
        return match ($value) {
            CampaignStatusEnum::UPCOMING => 1,
            CampaignStatusEnum::COMPLETED => 2,
        };
    }

    public static function getValue(Int $value): string {
        return match ($value) {
            1 => 'UPCOMING',
            2 => 'COMPLETED',
        };
    }
}
