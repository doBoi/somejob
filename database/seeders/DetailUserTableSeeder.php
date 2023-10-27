<?php

namespace Database\Seeders;

use App\Models\DetailUser;
use Illuminate\Database\Seeder;

class DetailUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $detail_user = [
            [
                'user_id' => 1,
                'photo' => '',
                'role' => 'Website Developer',
                'contact_number' => '',
                'biography' => '',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ],
            [
                'user_id' => 2,
                'photo' => '',
                'role' => 'Software Enginner',
                'contact_number' => '',
                'biography' => '',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ], [
                'user_id' => 3,
                'photo' => '',
                'role' => 'Software Enginner',
                'contact_number' => '',
                'biography' => '',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ], [
                'user_id' => 4,
                'photo' => '',
                'role' => 'Website Developer',
                'contact_number' => '',
                'biography' => '',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ], [
                'user_id' => 5,
                'photo' => '',
                'role' => 'Software Enginner',
                'contact_number' => '',
                'biography' => '',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ],
            [
                'user_id' => 6,
                'photo' => '',
                'role' => 'Website Developer',
                'contact_number' => '',
                'biography' => '',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ], [
                'user_id' => 7,
                'photo' => '',
                'role' => 'AI Enginner',
                'contact_number' => '',
                'biography' => '',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ], [
                'user_id' => 8,
                'photo' => '',
                'role' => 'AI Enginner',
                'contact_number' => '',
                'biography' => '',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ], [
                'user_id' => 9,
                'photo' => '',
                'role' => 'Software Enginner',
                'contact_number' => '',
                'biography' => '',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ], [
                'user_id' => 10,
                'photo' => '',
                'role' => 'Website Developer',
                'contact_number' => '',
                'biography' => '',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ],

        ];
        DetailUser::insert($detail_user);
    }
}
