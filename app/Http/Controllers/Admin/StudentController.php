<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function show(Student $student)
    {
        return view('admin/student');
    }

    public function store(User $user)
    {
        $user->student()->create();
        return view('admin/student');
    }

    public function assign(Student $student, Subject $subject)
    {
        $student->subjects()->create([
            'subject_id' => $subject->id,
        ]);
    }
}
