<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'string',
                'required'
            ]
        ]);
        Student::create([
            'name' => $request->get('name')
        ]);

        return redirect()->back();
    }
}
