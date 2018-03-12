<?php

namespace App\Http\Controllers\AngularJS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class AngularJSController extends Controller
{

	public function index()
   {
      
      $data['kim'] = array('hello','world');
      return json_encode($data);
      // return view('angular.angularjs_index');
   }
}
