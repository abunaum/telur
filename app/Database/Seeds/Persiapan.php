<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class Persiapan extends Seeder
{
    public function run()
    {
        $datauser = [
            [
                'username' => 'admin',
                'email'    => 'admin@legijayafarm.com',
                'fullname' => 'Legi Jaya Farm',
                'alamat' => 'PP. Nurul Jadid , Karanganyar - Paiton - Probolinggo',
                'password_hash' => '$2y$10$jZV5DZCoFJ1hfBfNVNcGk.F.xsWg7N/BLpC5oO9sdZd.d/EJWgsPC',
                'active' => 1,
                'force_pass_reset' => 0,
                'created_at' => Time::now('Asia/Jakarta', 'id_ID'),
                'updated_at' => Time::now('Asia/Jakarta', 'id_ID'),
            ],
            [
                'username' => 'bendahara',
                'email'    => 'bendahara@legijayafarm.com',
                'fullname' => 'Bendahara LJF',
                'alamat' => 'PP. Nurul Jadid , Karanganyar - Paiton - Probolinggo',
                'password_hash' => '$2y$10$ygOSQ0zEaPzApZKqpVi2YeKVeT4KMT2g4tuHWeyZSOQ7y5tIJgJcm',
                'active' => 1,
                'force_pass_reset' => 0,
                'created_at' => Time::now('Asia/Jakarta', 'id_ID'),
                'updated_at' => Time::now('Asia/Jakarta', 'id_ID'),
            ],
            [
                'username' => 'user',
                'email'    => 'user@gmail.com',
                'fullname' => 'User',
                'alamat' => 'PP. Nurul Jadid , Karanganyar - Paiton - Probolinggo',
                'password_hash' => '$2y$10$9ThghSDeOkEjb2hymOmCI.U3jCK5mvm5vgB1xfpseb5n/GBpbqNde',
                'active' => 1,
                'force_pass_reset' => 0,
                'created_at' => Time::now('Asia/Jakarta', 'id_ID'),
                'updated_at' => Time::now('Asia/Jakarta', 'id_ID'),
            ]
        ];
        $this->db->table('users')->insertBatch($datauser);

        $data_auth_groups = [
            [
                'name' => 'admin',
                'description'    => 'Administrator',
            ],
            [
                'name' => 'bendahara',
                'description'    => 'Bendahara',
            ],
            [
                'name' => 'user',
                'description'    => 'User',
            ]
        ];

        $this->db->table('auth_groups')->insertBatch($data_auth_groups);

        $data_auth_groups_users = [
            [
                'group_id' => 1,
                'user_id'    => 1,
            ],
            [
                'group_id' => 2,
                'user_id'    => 2
            ],
            [
                'group_id' => 3,
                'user_id'    => 3
            ]
        ];
        $this->db->table('auth_groups_users')->insertBatch($data_auth_groups_users);

        $data_telegram = [
            [
                'user_id'    => 1,
                'tele_id'   => '1044141933',
                'status'    => 'valid'
            ],
            [
                'user_id'    => 2,
                'tele_id'   => '1044141933',
                'status'    => 'valid'
            ],
            [
                'user_id'    => 3,
                'tele_id'   => '1044141933',
                'status'    => 'valid'
            ]
        ];
        $this->db->table('telegram')->insertBatch($data_telegram);
    }
}
