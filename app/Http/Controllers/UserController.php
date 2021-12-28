<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\ClassTransaction;
use App\Models\ClassTransactionDetail;
use App\Models\ClassTransactionStudent;
use App\Models\ForumThread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function changeSemester(Request $request)
    {
        $data = $request->validate([
            'semester_id' => 'required|exists:semesters,id'
        ]);

        $user = $request->user();
        $user->semester_id = $data['semester_id'];
        $user->save();

        return redirect()->back()->with('success', 'Semester changed.');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $now = now();

        $classes = $user->role === 'student'
            ? $user->classTransactionStudents->flatMap(fn (ClassTransactionStudent $cts) => $cts->classTransaction->classTransactionDetails)
            : $user->classTransactions->flatMap(fn (ClassTransaction $ct) => $ct->classTransactionDetails);

        $forums = ForumThread::whereIn('class_transaction_detail_id', $classes->map(fn (ClassTransactionDetail $ctd) => $ctd->id))
            ->orderByDesc('created_at')
            ->paginate(5, ['*'], 'forum_page');

        $assignments = Assignment::whereIn('class_transaction_id', $classes->map(fn (ClassTransactionDetail $ctd) => $ctd->classTransaction->id))
            ->orderByDesc('created_at')
            ->paginate(5, ['*'], 'assignment_page');

        $classes = $classes->filter(
            fn (ClassTransactionDetail $ctd) => $ctd->transaction_date->year === $now->year
                && $ctd->transaction_date->month === $now->month
                && $ctd->transaction_date->day === $now->day
        )->sortByDesc(fn (ClassTransactionDetail $ctd) => $ctd->shift->description);

        return view('dashboard', compact('classes', 'forums', 'assignments'));
    }
}
