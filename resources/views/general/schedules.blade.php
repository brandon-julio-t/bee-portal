@extends('layout.layout')

@section('body')
    <div class="mx-4 overflow-auto grid grid-cols-7 gap-4">
        @foreach ($classCalendar as $date => $classes)
            <section>
                <div class="card mb-4 text-center text-lg font-medium @if ($date === $now) bg-sky-100 @endif">
                    {{ $date }}
                </div>

                <div class="grid grid-cols-1 gap-4">
                    @foreach ($classes as $class)
                        <div class="card  @if ($date === $now) bg-sky-100 @endif">
                            <h2 class="text-md font-bold">{{ $class->classTransaction->subject->name }}</h2>
                            <p class="mt-2 mb-4">{{ $class->shift->start_time }} - {{ $class->shift->end_time }}</p>
                            <p>Session: <strong>{{ $class->session }}</strong></p>
                            <p>Lecturer: <strong>{{ $class->classTransaction->lecturer->name }}</strong></p>
                            <p>Class: <strong>{{ $class->classTransaction->classroom->name }}</strong></p>
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach
    </div>
@endsection
