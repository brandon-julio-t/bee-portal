@extends('layout.layout')

@section('body')
    <div class="container grid grid-cols-1 gap-4">
        <section class="card">
            <h2 class="text-xl font-semibold mb-4">Class Transaction Information</h2>
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-2 font-medium">Semester</div>
                <div class="col-span-10">{{ $classTransaction->semester->name }}</div>
                <div class="col-span-2 font-medium">Subject</div>
                <div class="col-span-10">{{ $classTransaction->subject->name }}</div>
                <div class="col-span-2 font-medium">Classroom</div>
                <div class="col-span-10">{{ $classTransaction->classroom->name }}</div>
                <div class="col-span-2 font-medium">Lecturer</div>
                <div class="col-span-10">{{ $classTransaction->lecturer->name }}</div>
            </div>
        </section>

        <section class="card">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Students</h2>
                @can('create', \App\Models\ClassTransactionStudent::class)
                    <div x-data="{ show: false }">
                        <button @click="show = true" class="btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Create
                        </button>

                        <div class="modal" x-cloak x-transition x-show="show">
                            <form action="{{ route('admin.allocation.student.create', $classTransaction) }}" method="POST"
                                class="card mt-8 max-w-xl mx-auto grid grid-cols-1 gap-4">
                                @csrf
                                <div class="flex justify-between items-center">
                                    <h2 class="text-xl font-semibold">Create Student(s)</h2>
                                    <button type="button" @click="show = false">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <textarea name="student_codes" rows="10" class="form-input"
                                    placeholder="[Student code 1]&#10;[Student code 2]&#10;..."></textarea>
                                <button type="submit" class="btn-primary justify-center">Submit</button>
                            </form>
                        </div>
                    </div>
                @endcan
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mb-4">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Code
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>
                                        @can('delete', \App\Models\ClassTransactionStudent::class)
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Actions</span>
                                            </th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-100">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $student->code }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $student->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $student->email }}
                                            </td>
                                            @can('delete', \App\Models\ClassTransactionStudent::class)
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <div x-data="{ showDeleteDialog: false }" class="inline-block relative">
                                                        <div x-cloak x-transition x-show="showDeleteDialog"
                                                            class="absolute bottom-0 right-0 z-10">
                                                            <form
                                                                action="{{ route('admin.allocation.student.delete', ['classTransaction' => $classTransaction, 'user' => $student]) }}"
                                                                method="POST" class="card bg-white">
                                                                @csrf
                                                                @method('DELETE')
                                                                <p class="mb-2">Are you sure you want to delete?</p>
                                                                <div class="grid grid-cols-2 gap-2">
                                                                    <button class="btn-danger justify-center">Yes</button>
                                                                    <button type="button" @click="showDeleteDialog = false"
                                                                        class="btn justify-center">No</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <button @click="showDeleteDialog = true" class="btn-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </div>
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="card">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Class Transaction Details</h2>
                @can('create', \App\Models\ClassTransactionDetail::class)
                    <div x-data="{ show: false }">
                        <button @click="show = true" class="btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Create or Replace
                        </button>

                        <div x-cloak x-transition x-show="show" class="modal">
                            <form action="{{ route('admin.allocation.detail.update-or-create', $classTransaction) }}" method="POST"
                                class="card card mt-8 max-w-xl mx-auto grid grid-cols-1 gap-4">
                                @csrf

                                <div class="flex justify-between items-center">
                                    <h2 class="text-xl font-semibold">Create or Replace Class Transaction Detail</h2>
                                    <button type="button" @click="show = false">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <input type="number" name="session" placeholder="Session" class="form-input">
                                <input type="date" name="transaction_date" placeholder="Transaction Date"
                                    class="form-input">
                                <select name="shift_id" class="form-input">
                                    @foreach ($shifts as $shift)
                                        <option value="{{ $shift->id }}">{{ $shift->description }}
                                            ({{ $shift->start_time }} - {{ $shift->end_time }})</option>
                                    @endforeach
                                </select>
                                <textarea name="note" placeholder="Note" rows="10" class="form-input"></textarea>
                                <button type="submit" class="btn-primary justify-center">Submit</button>
                            </form>
                        </div>
                    </div>
                @endcan
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mb-4">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Session
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Shift
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Note
                                        </th>
                                        @can('delete', \App\Models\ClassTransactionStudent::class)
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Actions</span>
                                            </th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details as $detail)
                                        <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-100">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-gray-900">
                                                {{ $detail->session }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $detail->transaction_date->toFormattedDateString() }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $detail->shift->description }} ({{ $detail->shift->start_time }} -
                                                {{ $detail->shift->end_time }})
                                            </td>
                                            <td class="px-6 py-4 whitespace-normal text-sm text-gray-500">
                                                {!! nl2br(e($detail->note)) !!}
                                            </td>
                                            @can('delete', \App\Models\ClassTransactionStudent::class)
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <div x-data="{ showDeleteDialog: false }" class="inline-block relative">
                                                        <div x-cloak x-transition x-show="showDeleteDialog"
                                                            class="absolute bottom-0 right-0 z-10">
                                                            <form
                                                                action="{{ route('admin.allocation.detail.delete', $detail) }}"
                                                                method="POST" class="card bg-white">
                                                                @csrf
                                                                @method('DELETE')
                                                                <p class="mb-2">Are you sure you want to delete?</p>
                                                                <div class="grid grid-cols-2 gap-2">
                                                                    <button class="btn-danger justify-center">Yes</button>
                                                                    <button type="button" @click="showDeleteDialog = false"
                                                                        class="btn justify-center">No</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <button @click="showDeleteDialog = true" class="btn-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </div>
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
