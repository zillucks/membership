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
    if (Auth::check()) {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.home');
        }
        else {
            if (Auth::user()->isVerified()) {
                return redirect()->route('member.home');
            }
            else {
                return redirect()->route('member.verify');
            }
        }
    }
    else {
        return redirect()->route('login');
    }
});

Auth::routes(['verify' => true]);

Route::get('logout', function() {
    Auth::logout();
    return redirect('/');
})->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::middleware('role:administrator,staff')->group(function () {
        
        Route::prefix('admin')->group(function () {
            Route::get('/', 'HomeController@index')->name('admin');
            Route::get('home', 'HomeController@index')->name('admin.home');

            Route::prefix('roles')->group(function () {
                Route::get('/', 'RoleController@index')->name('admin.roles');
                Route::get('create', 'RoleController@create')->name('admin.roles.create');
                Route::post('save', 'RoleController@store')->name('admin.roles.store');
                Route::get('{role}/edit', 'RoleController@edit')->name('admin.roles.edit');
                Route::put('{role}/update', 'RoleController@update')->name('admin.roles.update');
                Route::delete('{role}/delete', 'RoleController@delete')->name('admin.roles.delete');
            });

            Route::prefix('users')->group(function () {
                Route::get('/', 'UserController@index')->name('admin.users');
                Route::get('{user}/view', 'UserController@show')->name('admin.users.view');
                Route::get('profile', 'UserController@profile')->name('admin.users.profile');
                Route::get('create', 'UserController@create')->name('admin.users.create');
                Route::get('{user}/show-tab/{tab}', 'UserController@showTab')->name('admin.users.show-tab');
                Route::post('/', 'UserController@store')->name('admin.users.store');
                Route::get('edit/{user}', 'UserController@edit')->name('admin.users.edit');
                Route::put('update/{user}', 'UserController@update')->name('admin.users.update');
                Route::delete('delete/{user}', 'UserController@delete')->name('admin.users.delete');
                Route::delete('destroy/{user}', 'UserController@destroy')->name('admin.users.destroy');
            });

            Route::prefix('members')->group(function () {
                Route::get('/', 'MemberController@index')->name('admin.members');
                Route::get('create', 'MemberController@create')->name('admin.members.create');
                Route::post('save', 'MemberController@store')->name('admin.members.save');
                Route::get('{member}/edit', 'MemberController@edit')->name('admin.members.edit');
                Route::put('{member}/update', 'MemberController@update')->name('admin.members.update');
                Route::delete('{member}/delete', 'MemberController@delete')->name('admin.members.delete');
                Route::delete('{member}/destroy', 'MemberController@forceDelete')->name('admin.members.destroy');
                Route::get('{member}/account', 'MemberController@account')->name('admin.members.account');
                Route::put('{member}/account/update', 'MemberController@accountUpdate')->name('admin.members.account.update');
            });

            Route::prefix('transactions')->group(function () {
                Route::get('/', 'TransactionController@index')->name('admin.transactions');
                Route::get('create', 'TransactionController@create')->name('admin.transactions.create');
                Route::post('save', 'TransactionController@store')->name('admin.transactions.save');
                Route::get('{transaction}/edit', 'TransactionController@edit')->name('admin.transactions.edit');
                Route::put('{transaction}/update', 'TransactionController@update')->name('admin.transactions.update');
                Route::delete('{transaction}/delete', 'TransactionController@delete')->name('admin.transactions.delete');
            });
        });

    });

    Route::middleware('role:member')->group(function () {

        Route::prefix('member')->group(function () {
            Route::get('verify', 'Member\MemberController@verify')->name('member.verify');
            Route::get('/', 'Member\MemberController@index')->name('member');
            Route::get('home', 'Member\MemberController@index')->name('member.home');
            Route::get('profile', 'Member\MemberController@profile')->name('member.profile');
            Route::get('transaction', 'Member\MemberController@transaction')->name('member.transaction');
            Route::put('update-profil', 'Member\MemberController@updateProfile')->name('member.update-profile');
        });

    });

});