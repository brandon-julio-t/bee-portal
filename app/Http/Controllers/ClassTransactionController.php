<?php

namespace App\Http\Controllers;

use App\Models\ClassTransaction;
use App\Models\Shift;

class ClassTransactionController extends Controller
{
    public function view(ClassTransaction $classTransaction)
    {
        $students = $classTransaction->classTransactionStudents->sortBy('name')->map(fn ($e) => $e->student);
        $details = $classTransaction->classTransactionDetails->sortBy('session');
        $shifts = Shift::orderBy('start_time')->get();
        return view('class-transactions.view', compact('classTransaction', 'students', 'details', 'shifts'));
    }
}
