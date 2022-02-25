<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_role');

        $super_admin = new Role();
        $super_admin->name = 'super-admin';
        $super_admin->display_name = 'Super Administrator';
        $super_admin->description = 'Admin with all rights of the System';
        $super_admin->save();

        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->display_name = 'Administrator';
        $role_admin->description = 'System\'s head administrator';
        $role_admin->save();

        $role_company = new Role();
        $role_company->name = 'company_sole';
        $role_company->display_name = 'Sole Proprietor';
        $role_company->description = 'An owner of a sole business';
        $role_company->save();

        $role_company = new Role();
        $role_company->name = 'company_group';
        $role_company->display_name = 'Group (Org)';
        $role_company->description = 'A small group of individuals working together';
        $role_company->save();

        $role_company = new Role();
        $role_company->name = 'company';
        $role_company->display_name = 'Company';
        $role_company->description = 'System registered company';
        $role_company->save();

        $role_company_admin = new Role();
        $role_company_admin->name = 'company_admin';
        $role_company_admin->display_name = 'Company Administrator';
        $role_company_admin->description = 'System registered company administrator';
        $role_company_admin->save();

        $role_company_staff = new Role();
        $role_company_staff->name = 'company_staff';
        $role_company_staff->display_name = 'Company Staff';
        $role_company_staff->description = 'System registered company staff or member or worker';
        $role_company_staff->save();

        $role_nurse = new Role();
        $role_nurse->name = 'insurance';
        $role_nurse->display_name = 'Insurance';
        $role_nurse->description = 'An isurance account with ' . config('app.name');
        $role_nurse->save();

        $role_nurse = new Role();
        $role_nurse->name = 'partner';
        $role_nurse->display_name = 'Partner';
        $role_nurse->description = 'A partner account with ' . config('app.name');
        $role_nurse->save();

        $role_editor = new Role();
        $role_editor->name = 'editor';
        $role_editor->display_name = 'System Editor';
        $role_editor->description = 'A user with editor rights with ' . config('app.name');
        $role_editor->save();

        $role_client = new Role();
        $role_client->name = 'client';
        $role_client->display_name = 'User';
        $role_client->description = 'A user signed up with an normal account';
        $role_client->save();

        $role_guest = new Role();
        $role_guest->name = 'guest';
        $role_guest->display_name = 'Guest User';
        $role_guest->description = 'A user reviewing the system';
        $role_guest->save();

        // attaching roles to super-admin
        $permissions = Permission::all();

        foreach ($permissions as $perm) {
            $super_admin->attachPermission($perm);
        }
    }
}
