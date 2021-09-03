<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\PublisherController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/subscribe/{topic}', [SubscriberController::class, 'subscribe']);
Route::post('/publish/{topic}', [PublisherController::class, 'publish']);
Route::post('/', function(Request $request){
    $out = new \Symfony\Component\Console\Output\ConsoleOutput();
    $out->writeln(PHP_EOL);
    $out->write(json_encode($request->all()));
    $out->writeln(PHP_EOL);
});
