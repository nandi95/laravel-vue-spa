<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Male()
 * @method static static Female()
 * @method static static Other()
 * @method static static PreferNotToSay()
 */
final class Genders extends Enum
{
    const Male           = 0;
    const Female         = 1;
    const Other          = 2;
    const PreferNotToSay = 3;
}
