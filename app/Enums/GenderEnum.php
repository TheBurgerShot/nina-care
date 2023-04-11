<?php

namespace App\Enums;

enum GenderEnum: string {
    case MALE = 'male';
    case FEMALE = 'female';
    case NOT_PROVIDED = 'not_provided';
}
