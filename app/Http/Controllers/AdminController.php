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
use Illuminate\Support\Str;

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

        return view('admin.allocation.index', compact('classTransactions', 'semesters', 'activeSemester'));
    }

    public function manageClassrooms(Request $request)
    {
        $q = $request->q;
        $classrooms = Classroom::orderBy('name')->where('name', 'like', "%$q%")->paginate();
        return view('admin.classrooms.index', compact('classrooms'));
    }

    public function updateOrCreateClassroom(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:classrooms,name,except,id',
        ]);
        $data = collect($data)
            ->merge(['id' => $request->id ?? Str::uuid()])
            ->all();
        Classroom::updateOrCreate(['id' => $request->id], $data);
        return redirect()->back()
            ->with('success', 'Classroom ' . ($request->id ? 'updated' : 'created') . '.');
    }

    public function deleteClassroom(Classroom $classroom)
    {
        $isDeleted = $classroom->delete();
        return $isDeleted
            ? redirect()->back()->with('success', 'Classroom deleted.')
            : redirect()->back()->withErrors('An error occurred while deleting classroom.');
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
        return view('admin.users.students-index', compact('students'));
    }

    public function manageSubjects(Request $request)
    {
        $q = $request->q;
        $subjects = Subject::where('name', 'like', "%$q%")
            ->orWhere('code', 'like', "%$q%")
            ->orderBy('name')
            ->paginate();
        return view('admin.subjects.index', compact('subjects'));
    }

    public function updateOrCreateSubject(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|unique:subjects,code,except,id',
            'name' => 'required|string',
        ]);
        $data = collect($data)
            ->merge(['id' => $request->id ?? Str::uuid()])
            ->all();
        Subject::updateOrCreate(['id' => $request->id], $data);
        return redirect()->back()
            ->with('success', 'Subject ' . ($request->id ? 'updated' : 'created') . '.');
    }

    public function deleteSubject(Subject $subject)
    {
        $isDeleted = $subject->delete();
        return $isDeleted
            ? redirect()->back()->with('success', 'Subject deleted.')
            : redirect()->back()->withErrors('An error occurred while deleting subject.');
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
        return view('admin.users.lecturers-index', compact('lecturers'));
    }
}
