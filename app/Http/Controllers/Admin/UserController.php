<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function delete(User $user)
    {
        $user->delete();
        return redirect()->back();
    }

    public function edit(User $user, Request $request)
    {
        $request->validate([
            'name' => [
                'string',
                'required'
            ],
            'email' => [
                'email',
                'required'
            ],
            'is_active' => [
                'boolean'
            ]
        ]);

        $user->update([
            'email' => $request->get('email'),
            'is_active' => $request->get('is_active'),
            'name' => $request->get('name'),
        ]);

        return redirect()->back()->with('status', 'success');
    }
}
