@extends('layout.layout')

@section('body')
    <div class="container grid grid-cols-12 gap-4">
        <div class="card h-fit lg:sticky lg:top-4 col-span-12 lg:col-span-4 grid grid-cols-1 gap-4">
            <h2 class="text-xl font-semibold">{{ $assignment->title }}</h2>
            <p>
                By <span class="font-medium">{{ $assignment->user->name }}</span>
                <br>
                For <span class="font-medium">[{{ $classTransaction->subject->code }}]
                    {{ $classTransaction->subject->name }}</span>
                <br>
                Starts At: <span class="font-medium">{{ $assignment->start_at }}</span>
                <br>
                Ends At: <span class="font-medium">{{ $assignment->end_at }}</span>
            </p>
            <div x-data="{ showUpdateForm: false, showDeletePopup: false }">
                <div class="w-fit relative">
                    @can('update', $assignment)
                        <button @click="showUpdateForm = true" class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                <path fill-rule="evenodd"
                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                    clip-rule="evenodd" />
                            </svg>
                            Edit
                        </button>

                        <div @click.self="showUpdateForm = false" x-cloak x-show="showUpdateForm" class="modal">
                            <div x-cloak x-transition x-show="showUpdateForm" class="container my-8">
                                <form x-data="{ file: null }"
                                    action="{{ route('general.courses.assignments.update', [$classTransaction, $assignment]) }}"
                                    method="POST" class="card grid grid-cols-1 gap-4" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <h2 class="text-xl font-semibold">Update Assignment</h2>
                                    <input type="text" name="title" class="form-input" placeholder="Title"
                                        value="{{ $assignment->title }}">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <input type="datetime-local" name="start_at" class="form-input" title="Start At"
                                            value="{{ $assignment->start_at->toDateTimeLocalString() }}">
                                        <input type="datetime-local" name="end_at" class="form-input" title="End At"
                                            value="{{ $assignment->end_at->toDateTimeLocalString() }}">
                                    </div>
                                    <div>
                                        <input x-ref="attachment" @change="file = $el.files[0]" type="file" name="attachment"
                                            class="hidden">
                                        <button class="btn" @click.prevent="$refs.attachment.click()">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Attach File
                                        </button>
                                    </div>
                                    <div x-cloak x-transition x-show="file" class="card grid grid-cols-12 gap-4">
                                        <div class="col-span-2 font-medium">File name</div>
                                        <div class="col-span-10" x-text="file?.name"></div>
                                        <div class="col-span-2 font-medium">File size</div>
                                        <div class="col-span-10" x-text="Number(file?.size).toLocaleString() + ' bytes'">
                                        </div>
                                        <div class="col-span-2 font-medium">Last modified at</div>
                                        <div class="col-span-10" x-text="file?.lastModifiedDate.toLocaleString()"></div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                            </svg>
                                            Submit
                                        </button>
                                        <button @click.prevent="showUpdateForm = false" class="btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endcan
                    @can('delete', $assignment)
                        <button @click="showDeletePopup = true" class="btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Delete
                        </button>
                        <div @click.outside="showDeletePopup = false" x-cloak x-transition x-show="showDeletePopup"
                            class="absolute bottom-0 left-0 z-10">
                            <form
                                action="{{ route('general.courses.assignments.delete', [$classTransaction, $assignment]) }}"
                                method="POST" class="card">
                                @csrf
                                @method('DELETE')
                                <p>Are you sure you want to delete?</p>
                                <div class="grid grid-cols-2 gap-2">
                                    <button type="submit" class="btn-danger justify-center">Yes</button>
                                    <button type="button" @click.stop="showDeletePopup = false"
                                        class="btn justify-center">No</button>
                                </div>
                            </form>
                        </div>
                    @endcan
                </div>
            </div>
            <div>
                <a href="{{ route('storage.download', $assignment->attachment) }}" class="btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Download Instructions
                </a>
            </div>
        </div>

        <div x-data="{ show: true }" class="card h-fit col-span-12 lg:col-span-8 grid gridr-cols-1 gap-4">
            <header class="flex items-center justify-between">
                <h2 class="text-xl font-semibold flex items-center">
                    <button @click="show = !show" class="mr-2">
                        <svg x-cloak x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                        <svg x-cloak x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    <span>@if (Auth::user()->role === 'student') My @else Student @endif Submissions</span>
                </h2>
            </header>
            <form x-ref="submissionForm"
                action="{{ route('general.courses.assignments.submit', [$classTransaction, $assignment]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input x-ref="submission" @change="$refs.submissionForm.submit()" type="file" name="attachment"
                    class="hidden">
                <button @click.prevent="$refs.submission.click()" class="btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    New Submission
                </button>
            </form>
            <div x-show="show" x-collapse class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mb-4">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    @if (Auth::user()->role === 'lecturer')
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name
                                        </th>
                                    @endif
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Submitted At
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($submissions as $submission)
                                    <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-100">
                                        @if (Auth::user()->role === 'lecturer')
                                            <td class="px-6 py-4 whitespace-normal text-sm font-medium text-gray-900">
                                                {{ $submission->user->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $submission->created_at }}
                                            </td>
                                        @else
                                            <td class="px-6 py-4 whitespace-normal text-sm font-medium text-gray-900">
                                                {{ $submission->created_at }}
                                            </td>
                                        @endif
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="{{ route('storage.download', $submission->attachment) }}"
                                                class="btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Download
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white hover:bg-gray-100">
                                        <td colspan="4"
                                            class="px-6 py-4 whitespace-normal text-sm text-center font-medium text-gray-900">
                                            No submissions.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
