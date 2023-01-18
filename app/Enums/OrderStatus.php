<?php

namespace App\Enums;

enum OrderStatus : string
{
    case New = "new";
    case Processing = "processing";
    case Preparing = "preparing";
    case Delivering = "delivering";
    case Delivered = "delivered";
    case Canceled = "canceled";

}
