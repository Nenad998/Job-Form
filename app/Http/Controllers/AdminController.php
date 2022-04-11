<?php

namespace App\Http\Controllers;

use App\Models\Submit_Form;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $submittedApplications = Submit_Form::with('user', 'job')->paginate(4);
        return view('admin.index', ['submittedApplications'=> $submittedApplications]);
    }
}
