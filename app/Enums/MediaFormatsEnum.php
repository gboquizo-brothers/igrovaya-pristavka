<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static DIGITAL()
 * @method static PHYSICAL()
 * @method static CLOUD()
 */
final class MediaFormatsEnum extends Enum
{
    public const DIGITAL = 'digital';
    public const PHYSICAL = 'physical';
    public const CLOUD = 'cloud';
}
