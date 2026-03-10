<?php

namespace App\Enum;

enum UserStatusEnum: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case BANNED = 'banned';

    public function value(): array
    {
        return array_map(fn (self $status) => $status->value, self::cases());

    }

    public function default(): self
    {
        return self::ACTIVE;

    }

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => __('Active'),
            self::INACTIVE => __('Inactive'),
            self::BANNED => __('Banned')
        };
    }
}
