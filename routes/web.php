<?php

use App\Http\Controllers\AclController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\DidsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\GatewaysController;
use App\Http\Controllers\SofiaRateplanController;

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

Route::get('/', [UserController::class, 'login']);

Route::get('login', [UserController::class, 'login'])->name('login');
Route::get('signup', [UserController::class, 'signup'])->name('signup');
Route::post('loginAuth', [UserController::class, 'login_auth'])->name('login_auth');
Route::get('forgotPassword', [UserController::class, 'forgot_password'])->name('forgotPassword');
Route::get('SendResetPasswordLink', [UserController::class, 'sent_reset_password_link'])->name('SendResetPasswordLink');;
Route::get('resetPassword/{id}', [UserController::class, 'resetPasswordForm'])->name('resetPasswordForm');
Route::post('resetPassword', [UserController::class, 'resetPassword'])->name('resetPassword');

Route::middleware(['auth'])->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UsersController::class);
     Route::get('logout', [UserController::class, 'logout'])->name('logout');
     Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // delete 
    Route::get('/delete/{id}/{table}', [AgentController::class, 'deleteData'])->name('delete');

    // agentlist page 
    Route::get('/agentlist', [AgentController::class, 'agentlist'])->name('agentlist');     
    Route::get('/agentlistajax', [AgentController::class, 'agentlistajax']);
    Route::post('/agentlist_update_ajex', [AgentController::class, 'agentlist_update_ajex']);
    Route::get('/tenant/{id}', [TenantController::class, 'customers']);
    
    Route::post('/agent_add_ajex',[AgentController::class, 'agent_add_ajex']);
    Route::post('/agent_cred_add_ajex',[AgentController::class, 'agent_cred_add_ajex']);
    Route::post('/agent_bill_plan_add_ajex',[AgentController::class, 'agent_bill_plan_add_ajex']);
    Route::post('/make_payment_submit',[AgentController::class, 'make_payment_submit']);



    // agentedit page
    Route::get('/agentedit/{id}', [AgentController::class, 'agentedit']);
    Route::post('/agentedit_update_ajex', [AgentController::class, 'agentedit_update_ajex']);
    Route::post('/agenteditbillplan_update_ajex', [AgentController::class, 'agenteditbillplan_update_ajex']);
    Route::post('/addbillplan_ajex', [AgentController::class, 'addbillplan_ajex']);
    
    Route::get('/agentcomission/{id}', [AgentController::class, 'agentcomission']);
    Route::post('/agentcomissionajax/{id}', [AgentController::class, 'agentcomissionajax']);

    
    // dids page (did list)
    Route::get('/dids', [DidsController::class, 'dids'])->name('dids');
    Route::post('/phone_add_ajex', [DidsController::class, 'phone_add_ajex']);
    Route::post('/importinsert', [DidsController::class, 'importinsert']);
    Route::get('/didedit/{id}', [DidsController::class, 'didedit']);

    // didedit page
    Route::post('/didedit_update_ajex', [DidsController::class, 'didedit_update_ajex']);

    // tenent (customers) page 
    Route::get('/customers', [TenantController::class, 'customers'])->name('customers');

    // Tenent (customers) edit page
    Route::get('/customers/{id}', [TenantController::class, 'customersedit']);
    Route::post('customers/customer_add_ajex', [TenantController::class, 'customersAddAjex']);

    // ACL
    Route::get('acl', [AclController::class, 'acl'])->name('acl');
    Route::post('/acl_update_ajex', [AclController::class, 'acl_update_ajex']);
    Route::post('/acl_add_ajex', [AclController::class, 'acl_add_ajex']);
     
    // Gateways
    Route::get('gateways',[GatewaysController::class, 'gateways'])->name('gateways');
    Route::post('/gateways_update_ajex', [GatewaysController::class, 'gateways_update_ajex']);
    Route::post('/gateways_add_ajex', [GatewaysController::class, 'gateway_add_ajex']);

    // Termination RatePlan
    Route::get('sofiarateplan',[SofiaRateplanController::class, 'sofiarateplan'])->name('sofiarateplan');
});

// Route::group(['middleware' => ['auth']], function() {
//     Route::resource('roles', RoleController::class);
//     Route::resource('users', UserController::class);
//     Route::resource('products', ProductController::class);
// });
