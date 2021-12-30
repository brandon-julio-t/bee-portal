<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\ClassTransaction;
use App\Models\Shift;

class ClassTransactionController extends Controller
{
    public function view(ClassTransaction $classTransaction)
    {
        $students = $classTransaction->classTransactionStudents->sortBy('name')->map(fn ($e) => $e->student);
        $details = $classTransaction->classTransactionDetails->sortBy('session');
        $shifts = Shift::orderBy('start_time')->get();
        $assignments = Assignment::with('user')
            ->where('class_transaction_id', $classTransaction->id)
            ->orderBy('end_at')
            ->paginate(5);
        return view('general.courses.view', compact('classTransaction', 'students', 'details', 'shifts', 'assignments'));
    }
}
