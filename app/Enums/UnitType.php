<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


/**
 * @method static static Oz()
 * @method static static Ml()
 * @method static static Float()
 * @method static static Dash()
 * @method static static Springs()
 * @method static static Wedge()
 * @method static static Pinch()
 * @method static static Splash()
 * @method static static Tsp()
 * @method static static Leaves()
 * @method static static Whole()
 * @method static static Part()
 * @method static static Drops()
 */
final class UnitType extends Enum
{
    const Oz = 0;
    const Ml = 1;
    const Float = 2;
    const Dash = 3;
    const Springs = 4;
    const Wedge = 5;
    const Pinch = 6;
    const Splash = 7;
    const Tsp = 9;
    const Leaves = 10;
    const Whole = 11;
    const Part = 12;
    const Drops = 13;
}
