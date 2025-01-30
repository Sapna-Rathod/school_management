<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Announcement;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\ParentModel;

class AdminController extends Controller
{
    public function dashboard()
    {
        $students = Student::with('user','teacher')->latest()->get();
        $parents = ParentModel::with('user','student')->latest()->get();
        $announcements = Announcement::where('created_by','!=',1)->latest()->get();
        return view('admin.dashboard',compact('parents','students','announcements'));
    }
}
