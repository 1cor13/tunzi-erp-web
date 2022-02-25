<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

Route::get('/', function () {
	return redirect()->route('login');
    return view('welcome');
});

// Route::get('/test', [
// 	'as'	=> 'test',
// 	'uses'	=> 'UserPageController@test'
// ]);
Route::post('/test', [
	'as'	=> 'tests',
	'uses'	=> 'UserPageController@test'
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'home', 'middleware' => ['auth','verified']], function(){
	Route::resource('companies', 'CompanyController');
	Route::resource('company/tickets', 'TicketController');
	Route::resource('company/estimates', 'EstimateController');
	Route::resource('company/expenses', 'ExpenseController');
	//Policy mgt
	Route::resource('company/policies', 'PolicyController');
	//Project mgt
	Route::resource('company/projects', 'ProjectController');
	//Performance mgt
	Route::resource('perform/goals', 'GoalController');
	Route::resource('perform/goaltypes', 'GoalTypeController');
	Route::resource('perform/trainings', 'TrainingController');
	Route::resource('perform/trainers', 'TrainerController');
	Route::resource('perform/trainingtypes', 'TrainingTypeController');
	Route::resource('perform/jobs', 'JobController');
	Route::resource('perform/jobtypes', 'JobTypeController');
	Route::resource('perform/jobapplicants', 'JobApplicantController');
	//Store mgt
	Route::resource('company/stores', 'StoreController');
	Route::post('store/upload-file', [ 'as' => 'stores.upload', 'uses' => 'StoreController@importStores' ]);
	//Inventory mgt
	Route::get('inventory', [ 'as' => 'inventory', 'uses' => 'UserPageController@inventory' ]);
	Route::resource('inventory/shops', 'ShopController');
	Route::resource('inventory/products', 'ProductController');
	Route::resource('inventory/branches', 'BranchController');
	Route::resource('company/assets', 'AssetController');
	//Employee mgt
	Route::resource('company/employees', 'EmployeeController');
	Route::resource('company/holidays', 'EmployeeHolidayController');
	Route::resource('company/leaves', 'EmployeeLeaveController');
	Route::resource('company/leavetypes', 'EmployeeLeaveTypeController');
	Route::resource('company/departments', 'DepartmentController');
	Route::resource('company/designations', 'DesignationController');
	Route::resource('company/timesheets', 'EmployeeTimeSheetController');
	Route::resource('company/overtimes', 'EmployeeOverTimeController');
	Route::resource('company/promotions', 'PromotionController');
	Route::resource('company/resignations', 'ResignationController');
	Route::resource('company/terminations', 'TerminationController');
	Route::resource('company/terminationtypes', 'TerminationTypeController');
	Route::resource('company/salaries', 'SalaryController');
	//Reports mgt
	Route::resource('common/reports', 'ReportController');
	Route::get('common/report/pdf','ReportController@pdf')->name('report.pdf');
	//Sales mgt
	Route::resource('sales/customers', 'CustomerController');
	//Account mgt
	Route::resource('account/bills', 'BillController');
	Route::resource('account/payments', 'PaymentController');
	Route::resource('account/vendors', 'VendorController');
	Route::resource('account/taxes', 'TaxController');
	Route::resource('account/accounts', 'AccountController');
	Route::resource('account/transfers', 'TransferController');
	Route::resource('account/transactions', 'TransactionController');
	Route::resource('account/invoices', 'InvoiceController');
	Route::resource('account/revenues', 'RevenueController');

	Route::resource('insurances', 'InsuranceController');
	Route::resource('partners', 'PartnerController');
	Route::resource('{type}/messages', 'MessageController');
	Route::resource('{type}/messages/{id}/attachments', 'MessageAttachmentController');

	// closures
	Route::get('company-registration', [
		'as'	=> 'register.companies',
		'uses'	=> 'UserPageController@registerCompany'
	]);
	Route::post('company-registration', [
		'as'	=> 'register.companies.save',
		'uses'	=> 'UserPageController@storeUserCompany'
	]);
	Route::post('/{type}/message', [
		'as'	=> 'messages.storeAll',
		'uses'	=> 'MessageController@storeAll'
	]);
	
	Route::get('/user/profile/settings', [
		'as' 	=> 'settings',
		'uses'	=> 'UserPageController@settings',
	]);
	Route::get('/profile', [
		'as' 	=> 'profile',
		'uses'	=> 'UserPageController@profile',
	]);
	Route::post('/user/profile', [
		'as'	=> 'profile.update',
		'uses'	=> 'UserPageController@update_image'
	]);
	Route::post('/user/password/profile', [
		'as'	=> 'password.update',
		'uses'	=> 'UserController@changePassword'
	]);
	
	Route::get('/user', [
		'as' 	=> 'userhome',
		'uses'	=> 'HomeController@userIndex'
	]);
	
});

// administrator routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth','verified','role:super-admin|admin']], function(){
	Route::resource('teams', 'TeamController');
	Route::resource('roles', 'RoleController');
	Route::resource('permissions', 'PermissionController');

	/*
	 * closure pages
	 */
	Route::get('/', [
		'as' 	=> 'admin',
		'uses'	=> 'AdminPageController@index',
	]);
	
	Route::patch('/admin/user/{id}/update-roles-perm', [
		'as'	=> 'permsrole.update',
		'uses' 	=> 'UserController@changeRole'
	]);
});

Route::group(['prefix'	=> 'config', 'middleware'	=> ['auth','verified']], function()
	{
		Route::resource('settings', 'SettingController');
		Route::resource('countries', 'CountryController');
		Route::resource('currencies', 'CurrencyController');
		Route::resource('categories', 'CategoryController');
		Route::resource('countries/disctricts', 'DistrictController');
		Route::resource('gender', 'GenderController');
		Route::resource('nationalities/languages', 'LanguageController');
		Route::resource('nationalities', 'NationalityController');
		Route::resource('notifications', 'NotificationController');
		Route::resource('disctricts/subcounties','SubCountyController');
	}
);

Route::group(['prefix'	=> 'admin', 'middleware' => ['auth','verified']], function(){
	Route::resources(['users' => 'UserController']);
	Route::post('restore-item', [
        'as'    => 'items.restore',
        'uses'  => 'AdminPageController@restore'
    ]);
});
