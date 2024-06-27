<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('project_roles')->insert([
            ['id' => 1, 'name' => 'Creator', 'read' => true, 'write' => true, 'mark_complete' => true, 'update' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Manager', 'read' => true, 'write' => true, 'mark_complete' => true, 'update' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Member', 'read' => true, 'write' => true, 'mark_complete' => false, 'update' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
