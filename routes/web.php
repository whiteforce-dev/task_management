<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\TaskManagmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PipelineController;

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

date_default_timezone_set("Asia/kolkata");
Route::group(['middleware' => 'auth'], function ()
	{
		Route::get('/', function(){
			return redirect('dashboard');
		});
		Route::get('dashboard', function () {
			return view('dashboard');
		})->name('dashboard');

		Route::get('user-management', [InfoUserController::class, 'user_Management']);

		Route::get('/logout', [SessionsController::class, 'destroy']);
		Route::get('/user-profile', [InfoUserController::class, 'create']);
		Route::post('/user-profile', [InfoUserController::class, 'store']);
		Route::get('task-list', [TaskManagmentController::class, 'taskList']);
		Route::get('create-task1', [TaskManagmentController::class, 'created_Task1']);
		Route::get('create-task', [TaskManagmentController::class, 'created_Task']);
		Route::post('create-task', [TaskManagmentController::class, 'createdTask']);
		Route::post('search-task', [TaskManagmentController::class, 'searchTask']);
		Route::get('task-edit-page/{id}', [TaskManagmentController::class, 'taskEditPage']);
		Route::post('update-task/{id}', [TaskManagmentController::class, 'UpdateTask']);
		Route::get('manager-remark', [TaskManagmentController::class, 'managerRemark']);
		Route::post('managerchat/{id}', [TaskManagmentController::class, 'managerchat']);
		Route::post('teamchat/{id}', [TaskManagmentController::class, 'teamchat']);
		Route::post('teamchat/{id}', [TaskManagmentController::class, 'teamchat']);
		Route::get('managerremark', [TaskManagmentController::class, 'remark']);
		Route::get('feedback', [TaskManagmentController::class, 'feedbackshow']);
		Route::get('insertManagerremark', [TaskManagmentController::class, 'insertManagerremark']);
		Route::post('savemanagerremark', [TaskManagmentController::class, 'savemanagerremark']);
		Route::get('teamremarkpage', [TaskManagmentController::class, 'teamremarkpage']);
		Route::post('saveteamcomment/{id}', [TaskManagmentController::class, 'saveteamcomment']);
		Route::get('showteamcomm', [TaskManagmentController::class, 'showteamcomm']);
		Route::get('changestatus', [TaskManagmentController::class, 'changestatus']);
		Route::post('savechangestatus/{id}', [TaskManagmentController::class, 'savechangestatus']);
		Route::get('updatedetails', [TaskManagmentController::class, 'updatedetails']);
		Route::get('search', [TaskManagmentController::class, 'search']);
		Route::get('dashbordcompletetask/{id}', [TaskManagmentController::class, 'dashbordcompletetask']);
		Route::get('dashboardpending/{id}', [TaskManagmentController::class, 'dashboardpending']);
		Route::get('dashboardproccess/{id}', [TaskManagmentController::class, 'dashboardproccess']);
		Route::get('dashbordtotaltask/{id}', [TaskManagmentController::class, 'dashbordtotaltask']);
		Route::get('statushistory', [TaskManagmentController::class, 'statushistory']);
		// Route::get('/register', [RegisterController::class, 'create']);
		Route::get('static-sign-up', [ChangePasswordController::class, 'changePassword'])->name('password.update');
		Route::get('/edituser/{id}', [InfoUserController::class, 'editUser']);
		Route::post('/edituser-profile/{id}', [InfoUserController::class, 'edituserProfile']);
		Route::get('/delete-user/{id}', [InfoUserController::class, 'deleteUser']);
		Route::get('created-task', function () {
		return view('task.created_task');
		});
		Route::get('employeedetails', [TaskManagmentController::class, 'employeedetails']);
		Route::get('task-delete/{id}', [TaskManagmentController::class, 'task_delete']);
		Route::post('selectstatus', [TaskManagmentController::class, 'selectstatus']);
		Route::get('account-create', [AccountController::class, 'accountCreate']);
		Route::post('create-account', [AccountController::class, 'CreateAccount']);
		Route::get('account-list', [AccountController::class, 'accountList']);
		Route::get('account-editpage/{id}', [AccountController::class, 'accountEditpage']);
		Route::post('edit-account/{id}', [AccountController::class, 'editAccount']);
		Route::get('delete-account/{id}', [AccountController::class, 'AccountDelete']);
		Route::get('changepriority/{tak_id}', [TaskManagmentController::class, 'changepriority']);
		// Route::get('report', [TaskManagmentController::class, 'report']);
		// Route::get('search-report', [TaskManagmentController::class, 'searchReport']);
		// Route::get('pipeline', [PipelineController::class, 'pipeline']);
		// Route::get('pipelinestatus/{task_id}/{status_id}', [PipelineController::class, 'pipelinestatus']);
		Route::get('index', [PipelineController::class, 'index1']);
		Route::get('sendtask-email/{task_id}', [PipelineController::class, 'sendTaskEmail']);
		Route::patch('update-card-status/{card}', [PipelineController::class, 'updateStatus']);


	});
		Route::post('loginauth', [SessionsController::class, 'loginauth']);				
		
	
	Route::group(['middleware' => 'guest'], function () 
	{
		
	Route::get('/register', [RegisterController::class, 'create']);
	Route::post('/register', [RegisterController::class, 'store']);
	Route::get('/login', [SessionsController::class, 'create'])->name('login');
	Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	// Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	// Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
	});

	Route::Post('comment-bymanager', [TaskManagmentController::class, 'commentBYmanager']);
	Route::get('software-catagory', [TaskManagmentController::class, 'softwareCatagory']);
	





