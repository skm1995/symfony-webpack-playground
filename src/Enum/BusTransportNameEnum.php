<?php

namespace App\Enum;

enum BusTransportNameEnum: string
{
    case SYNC = 'sync';
    case ASYNC = 'async';
}
