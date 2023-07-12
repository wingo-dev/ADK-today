<?php


namespace Database\Seeders;

use App\Models\User;
use App\Utils\Common\UserRoles;
use App\Utils\Common\UserStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [

                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('password'),
                'role' => UserRoles::SUPER_ADMIN,
                'status'    => UserStatus::VERIFIED,
                'email_verified_at' => now(),
            ],
            [

                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'role' => UserRoles::ADMIN,
                'status'    => UserStatus::VERIFIED,

                'email_verified_at' => now(),
            ],
            [

                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => bcrypt('password'),
                'role' => UserRoles::USER,
                'status'    => UserStatus::VERIFIED,

                'email_verified_at' => now(),
            ],

            [

                'name' => 'Vendor',
                'email' => 'vendor@gmail.com',
                'password' => bcrypt('password'),
                'role' => UserRoles::VENDOR,
                'status'    => UserStatus::VERIFIED,

                'email_verified_at' => now(),
            ]
            ];

            // for($i=0;$i<=20;$i++){
            //     $num = rand(1,1000);
            //     User::create([

            //         'name' => 'User '.$num,
            //         'email' => 'user'.$num .'@gmail.com',
            //         'password' => bcrypt('password'),
            //         'role' => UserRoles::USER,
            //         'email_verified_at' => now(),
            //     ]);
            // }
            User::insert($user);
    }
}
