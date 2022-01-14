<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\ClassTransaction;
use App\Models\ClassTransactionStudent;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class ClassTransactionController extends Controller
{
    public function view(ClassTransaction $classTransaction)
    {
        $students = $classTransaction->classTransactionStudents
            ->map(fn (ClassTransactionStudent $e) => $e->student)
            ->sortBy('name')
            ->filter(fn (?User $u) => $u !== null);
        $details = $classTransaction->classTransactionDetails->sortBy('session');
        $shifts = Shift::orderBy('start_time')->get();
        $assignments = Assignment::where('class_transaction_id', $classTransaction->id)
            ->whereHas('user', fn (Builder $query) => $query->whereNull('deleted_at'))
            ->orderBy('end_at')
            ->paginate(5);
        return view('general.courses.view', compact('classTransaction', 'students', 'details', 'shifts', 'assignments'));
    }
}
