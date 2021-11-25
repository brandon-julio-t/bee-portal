<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ClassTransaction;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function allocation(Request $request)
    {
        $q = $request->q;
        $semesterId = $request->semester_id;
        $activeSemester = $semesterId
            ? Semester::find($semesterId)
            : Auth::user()->activeSemester();

        $classTransactions = ClassTransaction::where('semester_id', $activeSemester->id)
            ->where(function (Builder $query) use ($q) {
                $query->orWhereHas('classroom', function (Builder $query) use ($q) {
                    $query->where('name', 'like', "%$q%");
                })
                ->orWhereHas('subject', function (Builder $query) use ($q) {
                    $query->where('name', 'like', "%$q%");
                })
                ->orWhereHas('lecturer', function (Builder $query) use ($q) {
                    $query->where('name', 'like', "%$q%");
                });
            })
            ->paginate();

        $semesters = Semester::orderByDesc('active_at')->get();

        return view('admin.allocation', compact('classTransactions', 'semesters', 'activeSemester'));
    }

    public function manageClassrooms(Request $request)
    {
        $q = $request->q;
        $classrooms = Classroom::orderBy('name')->where('name', 'like', "%$q%")->paginate();
        return view('admin.manage-classrooms', compact('classrooms'));
    }

    public function manageStudents(Request $request)
    {
        $q = $request->q;
        $students = User::where('role', 'student')
            ->where(function (Builder $query) use ($q) {
                $query->orWhere('name', 'like', "%$q%")
                    ->orWhere('email', 'like', "%$q%")
                    ->orWhere('code', 'like', "%$q%");
            })
            ->orderBy('name')
            ->paginate();
        return view('admin.manage-students', compact('students'));
    }

    public function manageSubjects(Request $request)
    {
        $q = $request->q;
        $subjects = Subject::where('name', 'like', "%$q%")
            ->orWhere('code', 'like', "%$q%")
            ->orderBy('name')
            ->paginate();
        return view('admin.manage-subjects', compact('subjects'));
    }

    public function manageLecturers(Request $request)
    {
        $q = $request->q;
        $lecturers = User::where('role', 'lecturer')
            ->where(function (Builder $query) use ($q) {
                $query->orWhere('name', 'like', "%$q%")
                    ->orWhere('email', 'like', "%$q%")
                    ->orWhere('code', 'like', "%$q%");
            })
            ->orderBy('name')
            ->paginate();
        return view('admin.manage-lecturers', compact('lecturers'));
    }
}
