
<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\DidsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AclController;

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
    
    Route::post('/agent_add_ajex',[AgentController::class, 'agent_add_ajex']);
    Route::post('/agent_cred_add_ajex',[AgentController::class, 'agent_cred_add_ajex']);
    Route::post('/agent_bill_plan_add_ajex',[AgentController::class, 'agent_bill_plan_add_ajex']);

    // agentedit page
    Route::get('/agentedit/{id}', [AgentController::class, 'agentedit']);
    Route::post('/agentedit_update_ajex', [AgentController::class, 'agentedit_update_ajex']);
    Route::post('/agenteditbillplan_update_ajex', [AgentController::class, 'agenteditbillplan_update_ajex']);
    Route::post('/addbillplan_ajex', [AgentController::class, 'addbillplan_ajex']);
    
    Route::get('/agentcomission/{id}', [AgentController::class, 'agentcomission'])->name('agentcomission');
    Route::post('/agentcomissionajax/{id}', [AgentController::class, 'agentcomissionajax']);
    Route::post('/agent_commission_payment_ajex', [AgentController::class, 'agent_commission_payment_ajex']);

    
    // dids page 
    Route::get('/dids', [DidsController::class, 'dids'])->name('dids');
    Route::post('/phone_add_ajex', [DidsController::class, 'phone_add_ajex']);
    Route::post('/importinsert', [DidsController::class, 'importinsert']);

    // customers page 
    Route::get('/customers', [TenantController::class, 'customers'])->name('customers');

    // 
    Route::get('/customers/{id}', [AgentController::class, 'customersedit']);
    Route::get('/customers/add_ajex', [AgentController::class, 'customersAddAjex']);

    // acl page
    Route::get('acl', [AclController::class, 'acl'])->name('acl');
    Route::post('/acl_update_ajex', [AclController::class, 'acl_update_ajex']);
    Route::post('/acl_add_ajex', [AclController::class, 'acl_add_ajex']);
    
    
});

// Route::group(['middleware' => ['auth']], function() {
//     Route::resource('roles', RoleController::class);
//     Route::resource('users', UserController::class);
//     Route::resource('products', ProductController::class);
// });
