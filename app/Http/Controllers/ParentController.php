<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\ParentModel;

class ParentController extends Controller
{
    public function index()
    {
        $teacherId = Auth::id();
        $parents = ParentModel::whereHas('student', function ($query) use ($teacherId) {
            $query->where('teacher_id', $teacherId);
        })->with('user','student')->get();
        return view('parents.index', compact('parents'));
    }

    public function create()
    {
        $students = Student::where('teacher_id',Auth::id())->get();
        return view('parents.create',compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|unique:users',
            'contact_no' => 'required|regex:/^\d{10}$/',
        ]);

        $role = Role::where('name', 'parent')->first();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('123456'),
            'role_id' => $role->id,
        ]);

        ParentModel::create([
            'user_id' => $user->id,
            'student_id' => $request->student_id,
            'contact_number' => $request->contact_no,
        ]);

        return redirect()->route('parents.index')->with('success', 'Parent added successfully.');
    }

    public function edit($id)
    {
        $students = Student::where('teacher_id',Auth::id())->get();
        $parent = ParentModel::findOrFail($id);
        return view('parents.edit', compact('parent','students'));
    }

    public function update(Request $request, $id)
    {
        $parent = ParentModel::findOrFail($id);
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|unique:users,email,' . $parent->user_id,
            'contact_no' => 'required|regex:/^\d{10}$/',
        ]);

        $parent->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $parent->update([
            'contact_number' => $request->contact_no,
            'student_id' => $request->student_id,
        ]);

        return redirect()->route('parents.index')->with('success', 'Parent updated successfully.');
    }

    public function destroy($id)
    {
        $parent = ParentModel::findOrFail($id);
        $parent->user->delete();
        $parent->delete();

        return redirect()->route('parents.index')->with('success', 'Parent deleted successfully.');
    }
}
