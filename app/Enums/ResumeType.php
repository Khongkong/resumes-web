<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Rules\EnumValue;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ResumeType extends Enum
{
    const English = '0';
    const Mandarin = '1';
    // const Japanese = '2';
}