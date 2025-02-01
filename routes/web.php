<?php

use App\History;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function(){
        return view('pages.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/change-fat', 'HomeController@changeFat')->name('fat');
Route::get('/add-customer', 'HomeController@addcustomer')->name('add.customer');
Route::get('/manage-customer', 'HomeController@managecustomer')->name('manage.customer');
Route::get('/add-morning-milk', 'HomeController@addmrngmilk')->name('add.morning-milk');
Route::get('/add-evening-milk', 'HomeController@addevemilk')->name('add.evening-milk');
Route::get('/see-milk', 'HomeController@seemilk')->name('see.milk');
Route::get('/calculate-my-money', 'HomeController@calculate')->name('calculate');
Route::get('/history', 'HomeController@history')->name('history');

Route::get('delete-history/{id}', function($id){
        $history = History::where('id', $id)->first();
        $history->delete();

        return redirect('/history')->with('success', 'ग्राहक हिस्टोरी हटाइयो|');
});


Route::resource('/fat', 'FatController');
Route::resource('/customer', 'CustomerController');
Route::resource('/milk-morning', 'MorningMilkController');
Route::resource('/milk-evening', 'EveningMilkController');
Route::resource('/search', 'SearchController');
Route::resource('/calculate-money', 'CalculateController');
Route::resource('/customer-history', 'HistoryController');
