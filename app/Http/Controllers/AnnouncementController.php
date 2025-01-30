<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\AnnouncementEmail;
use App\Models\Student;
use App\Models\ParentModel;

class AnnouncementController extends Controller
{
  
    public function index()
    {
        $announcements = Announcement::where('created_by',Auth::id())->latest()->get();
        return view('announcements.index', compact('announcements'));
    }

   
    public function create()
    {
        return view('announcements.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        // dd($request->all());
        $announcement = Announcement::create([
            'title' => $request->title,
            'content' => $request->content,
            'target_students' => $request->has('target_students') ? 1 : 0,
            'target_parents' => $request->has('target_parents') ? 1 : 0,
            'created_by' => Auth::id(),
        ]);

        // Send Emails if created by teachers
        if(Auth::user()->role_id == 2){
            $this->sendEmails($announcement);
            return redirect()->route('announcements.index')->with('success', 'Announcement posted & Email send successfully.');
        }else{
            return redirect()->route('announcements.index')->with('success', 'Announcement posted successfully.');
        }
    }

    private function sendEmails(Announcement $announcement)
    {
        $recipients = collect();

        if ($announcement->target_students) {
            $emails = Student::where('teacher_id', Auth::id())
            ->join('users', 'users.id', '=', 'students.user_id')
            ->pluck('users.email');
            $recipients = $recipients->merge($emails);
        }

        if ($announcement->target_parents) {
            $emails = $emails = ParentModel::join('users', 'parent_models.user_id', '=', 'users.id')
            ->join('students', 'students.user_id', '=', 'parent_models.student_id')
            ->join('teachers', 'teachers.user_id', '=', 'students.teacher_id')
            ->where('students.teacher_id', 13)
            ->pluck('users.email');
            $recipients = $recipients->merge($emails);
        }

        foreach ($recipients->unique() as $email) {
            Mail::to($email)->send(new AnnouncementEmail($announcement));
        }
    }
}
