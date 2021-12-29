@extends('layout.layout')

@section('body')
    <div class="lg:mx-8 md:mx-6 grid grid-cols-1 xl:grid-cols-7 gap-4 overflow-auto">
        @foreach ($classCalendar as $date => $classes)
            <section class="flex xl:flex-col gap-4">
                <div
                    class="card flex justify-center items-center text-lg font-medium min-w-[164px] xl:min-w-min @if ($date === $now) bg-sky-100 @endif">
                    {{ $date }}
                </div>

                <div class="flex xl:flex-col gap-4">
                    @foreach ($classes as $class)
                        <div @click="location.href = '{{ route('general.courses.view', $class->classTransaction) }}'"
                            class="card cursor-pointer min-w-[250px] xl:min-w-min @if ($date === $now) bg-sky-100 @endif">
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
