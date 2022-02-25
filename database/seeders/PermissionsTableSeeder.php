<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // roles
        	[
        		'name'			=> 'create_role',
	        	'display_name'	=> 'Create a role',
	        	'description'	=> 'Can create a new role',
        	],
        	[
        		'name'			=> 'edit_role',
	        	'display_name'	=> 'Edit a role',
	        	'description'	=> 'Can edit a role',
        	],
        	[
        		'name'			=> 'delete_role',
	        	'display_name'	=> 'Delete a role',
	        	'description'	=> 'Can delete a role',
        	],
            // users
            [
                'name'          => 'create_user',
                'display_name'  => 'Create a user',
                'description'   => 'Can create a new user',
            ],
            [
                'name'          => 'edit_user',
                'display_name'  => 'Can edit a user profile',
                'description'   => 'edit any user\'s profile',
            ],
            [
                'name'          => 'delete_user',
                'display_name'  => 'Can delete user',
                'description'   => 'Can delete any user\'s profile',
            ],
            // companies
            [
                'name'          => 'view_company_list',
                'display_name'  => 'View company list',
                'description'   => 'Can view a list of companies',
            ],
            [
                'name'          => 'create_company',
                'display_name'  => 'Create a company',
                'description'   => 'Can create a new company',
            ],
            [
                'name'          => 'edit_company',
                'display_name'  => 'Can edit a company profile',
                'description'   => 'edit any company\'s profile',
            ],
            [
                'name'          => 'delete_company',
                'display_name'  => 'Can delete company',
                'description'   => 'Can delete any company\'s profile',
            ],
            // persional user profile
            [
                'name'          => 'edit_own_profile',
                'display_name'  => 'Can edit personal profile',
                'description'   => 'User can edit their profile',
            ],
            // adverts
        	[
        		'name'			=> 'create_advert',
	        	'display_name'	=> 'Can create app adverts',
	        	'description'	=> 'Can create app adverts',
        	],
        	[
        		'name'			=> 'edit_advert',
	        	'display_name'	=> 'Can edit app adverts',
	        	'description'	=> 'Can edit app adverts',
        	],
        	[
        		'name'			=> 'delete_advert',
	        	'display_name'	=> 'Can delete app adverts',
	        	'description'	=> 'Can delete app adverts',
        	],
            // news
        	[
        		'name'			=> 'create_news',
	        	'display_name'	=> 'Can create news',
	        	'description'	=> 'Can create app news',
        	],
        	[
        		'name'			=> 'edit_news',
	        	'display_name'	=> 'Can edit news',
	        	'description'	=> 'Can edit app news',
        	],
        	[
        		'name'			=> 'delete_news',
	        	'display_name'	=> 'Can delete news',
	        	'description'	=> 'Can delete app news',
        	],
            // teams
        	[
        		'name'			=> 'create_team',
	        	'display_name'	=> 'Can create team',
	        	'description'	=> 'Can create a team',
        	],
        	[
        		'name'			=> 'edit_team',
	        	'display_name'	=> 'Can edit team',
	        	'description'	=> 'Can edit a team',
        	],
        	[
        		'name'			=> 'delete_team',
	        	'display_name'	=> 'Can delete team',
	        	'description'	=> 'Can delete a team',
        	],
            // app bookings
            [
                'name'          => 'create_book',
                'display_name'  => 'Can create bookings',
                'description'   => 'Can create service bookings',
            ],
            [
                'name'          => 'edit_booking',
                'display_name'  => 'Can edit bookings',
                'description'   => 'Can edit service bookings',
            ],
            [
                'name'          => 'delete_booking',
                'display_name'  => 'Can delete bookings',
                'description'   => 'Can delete service bookings',
            ],
            // questions
        	[
        		'name'			=> 'create_question',
	        	'display_name'	=> 'Can create question',
	        	'description'	=> 'Can create a question',
        	],
        	[
        		'name'			=> 'edit_question',
	        	'display_name'	=> 'Can edit question',
	        	'description'	=> 'Can edit a question',
        	],
        	[
        		'name'			=> 'delete_question',
	        	'display_name'	=> 'Can delete question',
	        	'description'	=> 'Can delete a question',
        	],
            // comments
        	[
        		'name'			=> 'create_comment',
	        	'display_name'	=> 'Can create project',
	        	'description'	=> 'Can create app comments',
        	],
        	[
        		'name'			=> 'edit_comment',
	        	'display_name'	=> 'Can edit comments',
	        	'description'	=> 'Can edit app comments',
        	],
        	[
        		'name'			=> 'delete_comment',
	        	'display_name'	=> 'Can delete comments',
	        	'description'	=> 'Can delete app comments',
        	],
            // config settings
        	[
        		'name'			=> 'create_configs',
	        	'display_name'	=> 'Can create app configs',
	        	'description'	=> 'Can create app configs',
        	],
        	[
        		'name'			=> 'edit_configs',
	        	'display_name'	=> 'Can edit app configs',
	        	'description'	=> 'Can edit app configs',
        	],
            [
                'name'          => 'delete_configs',
                'display_name'  => 'Can delete app configs',
                'description'   => 'Can delete app configs',
            ],
            // messages
            [
                'name'          => 'can_send_public_message',
                'display_name'  => 'Can send a public message',
                'description'   => 'A user can send a public message',
            ],
            [
                'name'          => 'view_messages',
                'display_name'  => 'Can view app messages',
                'description'   => 'User can view messages from the system',
            ],
            [
                'name'          => 'create_messages',
                'display_name'  => 'Can create system messages',
                'description'   => 'User can create system messages',
            ],
            [
                'name'          => 'edit_messages',
                'display_name'  => 'Can edit system messages',
                'description'   => 'User can edit system messages',
            ],
            [
                'name'          => 'delete_messages',
                'display_name'  => 'Can delete system messages',
                'description'   => 'User can delete system messages',
            ],
            // doctor profiles
            [
                'name'          => 'create_doctor',
                'display_name'  => 'Can create doctor profiles',
                'description'   => 'User can create doctor profiles',
            ],
            [
                'name'          => 'edit_doctor',
                'display_name'  => 'Can edit doctor profiles',
                'description'   => 'User can edit doctor profiles',
            ],
            [
                'name'          => 'delete_doctor',
                'display_name'  => 'Can delete doctor profiles',
                'description'   => 'User can delete doctor profiles',
            ],
            // doctor sections or professions
            [
                'name'          => 'create_section',
                'display_name'  => 'Can create doctor sections',
                'description'   => 'User can create doctor sections',
            ],
            [
                'name'          => 'edit_section',
                'display_name'  => 'Can edit doctor sections',
                'description'   => 'User can edit doctor sections',
            ],
            [
                'name'          => 'delete_section',
                'display_name'  => 'Can delete doctor sections',
                'description'   => 'User can delete doctor sections',
            ],
            // app feedback
            [
                'name'          => 'create_feedback',
                'display_name'  => 'Can create app feedback',
                'description'   => 'User can create app feedback',
            ],
            [
                'name'          => 'edit_feedback',
                'display_name'  => 'Can edit app feedback',
                'description'   => 'User can edit app feedback',
            ],
            [
                'name'          => 'delete_feedback',
                'display_name'  => 'Can delete app feedback',
                'description'   => 'User can delete app feedback',
            ],
            // images uploads
            [
                'name'          => 'create_images',
                'display_name'  => 'Can create images uploads',
                'description'   => 'User can create image uploads',
            ],
            [
                'name'          => 'edit_images',
                'display_name'  => 'Can edit images uploads',
                'description'   => 'User can edit image uploads',
            ],
            [
                'name'          => 'delete_images',
                'display_name'  => 'Can delete images uploads',
                'description'   => 'User can delete image uploads',
            ],
            // insurances
            [
                'name'          => 'create_insurances',
                'display_name'  => 'Can create insurances',
                'description'   => 'User can create insurances',
            ],
            [
                'name'          => 'edit_insurances',
                'display_name'  => 'Can edit insurances',
                'description'   => 'User can edit insurances',
            ],
            [
                'name'          => 'delete_insurances',
                'display_name'  => 'Can delete insurances',
                'description'   => 'User can delete insurances',
            ],
            // partners
            [
                'name'          => 'create_partners',
                'display_name'  => 'Can create partners',
                'description'   => 'User can create medical partners with ' . config( 'app.name' ),
            ],
            [
                'name'          => 'edit_partners',
                'display_name'  => 'Can edit partners',
                'description'   => 'User can edit medical partners with ' . config( 'app.name' ),
            ],
            [
                'name'          => 'delete_partners',
                'display_name'  => 'Can delete partners',
                'description'   => 'User can delete medical partners with ' . config( 'app.name' ),
            ],
            // services
            [
                'name'          => 'create_services',
                'display_name'  => 'Can create services',
                'description'   => 'User can create services',
            ],
            [
                'name'          => 'edit_services',
                'display_name'  => 'Can edit services',
                'description'   => 'User can edit services',
            ],
            [
                'name'          => 'delete_services',
                'display_name'  => 'Can delete services',
                'description'   => 'User can delete services',
            ],
            // testimony
            [
                'name'          => 'create_testimonies',
                'display_name'  => 'Can create testimonies',
                'description'   => 'User can create testimonies',
            ],
            [
                'name'          => 'edit_testimonies',
                'display_name'  => 'Can edit testimonies',
                'description'   => 'User can edit testimonies',
            ],
            [
                'name'          => 'delete_testimonies',
                'display_name'  => 'Can delete testimonies',
                'description'   => 'User can delete testimonies',
            ],
            // vacancies
            [
                'name'          => 'create_vacancies',
                'display_name'  => 'Can create vacancies',
                'description'   => 'User can create job vacancies',
            ],
            [
                'name'          => 'edit_vacancies',
                'display_name'  => 'Can edit vacancies',
                'description'   => 'User can edit job vacancies',
            ],
            [
                'name'          => 'delete_vacancies',
                'display_name'  => 'Can delete vacancies',
                'description'   => 'User can delete job vacancies',
            ],
            // vacancy applications
            [
                'name'          => 'create_vacancy_application',
                'display_name'  => 'Can create vacancy applications',
                'description'   => 'User can create job vacancy applications',
            ],
            [
                'name'          => 'edit_vacancy_application',
                'display_name'  => 'Can edit vacancy applications',
                'description'   => 'User can edit job vacancy applications',
            ],
            [
                'name'          => 'delete_vacancy_application',
                'display_name'  => 'Can delete vacancy applications',
                'description'   => 'User can delete job vacancy applications',
            ],
        ];

        foreach ($permissions as $key => $value) {
        	Permission::create($value);
        }
    }
}
