<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ClassTransaction;
use App\Models\Semester;
use App\Models\Shift;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
                })->orWhereHas('subject', function (Builder $query) use ($q) {
                    $query->where('name', 'like', "%$q%");
                })->orWhereHas('lecturer', function (Builder $query) use ($q) {
                    $query->where('name', 'like', "%$q%");
                });
            })
            ->orderByDesc('created_at')
            ->paginate();

        $semesters = Semester::orderByDesc('active_at')->get();

        return view('admin.allocation.index', compact('classTransactions', 'semesters', 'activeSemester'));
    }

    public function viewCreateAllocation()
    {
        $subjects = Subject::orderBy('code')->get();
        $classrooms = Classroom::orderBy('name')->get();
        $lecturers = User::where('role', 'lecturer')->orderBy('name')->get();
        return view('admin.allocation.create', compact('subjects', 'classrooms', 'lecturers'));
    }

    public function createAllocation(Request $request)
    {
        $data = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'lecturer_id' => 'required|exists:users,id',
        ]);
        $data = collect($data)->merge([
            'id' => Str::uuid(),
            'semester_id' => Semester::activeSemester()->id
        ])->all();
        ClassTransaction::create($data);
        return redirect()->route('admin.allocation')
            ->with('success', 'Class transaction allocated.');
    }

    public function viewDetailAllocation(ClassTransaction $classTransaction)
    {
        $students = $classTransaction->classTransactionStudents->map(fn($e) => $e->student);
        $details = $classTransaction->classTransactionDetails->sortBy('session');
        return view('admin.allocation.view', compact('classTransaction', 'students', 'details'));
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
            ->with('success', "Classroom <b>{$data['name']}</b> " . ($request->id ? 'updated' : 'created') . '.');
    }

    public function deleteClassroom(Classroom $classroom)
    {
        $isDeleted = $classroom->delete();
        return $isDeleted
            ? redirect()->back()->with('success', "Classroom <b>{$classroom->name}</b> deleted.")
            : redirect()->back()->withErrors("An error occurred while deleting classroom <b>{$classroom->name}</b>.");
    }

    public function manageSubjects(Request $request)
    {
        $q = $request->q;
        $subjects = Subject::where('name', 'like', "%$q%")
            ->orWhere('code', 'like', "%$q%")
            ->orderBy('code')
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
            ->with('success', "Subject <b>{$data['name']}</b> " . ($request->id ? 'updated' : 'created') . '.');
    }

    public function deleteSubject(Subject $subject)
    {
        $isDeleted = $subject->delete();
        return $isDeleted
            ? redirect()->back()->with('success', "Subject <b>{$subject->name}</b> deleted.")
            : redirect()->back()->withErrors("An error occurred while deleting subject <b>{$subject->name}</b>.");
    }

    public function manageLecturers(Request $request)
    {
        $q = $request->q;
        $builder = $request->has('exclude_deleted')
            ? User::query()
            : User::withTrashed();
        $lecturers = $builder->where('role', 'lecturer')
            ->where(function (Builder $query) use ($q) {
                $query->orWhere('name', 'like', "%$q%")
                    ->orWhere('email', 'like', "%$q%")
                    ->orWhere('code', 'like', "%$q%");
            })
            ->orderBy('name')
            ->paginate();
        return view('admin.users.lecturers-index', compact('lecturers'));
    }

    public function manageStudents(Request $request)
    {
        $q = $request->q;
        $builder = $request->has('exclude_deleted')
            ? User::query()
            : User::withTrashed();
        $students = $builder->where('role', 'student')
            ->where(function (Builder $query) use ($q) {
                $query->orWhere('name', 'like', "%$q%")
                    ->orWhere('email', 'like', "%$q%")
                    ->orWhere('code', 'like', "%$q%");
            })
            ->orderBy('name')
            ->paginate();
        return view('admin.users.students-index', compact('students'));
    }

    public function updateOrCreateUser(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'role' => ['required', 'string', Rule::in(['student', 'lecturer'])],
        ]);

        if (!$request->id) { // is update
            $nextCode = null;
            if ($data['role'] === 'student') {
                $nextCode = ((int) User::where('role', $data['role'])->orderByDesc('code')->first()->code) + 1;
            } else if ($data['role'] === 'lecturer') {
                $nextCode = 'D' . strval(Str::of(User::where('role', $data['role'])->orderByDesc('code')->first()->code)->substr(1)) + 1;
            }

            $data = collect($data)
                ->merge([
                    'id' => $request->id ?? Str::uuid(),
                    'password' => str_repeat($nextCode, 3),
                    'code' => $nextCode,
                ])
                ->all();
        }

        User::updateOrCreate(['id' => $request->id], $data);
        return redirect()->back()
            ->with('success', "User <b>{$data['email']}</b> " . ($request->id ? 'updated' : 'created') . '.');
    }

    public function deleteUser(User $user)
    {
        $isDeleted = $user->delete();
        return $isDeleted
            ? redirect()->back()->with('success', "User deleted <b>{$user->email}</b>.")
            : redirect()->back()->withErrors("An error occurred while deleting user <b>{$user->email}</b>.");
    }

    public function restoreUser(Request $request, string $id)
    {
        $user = User::withTrashed()->find($id);
        $isRestored = $user->restore();
        return $isRestored
            ? redirect()->back()->with('success', "User restored <b>{$user->email}</b>.")
            : redirect()->back()->withErrors("An error occurred while restoring user <b>{$user->email}</b>.");
    }
}
