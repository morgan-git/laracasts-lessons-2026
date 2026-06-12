<?php

namespace App\Enums;

enum IdeaState: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in-progress';
    case COMPLETE = 'complete';
}
