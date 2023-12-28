<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $surveyCount = Survey::count();

        return view('admin.dashboard', compact('userCount', 'surveyCount'));
    }
}
