<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ClassTransaction;
use App\Models\Semester;
use App\Models\Subject;
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
        $classrooms = Classroom::orderBy('name')->paginate();
        return view('admin.manage-classrooms', compact('classrooms'));
    }

    public function manageStudents()
    {
    $students = User::where('role', 'student')->orderBy('name')->paginate();
        return view('admin.manage-students', compact('students'));
    }

    public function manageSubjects()
    {
        $subjects = Subject::orderBy('name')->paginate();
        return view('admin.manage-subjects', compact('subjects'));
    }

    public function manageLecturers()
    {
    $lecturers = User::where('role', 'lecturer')->orderBy('name')->paginate();
        return view('admin.manage-lecturers', compact('lecturers'));
    }
}
