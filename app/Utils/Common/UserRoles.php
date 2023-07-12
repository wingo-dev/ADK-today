<?php


namespace App\Utils\Common;


class UserRoles
{
    const SUPER_ADMIN     = 0;
    const ADMIN     = 1;
    const VENDOR    = 2;
    const USER      = 3;

    const ALL = [
        self::SUPER_ADMIN   => 'Super Admin',
        self::ADMIN         => 'Admin',
        self::VENDOR        => 'Vendor',
        self::USER          => 'User',
    ];

}
