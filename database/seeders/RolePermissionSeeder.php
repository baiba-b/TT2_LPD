<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Project Roles
        $projectRoles = DB::table('project_roles')->get();
        foreach ($projectRoles as $role) {
            $newRole = Role::create(['name' => $role->name, 'guard_name' => 'web']);
            if ($role->read) $newRole->givePermissionTo('read project');
            if ($role->write) $newRole->givePermissionTo('write project');
            if ($role->update) $newRole->givePermissionTo('update project');
            if ($role->notify) $newRole->givePermissionTo('notify project');
        }

        // Task Roles
        $taskRoles = DB::table('task_roles')->get();
        foreach ($taskRoles as $role) {
            $newRole = Role::create(['name' => $role->role_name, 'guard_name' => 'web']);
            if ($role->read) $newRole->givePermissionTo('read task');
            if ($role->write) $newRole->givePermissionTo('write task');
            if ($role->update) $newRole->givePermissionTo('update task');
            if ($role->notify) $newRole->givePermissionTo('notify task');
        }
    }
}


