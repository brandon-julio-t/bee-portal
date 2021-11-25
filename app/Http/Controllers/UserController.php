<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function changeSemester(Request $request)
    {
        $data = $request->validate([
            'semester_id' => 'required|exists:semesters,id'
        ]);

        $user = $request->user();
        $user->semester_id = $data['semester_id'];
        $user->save();

        return redirect()->back()->with('success', 'Semester changed.');
    }
}
