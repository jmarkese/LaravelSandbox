<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/datatables', function () {
    return view('datatables');
});

Route::get('/users', function () {
    return view('users');
});


Route::get('/datatablestest', 'Controller@datatables');

Route::get('/usergroups', 'Controller@usergroups');

Route::get('/usergroups2', 'Controller@usergroups2');

Route::get('/partytone', 'Controller@partyTone');

Route::get('/partytonedata', ['as'=>'partytonedata', 'uses'=>'Controller@partyToneData']);
