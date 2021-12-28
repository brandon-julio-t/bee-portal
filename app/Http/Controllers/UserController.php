<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\ClassTransaction;
use App\Models\ClassTransactionDetail;
use App\Models\ClassTransactionStudent;
use App\Models\ForumThread;
use Illuminate\Database\Eloquent\Builder;
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
        $classes = $this->getCurrentUserClassTransactions()->flatMap(fn (ClassTransaction $ct) => $ct->classTransactionDetails);

        $forums = ForumThread::whereIn('class_transaction_detail_id', $classes->map(fn (ClassTransactionDetail $ctd) => $ctd->id))
            ->orderByDesc('created_at')
            ->paginate(5, ['*'], 'forum_page');

        $assignments = Assignment::whereIn('class_transaction_id', $classes->map(fn (ClassTransactionDetail $ctd) => $ctd->classTransaction->id))
            ->orderByDesc('created_at')
            ->paginate(5, ['*'], 'assignment_page');

        $now = now();
        $classes = $classes->filter(
            fn (ClassTransactionDetail $ctd) => $ctd->transaction_date->year === $now->year
                && $ctd->transaction_date->month === $now->month
                && $ctd->transaction_date->day === $now->day
        )->sortByDesc(fn (ClassTransactionDetail $ctd) => $ctd->shift->description);

        return view('general.dashboard', compact('classes', 'forums', 'assignments'));
    }

    public function courses()
    {
        $classes = $this->getCurrentUserClassTransactions();
        return view('general.courses.index', compact('classes'));
    }

    public function forums(Request $request)
    {
        $classTransactions = $this->getCurrentUserClassTransactions();
        $selectedCtid = $request->get('ctid', $classTransactions->first()->id);
        $classTransaction = $classTransactions->find($selectedCtid);

        $classTransactionDetails = $classTransaction->classTransactionDetails;

        $sessions = $classTransactionDetails->unique('session')
            ->sortBy('session')
            ->map(fn (ClassTransactionDetail $ctd) => $ctd->session);

        $now = now();
        $latestSession = $classTransactionDetails->filter(
            fn (ClassTransactionDetail $ctd) => $ctd->transaction_date->year <= $now->year
                && $ctd->transaction_date->month <= $now->month
                && $ctd->transaction_date->day <= $now->day
        )->sortByDesc('transaction_date')->first()->session;

        $currentSession = intval($request->get('s') ?? $latestSession);
        $currentClassTransactionDetail = $classTransactionDetails->filter(fn (ClassTransactionDetail $ctd) => $ctd->session === $currentSession)->first();

        $forums = ForumThread::whereIn(
            'class_transaction_detail_id',
            $classTransactionDetails->map(fn (ClassTransactionDetail $ctd) => $ctd->id)
        )->whereHas('classTransactionDetail', fn (Builder $query) => $query->where('session', $currentSession))
            ->orderByDesc('created_at')
            ->paginate();

        return view(
            'general.forums.index',
            compact(
                'classTransactions',
                'classTransaction',
                'classTransactionDetails',
                'sessions',
                'latestSession',
                'currentSession',
                'currentClassTransactionDetail',
                'forums'
            )
        );
    }

    private function getCurrentUserClassTransactions()
    {
        $user = Auth::user();
        $classes = $user->role === 'student'
            ? $user->classTransactionStudents->unique('class_transaction_id')->map(fn (ClassTransactionStudent $cts) => $cts->classTransaction)
            : $user->classTransactions;
        return $classes->where('semester_id', Auth::user()->active_semester->id)
            ->sortBy(fn (ClassTransaction $ct) => $ct->subject->name);
    }
}
