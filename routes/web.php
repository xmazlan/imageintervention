<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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
})->name('welcome');

Route::get('routes', function () {
    foreach (Route::getRoutes() as $value) {
        $x = isset($value->action['controller']) ? $value->action['controller'] : $x = 'Closure';
        echo $value->methods[0] . ' | ' . $value->uri() . ' | ' . $x . '<br>';
    };
});

Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('image', ImageController::class)->names([ //TODO pelajari put dan patch
        'index'     => 'index.image',
        'create'    => 'create.image',
        'show'      => 'show.image',
        'edit'      => 'edit.image',
        'store'     => 'store.image',
        'destroy'   => 'destroy.image'
    ]);

    Route::post('image/underline/{id}/{action}', 'ImageController@underline')->name('underline.image');
});

require __DIR__ . '/auth.php';

URL::forceScheme('https');
