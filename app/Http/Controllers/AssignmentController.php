<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\ClassTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AssignmentController extends Controller
{
    public function view(ClassTransaction $classTransaction, Assignment $assignment)
    {
        $submissions = [];

        if (Auth::user()->role === 'student') {
            $submissions = $assignment->assignmentSubmission->sortByDesc('created_at');
        } else {
            $submissions = $assignment->assignmentSubmission
                ->groupBy(fn (AssignmentSubmission $submission) => $submission->user->name)
                ->map(fn (Collection $submissions) => $submissions->sortByDesc('created_at')->first())
                ->values();
        }

        return view('general.assignments.view', compact('classTransaction', 'assignment', 'submissions'));
    }

    public function create(Request $request, ClassTransaction $classTransaction)
    {
        $this->authorize('create', Assignment::class);
        $assignment = Assignment::create(
            collect(
                $request->validate([
                    'title' => 'required|string',
                    'start_at' => 'required|date',
                    'end_at' => 'required|date',
                    'attachment' => 'required|file',
                ])
            )->merge([
                'id' => Str::uuid(),
                'user_id' => Auth::id(),
                'class_transaction_id' => $classTransaction->id,
                'attachment' => optional($request->attachment)->store('assignments'),
            ])->all()
        );
        return redirect()->back()
            ->with('success', "Assignment <strong>{$assignment->title}</strong> created successfully.");
    }

    public function update(Request $request, ClassTransaction $classTransaction, Assignment $assignment)
    {
        $this->authorize('update', $assignment);
        $assignment->fill(
            collect(
                $request->validate([
                    'title' => 'required|string',
                    'start_at' => 'required|date',
                    'end_at' => 'required|date',
                    'attachment' => 'required|file',
                ])
            )->merge([
                'attachment' => optional($request->attachment)->store('assignments') ?? $assignment->attachment,
            ])->all()
        );
        $assignment->save();
        return redirect()->back()
            ->with('success', "Assignment <strong>{$assignment->title}</strong> updated successfully.");
    }

    public function delete(ClassTransaction $classTransaction, Assignment $assignment)
    {
        $this->authorize('delete', $assignment);
        $assignment->delete();
        return redirect()->route('general.courses.view', $classTransaction)
            ->with('success', 'Assignment deleted successfully.');
    }

    public function submit(Request $request, ClassTransaction $classTransaction, Assignment $assignment)
    {
        AssignmentSubmission::create(
            collect(
                $request->validate([
                    'attachment' => 'required|file',
                ])
            )->merge([
                'id' => Str::uuid(),
                'assignment_id' => $assignment->id,
                'user_id' => Auth::id(),
                'attachment' => $request->attachment->store('assignment_submissions'),
            ])->all()
        );
        return redirect()->back()->with('success', 'Submission created successfully.');
    }
}
