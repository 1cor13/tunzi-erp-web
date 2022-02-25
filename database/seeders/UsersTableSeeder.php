<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Country;
use App\Models\Gender;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_super = new User();
        $user_super->name = 'Bruno Nicholas';
        $user_super->email = 'sbnibro256@gmail.com';
        $user_super->password = bcrypt('dollar');
        $user_super->phone = '0782407042';
        $user_super->bio = 'Am a loving, good, and full of Faith in God!';
        $user_super->account_no = '2560010';
        $user_super->gender_id = Gender::where('gender_name', 'Male')->first()->id;
        $user_super->status = 'active';
        $user_super->source = 'seeder';
        $user_super->country_id = Country::where('country_name', 'Uganda')->first()->id;
        $user_super->email_verified_at  = Carbon::now();
        $user_super->save();
        
        $user_super->attachRole(Role::where('name','super-admin')->first());

        $user_admin = new User();
        $user_admin->name = 'Diana Kim';
        $user_admin->email = 'info@dsnibro.com';
        $user_admin->password = bcrypt('dollar');
        $user_admin->gender_id = Gender::where('gender_name', 'Female')->first()->id;
        $user_admin->phone = '0771991162';
        $user_admin->bio = 'I really love inventing new things!';
        $user_admin->account_no = '2560020';
        $user_admin->status = 'active';
        $user_admin->source = 'seeder';
        $user_admin->country_id = Country::where('country_name', 'Kenya')->first()->id;
        $user_admin->email_verified_at  = Carbon::now();
        $user_admin->save();
        
        $user_admin->attachRole(Role::where('name','admin')->first());

        $user_admin_2 = new User();
        $user_admin_2->name = 'Jamiru Mpiima';
        $user_admin_2->email = 'mpiimaj@gmail.com';
        $user_admin_2->password = bcrypt('dollar');
        $user_admin_2->gender_id = Gender::where('gender_name', 'Male')->first()->id;
        $user_admin_2->phone = '0701257779';
        $user_admin_2->bio = 'Am an upcoming father!';
        $user_admin_2->account_no = '2560022';
        $user_admin_2->source = 'seeder';
        $user_admin_2->country_id = Country::where('country_name', 'Tanzania')->first()->id;
        $user_admin_2->status = 'active';
        $user_admin_2->email_verified_at  = Carbon::now();
        $user_admin_2->save();
        
        $user_admin_2->attachRole(Role::where('name','admin')->first());

        $user_guest = new User();
        $user_guest->name = config('app.name') . ' Guest';
        $user_guest->email = 'guest@dsnibro.com';
        $user_guest->password = bcrypt('dollar');
        $user_guest->gender_id = Gender::where('gender_name', 'Female')->first()->id;
        $user_guest->phone = '';
        $user_guest->source = 'seeder';
        $user_guest->bio = 'I really love ' . config('app.name');
        $user_guest->status = 'blocked';
        $user_guest->country_id = Country::where('country_name', 'Rwanda')->first()->id;
        $user_guest->save();
        
        $user_guest->attachRole(Role::where('name','guest')->first());
    }
}
