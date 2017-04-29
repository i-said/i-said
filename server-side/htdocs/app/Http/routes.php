<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**

  {
  "name": "tokyo-tower",
  "lat": "35.658611",
  "lng": "139.745556",
  "explain": "this is japanese tokyo tower",
  "images": [
  "https://hogehoge.com/hoge.png",
  "https://hogehoge.com/fuga.png",
  "https://hogehoge.com/piyo.png"
  ]
  },

 */
Route::get('/api/sample', function () {
    $response = array();

    
    $poi["name"] = "Tokyo Tower";
    $poi["lat"] = 35.658611;
    $poi["lon"] = 139.745556;
    $poi["explain"] = "this is japanese tokyo tower";
    $poi["images"] = array(
        "https://hogehoge.com/hoge.png",
        "https://hogehoge.com/fuga.png",
        "https://hogehoge.com/piyo.png"
      );

    //$response["message"] = "No problem";

    $response[] = $poi;

    $poi["name"] = "Mt.Fuji";
    $poi["lat"] = 35.360628;
    $poi["lon"] = 138.727365;
    $poi["explain"] = "FUJI-SAAAAAAAAN";
    $poi["images"] = array(
        "https://hogehoge.com/hoge.png",
        "https://hogehoge.com/fuga.png",
        "https://hogehoge.com/piyo.png"
      );

    $response[] = $poi;

    return Response::json($response);

});


Route::get('/api/poi', function () {
    return view('welcome');
});
