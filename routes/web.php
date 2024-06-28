<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProjectRoleController;
use App\Http\Controllers\TaskRoleController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\CommunicationsController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\MessageController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/connections', [ConnectionController::class, 'index'])->name('connections.index');
});

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', '/homepage');
Route::redirect('/dash', '/dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::redirect('/home', '/homepage');
Route::get('/homepage', function () {
    return view('homepage');
});
Route::post('/messages/{user}', [MessageController::class, 'store'])->name('messages.store');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update-picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.update_picture');
Route::get('/messages/{user}', [MessageController::class, 'show'])->name('messages.show');
Route::get('locale/{lang}',[LocaleController::class, 'setLocale']);
// Resource routes
Route::resource('users', UserController::class);
Route::resource('tasks', TaskController::class);
Route::resource('projects', ProjectController::class);
Route::resource('notifications', NotificationController::class);
Route::resource('project-roles', ProjectRoleController::class);
Route::resource('task-roles', TaskRoleController::class);
Route::resource('connections', ConnectionController::class);
Route::resource('messages', CommunicationsController::class);
// Custom routes for tasks
Route::get('tasks/{task}/participants', [TaskController::class, 'showParticipants'])->name('tasks.participants');
Route::post('tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
// Custom routes for projects
Route::get('projects/{project}/participants', [ProjectController::class, 'showParticipants'])->name('projects.participants');
Route::post('projects/{project}/send-alert', [ProjectController::class, 'sendAlert'])->name('projects.sendAlert');
// Custom routes for notifications
Route::post('notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
// Custom routes for connections
Route::post('connections/{connection}/accept', [ConnectionController::class, 'acceptRequest'])->name('connections.acceptRequest');
Route::post('connections/{connection}/reject', [ConnectionController::class, 'rejectRequest'])->name('connections.rejectRequest');
// Custom route for sending messages
Route::post('messages/send', [CommunicationsController::class, 'sendMessage'])->name('messages.sendMessage');
//middleware to make sure user is authenticated before doing any actions with projects and tasks
Route::middleware(['auth'])->group(function () { 
    Route::resource('tasks', TaskController::class);
});
Route::middleware(['auth'])->group(function () { 
    Route::resource('projects', ProjectController::class);
});
Route::get('projects/{project}/add-member', [ProjectController::class, 'addMember'])->name('projects.addMember');
Route::post('projects/{project}/store-member', [ProjectController::class, 'storeMember'])->name('projects.storeMember');
