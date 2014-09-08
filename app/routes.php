<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

use Frenzycode\Ems\Config\URLMapping;

foreach (URLMapping::$httpGet as $route) {
    Route::get($route['url'], URLMapping::$namespace . "\\" . $route['handle']);
}

foreach (URLMapping::$httpPost as $route) {
    Route::post($route['url'], URLMapping::$namespace . "\\" . $route['handle']);
}
Route::get('/', function() {
//    
    //return View::make('frenzycode::page.page-index');
    //echo app_path();
    //echo Frenzycode\Ems\Config\URLMapping::$test;
    //echo "It's work!";
    $options = (array)new \Frenzycode\Ems\Libraries\Upload\UploadOptions();
    var_dump($options);
});
