@extends('layout.layout')

@section('body')
    <form action="{{ route('admin.allocation.update', $classTransaction) }}" method="POST"
        class="card grid grid-cols-12 gap-4 items-center max-w-screen-md mx-auto">
        @csrf
        @method('PUT')
        <h2 class="text-lg font-semibold col-span-12">Update Allocation</h2>

        <label for="subject" class="col-span-12 md:col-span-2 md:text-right font-medium">Subject</label>
        <select name="subject_id" id="subject" class="form-input col-span-12 md:col-span-10">
            @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}" @if ($classTransaction->subject_id === $subject->id) selected @endif>
                    {{ $subject->code }} - {{ $subject->name }}
                </option>
            @endforeach
        </select>

        <label for="classroom" class="col-span-12 md:col-span-2 md:text-right font-medium">Classroom</label>
        <select name="classroom_id" id="classroom" class="form-input col-span-12 md:col-span-10">
            @foreach ($classrooms as $classroom)
                <option value="{{ $classroom->id }}" @if ($classTransaction->classroom_id === $classroom->id) selected @endif>
                    {{ $classroom->name }}
                </option>
            @endforeach
        </select>

        <label for="lecturer" class="col-span-12 md:col-span-2 md:text-right font-medium">Lecturer</label>
        <select name="lecturer_id" id="lecturer" class="form-input col-span-12 md:col-span-10">
            @foreach ($lecturers as $lecturer)
                <option value="{{ $lecturer->id }}" @if ($classTransaction->lecturer_id === $lecturer->id) selected @endif>
                    {{ $lecturer->name }} ({{ $lecturer->code }})
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn-primary justify-center col-span-6">Submit</button>
        <a href="{{ route('admin.allocation.index') }}" class="btn-danger justify-center col-span-6">
            Cancel
        </a>
    </form>
@endsection
