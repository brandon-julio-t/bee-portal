<?php

namespace App\Http\Controllers;

use App\Models\ClassTransaction;
use App\Models\ClassTransactionDetail;
use App\Models\ClassTransactionStudent;
use App\Models\Shift;
use Illuminate\Support\Facades\Auth;

class ClassTransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $now = now();

        $classes = $user->role === 'student'
            ? $user->classTransactionStudents->flatMap(fn (ClassTransactionStudent $cts) => $cts->classTransaction->classTransactionDetails)
            : $user->classTransactions->flatMap(fn (ClassTransaction $ct) => $ct->classTransactionDetails);

        $classes = $classes->filter(
            fn (ClassTransactionDetail $ctd) =>
            $ctd->transaction_date->year === $now->year
                && $ctd->transaction_date->month === $now->month
                && $ctd->transaction_date->day === $now->day
        )->sortByDesc(fn (ClassTransactionDetail $ctd) => $ctd->shift->description);

        return view('class-transactions.index', compact('classes'));
    }

    public function view(ClassTransaction $classTransaction)
    {
        $students = $classTransaction->classTransactionStudents->sortBy('name')->map(fn ($e) => $e->student);
        $details = $classTransaction->classTransactionDetails->sortBy('session');
        $shifts = Shift::orderBy('start_time')->get();
        return view('class-transactions.view', compact('classTransaction', 'students', 'details', 'shifts'));
    }
}
