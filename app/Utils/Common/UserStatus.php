<?php


namespace App\Utils\Common;


class UserStatus
{
    const VERIFIED      = 1;
    const UNVERIFIED    = 2;
    const DEACTIVATED   = 3;
    const BLOCKED       = 4;

    const ALL = [
        self::VERIFIED      => 'Verified',
        self::UNVERIFIED    => 'Unverified',
        self::DEACTIVATED   => 'Deactivated',
        self::BLOCKED       => 'Banned',

    ];

}
