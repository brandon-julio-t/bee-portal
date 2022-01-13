<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\ClassTransaction;
use App\Models\ClassTransactionStudent;
use App\Models\Shift;
use App\Models\User;

class ClassTransactionController extends Controller
{
    public function view(ClassTransaction $classTransaction)
    {
        $students = $classTransaction->classTransactionStudents->sortBy('name')
            ->map(fn (ClassTransactionStudent $e) => $e->student)
            ->filter(fn (?User $u) => $u !== null);
        $details = $classTransaction->classTransactionDetails->sortBy('session');
        $shifts = Shift::orderBy('start_time')->get();
        $assignments = Assignment::where('class_transaction_id', $classTransaction->id)
            ->orderBy('end_at')
            ->paginate(5);
        return view('general.courses.view', compact('classTransaction', 'students', 'details', 'shifts', 'assignments'));
    }
}
