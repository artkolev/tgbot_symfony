<?php

declare(strict_types=1);

namespace App\Enum;

enum PollTypeEnum: string
{
    case REGULAR = 'regular';

    case QUIZ = 'quiz';
}
