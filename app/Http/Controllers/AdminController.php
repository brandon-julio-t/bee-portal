<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ClassTransaction;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function allocation(Request $request)
    {
        $semesterId = $request->semester_id;
        $activeSemester = $semesterId
            ? Semester::find($semesterId)
            : Auth::user()->activeSemester();

        $classTransactions = ClassTransaction::where('semester_id', $activeSemester->id)->paginate();
        $semesters = Semester::orderByDesc('active_at')->get();

        return view('admin.allocation', compact('classTransactions', 'semesters', 'activeSemester'));
    }

    public function manageClassrooms()
    {
        $classrooms = Classroom::paginate();
        return view('admin.manage-classrooms', compact('classrooms'));
    }

    public function manageStudents()
    {
        $students = User::where('role', 'student')->paginate();
        return view('admin.manage-students', compact('students'));
    }

    public function manageLecturers()
    {
        $lecturers = User::where('role', 'lecturer')->paginate();
        return view('admin.manage-lecturers', compact('lecturers'));
    }
}
