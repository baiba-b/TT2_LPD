<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProjectTaskRolesSeeder extends Seeder
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
            ['id' => 4, 'name' => 'Worker', 'read' => true, 'write' => false, 'mark_complete' => false, 'update' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);
         // Task roles
         DB::table('task_roles')->insert([
            [
                'name' => 'Creator', 
                'read' => true, 
                'write' => true, 
                'mark_complete' => true, 
                'update' => true, 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Manager', 
                'read' => true, 
                'write' => true, 
                'mark_complete' => false, 
                'update' => true, 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Viewer', 
                'read' => true, 
                'write' => false, 
                'mark_complete' => false, 
                'update' => false, 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
