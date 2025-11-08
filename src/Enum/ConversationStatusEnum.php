<?php

declare(strict_types=1);

namespace App\Enum;

enum ConversationStatusEnum: string
{
    case ACTIVE = 'active';
    case CANCELLED = 'cancelled';
    case STOPPED = 'stopped';
}
