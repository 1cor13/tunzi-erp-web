<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name'  => 'Public',
                'type'  => 'accounts ',
            ],
            [
                'name'  => 'Private',
                'type'  => 'accounts ',
            ],
            [
                'name'  => 'Public',
                'type'  => 'assets',
            ],
            [
                'name'  => 'Private',
                'type'  => 'assets',
            ],
            [
                'name'  => 'Statutory',
                'type'  => 'bills',
            ],
            [
                'name'  => 'Custom',
                'type'  => 'bills',
            ],
            [
                'name'  => 'Retail',
                'type'  => 'branches',
            ],
            [
                'name'  => 'Wholesale',
                'type'  => 'branches',
            ],
            [
                'name'  => 'Public',
                'type'  => 'companies',
            ],
            [
                'name'  => 'Private',
                'type'  => 'companies',
            ],
            [
                'name'  => 'Group',
                'type'  => 'companies',
            ],
            [
                'name'  => 'Group',
                'type'  => 'companies',
            ],
            [
                'name'  => 'Staff',
                'type'  => 'company_users',
            ],
            [
                'name'  => 'Member',
                'type'  => 'company_users',
            ],
            [
                'name'  => 'Guest',
                'type'  => 'company_users',
            ],
            [
                'name'  => 'Personal',
                'type'  => 'configs',
            ],
            [
                'name'  => 'Global',
                'type'  => 'configs',
            ],
            [
                'name'  => 'Africa',
                'type'  => 'countries',
            ],
            [
                'name'  => 'Europe',
                'type'  => 'countries',
            ],
            [
                'name'  => 'North America',
                'type'  => 'countries',
            ],
            [
                'name'  => 'South America',
                'type'  => 'countries',
            ],
            [
                'name'  => 'Antarctica',
                'type'  => 'countries',
            ],
            [
                'name'  => 'Asia',
                'type'  => 'countries',
            ],
            [
                'name'  => 'Australia',
                'type'  => 'countries',
            ],
            [
                'name'  => 'Foreign',
                'type'  => 'currencies',
            ],
            [
                'name'  => 'Local',
                'type'  => 'currencies',
            ],
            [
                'name'  => 'Local',
                'type'  => 'customers',
            ],
            [
                'name'  => 'Foreign',
                'type'  => 'customers',
            ],
            [
                'name'  => 'Major',
                'type'  => 'departments',
            ],
            [
                'name'  => 'Minor',
                'type'  => 'departments',
            ],
            [
                'name'  => 'Skill',
                'type'  => 'designations',
            ],
            [
                'name'  => 'Profession',
                'type'  => 'designations',
            ],
            [
                'name'  => 'Nothern',
                'type'  => 'districts',
            ],
            [
                'name'  => 'Eastern',
                'type'  => 'districts',
            ],
            [
                'name'  => 'Central',
                'type'  => 'districts',
            ],
            [
                'name'  => 'Western',
                'type'  => 'districts',
            ],
            [
                'name'  => 'North-western',
                'type'  => 'districts',
            ],
            [
                'name'  => 'Staff',
                'type'  => 'employees',
            ],
            [
                'name'  => 'Non-staff',
                'type'  => 'employees',
            ],
            [
                'name'  => 'Normal',
                'type'  => 'employees',
            ],
            [
                'name'  => 'General',
                'type'  => 'employee_holidays',
            ],
            [
                'name'  => 'Medical',
                'type'  => 'employee_holidays',
            ],
            [
                'name'  => 'Emergency',
                'type'  => 'employee_holidays',
            ],
            [
                'name'  => 'General',
                'type'  => 'employee_leaves',
            ],
            [
                'name'  => 'Medical',
                'type'  => 'employee_leaves',
            ],
            [
                'name'  => 'Emergency',
                'type'  => 'employee_leaves',
            ],
            [
                'name'  => 'Voluntary',
                'type'  => 'employee_over_times',
            ],
            [
                'name'  => 'Major',
                'type'  => 'employee_over_times',
            ],
            [
                'name'  => 'Major',
                'type'  => 'employee_time_sheets',
            ],
            [
                'name'  => 'Major',
                'type'  => 'estimates',
            ],
            [
                'name'  => 'Minor',
                'type'  => 'estimates',
            ],
            [
                'name'  => 'Major',
                'type'  => 'expenses',
            ],
            [
                'name'  => 'Minor',
                'type'  => 'expenses',
            ],
            [
                'name'  => 'Personal',
                'type'  => 'galleries',
            ],
            [
                'name'  => 'Company',
                'type'  => 'galleries',
            ],
            [
                'name'  => 'Normal',
                'type'  => 'goals',
            ],
            [
                'name'  => 'Public',
                'type'  => 'images',
            ],
            [
                'name'  => 'Private',
                'type'  => 'images',
            ],
            [
                'name'  => 'Normal',
                'type'  => 'insurances',
            ],
            [
                'name'  => 'Unpaid',
                'type'  => 'invoices',
            ],
            [
                'name'  => 'Paid',
                'type'  => 'invoices',
            ],
            [
                'name'  => 'Open',
                'type'  => 'jobs',
            ],
            [
                'name'  => 'Closed',
                'type'  => 'jobs',
            ],
            [
                'name'  => 'Normal',
                'type'  => 'job_applicants',
            ],
            [
                'name'  => 'Foreign',
                'type'  => 'languages',
            ],
            [
                'name'  => 'Local',
                'type'  => 'languages',
            ],
            [
                'name'  => 'Native',
                'type'  => 'languages',
            ],
            [
                'name'  => 'Fluent',
                'type'  => 'languages',
            ],
            [
                'name'  => 'Inbox',
                'type'  => 'messages',
            ],
            [
                'name'  => 'Draft',
                'type'  => 'messages',
            ],
            [
                'name'  => 'Sent',
                'type'  => 'messages',
            ],
            [
                'name'  => 'Spam',
                'type'  => 'messages',
            ],
            [
                'name'  => 'Read',
                'type'  => 'messages',
            ],
            [
                'name'  => 'Unread',
                'type'  => 'messages',
            ],
            [
                'name'  => 'Birth',
                'type'  => 'nationalities ',
            ],
            [
                'name'  => 'Personal',
                'type'  => 'notifications',
            ],
            [
                'name'  => 'Company',
                'type'  => 'notifications',
            ],
            [
                'name'  => 'Global',
                'type'  => 'notifications',
            ],
            [
                'name'  => 'Individual',
                'type'  => 'partners',
            ],
            [
                'name'  => 'Company',
                'type'  => 'partners',
            ],
            [
                'name'  => 'Cash',
                'type'  => 'payments',
            ],
            [
                'name'  => 'Invoice',
                'type'  => 'payments',
            ],
            [
                'name'  => 'Normal',
                'type'  => 'policies',
            ],
            [
                'name'  => 'Raw-material',
                'type'  => 'products',
            ],
            [
                'name'  => 'Product',
                'type'  => 'products',
            ],
            [
                'name'  => 'Personal',
                'type'  => 'projects',
            ],
            [
                'name'  => 'Group',
                'type'  => 'projects',
            ],
            [
                'name'  => 'Company',
                'type'  => 'projects',
            ],
            [
                'name'  => 'Minor',
                'type'  => 'promotions',
            ],
            [
                'name'  => 'Major',
                'type'  => 'promotions',
            ],
            [
                'name'  => 'Normal',
                'type'  => 'reports',
            ],
            [
                'name'  => 'Forced',
                'type'  => 'resignations',
            ],
            [
                'name'  => 'Voluntary',
                'type'  => 'resignations',
            ],
            [
                'name'  => 'Normal',
                'type'  => 'revenues',
            ],
            [
                'name'  => 'Private',
                'type'  => 'shops',
            ],
            [
                'name'  => 'Company',
                'type'  => 'shops',
            ],
            [
                'name'  => 'Shared',
                'type'  => 'shop_company',
            ],
            [
                'name'  => 'Fully-owned',
                'type'  => 'shop_company',
            ],
            [
                'name'  => 'Fully-owned',
                'type'  => 'stores',
            ],
            [
                'name'  => 'Shared',
                'type'  => 'stores',
            ],
            [
                'name'  => 'Company',
                'type'  => 'taxes',
            ],
            [
                'name'  => 'Statutory',
                'type'  => 'taxes',
            ],
            [
                'name'  => 'General',
                'type'  => 'teams',
            ],
            [
                'name'  => 'Forced',
                'type'  => 'terminations',
            ],
            [
                'name'  => 'Voluntary',
                'type'  => 'terminations',
            ],
            [
                'name'  => 'General',
                'type'  => 'tickets',
            ],
            [
                'name'  => 'Company',
                'type'  => 'trainers',
            ],
            [
                'name'  => 'Freelance',
                'type'  => 'trainers',
            ],
            [
                'name'  => 'Physical',
                'type'  => 'trainings',
            ],
            [
                'name'  => 'Virtual',
                'type'  => 'trainings',
            ],
            [
                'name'  => 'Group',
                'type'  => 'transactions',
            ],
            [
                'name'  => 'Personal',
                'type'  => 'transactions',
            ],
            [
                'name'  => 'General',
                'type'  => 'transfers',
            ],
            [
                'name'  => 'Public',
                'type'  => 'users',
            ],
            [
                'name'  => 'Private',
                'type'  => 'users',
            ],
            [
                'name'  => 'Closed',
                'type'  => 'vacancies',
            ],
            [
                'name'  => 'Open',
                'type'  => 'vacancies',
            ],
            [
                'name'  => 'Closed',
                'type'  => 'vacancy_applications',
            ],
            [
                'name'  => 'Open',
                'type'  => 'vacancy_applications',
            ],
            [
                'name'  => 'General',
                'type'  => 'vendors',
            ]
        ];

        foreach($categories as $val){
            Category::create($val);
        }
    }
}
