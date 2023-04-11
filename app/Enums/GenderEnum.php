<?php

namespace App\Enums;

use App\Enums\Traits\Arrayable;

enum GenderEnum: string {
    use Arrayable;

    case MALE = 'male';
    case FEMALE = 'female';
    case NOT_PROVIDED = 'not_provided';
}
