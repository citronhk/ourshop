<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivitiesController extends Controller
{
    public function index()
    {
    	return view('homes.activities.index');
    }
}
