<?php

namespace App\Enums;


enum FileType: int
{
    case IMPORTED = 1;

    case PROCESSED = 2;

    case DELETED = 3;
}
