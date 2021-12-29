<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\ClassTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AssignmentController extends Controller
{
    public function create(Request $request, ClassTransaction $classTransaction)
    {
        $this->authorize('create', Assignment::class);
        $assignment = Assignment::create(
            collect(
                $request->validate([
                    'title' => 'required|string',
                    'start_at' => 'required|date',
                    'end_at' => 'required|date',
                    'attachment' => 'file',
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
}
