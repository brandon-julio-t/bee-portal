<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ClassTransaction;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function allocation()
    {
        $classTransactions = ClassTransaction::paginate();
        return view('admin.allocation', compact('classTransactions'));
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
