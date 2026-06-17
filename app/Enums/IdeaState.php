<?php

declare(strict_types=1);

namespace App\Enums;

enum IdeaState: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in-progress';
    case COMPLETE = 'complete';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::IN_PROGRESS => 'In Progress',
            self::COMPLETE => 'Complete',
        };
    }
}
