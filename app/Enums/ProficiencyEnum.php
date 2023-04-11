<?php

namespace App\Enums;

use App\Enums\Traits\Arrayable;

enum ProficiencyEnum: string {
    use Arrayable;

    case LIMITED = 'limited';
    case PROFESSIONAL = 'professional';
    case NATIVE = 'native';
}
