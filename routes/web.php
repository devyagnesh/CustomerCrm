<?php

use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\ProfileController;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{id}/{token}',[ContactFormController::class,'getContactForm'])->name('getContactForm');
Route::post('/postContact',[ContactFormController::class,'postContact'])->name('postContact');

Route::get('/dashboard', function () {

    /* Get all the user data of the current loggedin user */
    $user = Auth::user();

    /* Generate unique url for contact form */
    $UniqueUrl = URL::to('/').'/'.$user->id.'/'.$user->urlToken;

    /* storing all the necessary data to $userData variable */
    $userData = ['id'=>$user->id,'uniqueUrl'=>$UniqueUrl];


    /* fetching all the data entered by customer */
    $AllCustomers = Contact::where('client_id','=',$user->id)->get()->toArray();

    
    return view('dashboard',compact('userData','AllCustomers'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
