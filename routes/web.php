<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
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

Route::get('getBrand', function (Request $request) {
    return Http::get('http://rubixgroup.co/smg-api/getBrands.php');
});

Route::post('getType', function (Request $request) {
    $res = Http::get('http://rubixgroup.co/smg-api/getTypes.php?brand=' . $request->param . '');
    $type = str_replace("</xml>", "", $res);
    $xmlType = new SimpleXMLElement($type);
    $res = [];
     foreach ($xmlType as $value) {
        $response = Http::get('http://rubixgroup.co/smg-api/getDealers.php?type=' . $value . '&brand=' . $request->param . '');
        $temp = "" . $response;
        $obj = array('data' => $temp, 'type'=>$value, 'brand'=>$request->param);
        array_push($res, $obj);
     }
    return response()->json([
        'type' => $xmlType,
        'mapInfo' => $res,
    ]);
});

Route::post('sendSMS', function (Request $request) {
    $response = Http::get('http://rubixgroup.co/smg-api/sendSMS.php?tel='. $request->phone .'&dealer='. $request->accountNo .'');
    return $response;
});
