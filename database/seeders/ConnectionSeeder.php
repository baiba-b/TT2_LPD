<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class ConnectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIds = User::pluck('id')->toArray();
        $types = ['acquaintance', 'friend'];

        for ($i = 0; $i < 100; $i++) {
            // Pick random user IDs for connection
            $user_id = $userIds[array_rand($userIds)];
            $connected_userID = $userIds[array_rand($userIds)];

            // Ensure the user does not connect to themselves
            while ($user_id == $connected_userID) {
                $connected_userID = $userIds[array_rand($userIds)];
            }

            // Insert the connection
            DB::table('connections')->insert([
                'user_id' => $user_id,
                'connected_user_id' => $connected_userID,
                'type' => $types[array_rand($types)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        DB::table('connections')->insert([
            'user_id' => 31,
            'connected_user_id' => 32,
            'type' => 'friend',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('connections')->insert([
            'user_id' => 32,
            'connected_user_id' => 31,
            'type' => 'friend',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

