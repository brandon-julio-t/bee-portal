@extends('layout.layout')

@section('body')
    <div x-data="{ showModal: false, action: '', classroomId: '', classroomName: '' }">
        <div class="container">
            <div class="flex flex-col sm:flex-row sm:space-x-2 space-y-4 sm:space-y-0 mb-4">
                <button @click="() => { showModal = true; action = 'Create'; classroomId = ''; classroomName = ''; }"
                    class="btn-primary justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Create
                </button>

                <form action="{{ route('admin.manage-classrooms') }}" class="flex-grow">
                    <input type="text" name="q" placeholder="Search..." class="form-input" value="{{ request()->q }}">
                </form>
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
                                            Name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Created At
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($classrooms as $classroom)
                                        <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-100   ">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $classroom->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $classroom->created_at }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button
                                                    @click="() => { showModal = true; action = 'Update'; classroomId = '{{ $classroom->id }}'; classroomName = '{{ $classroom->name }}'; }"
                                                    class="btn-secondary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path
                                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                        <path fill-rule="evenodd"
                                                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Update
                                                </button>

                                                <div x-data="{ showDeleteDialog: false }" class="inline-block relative">
                                                    <div x-cloak x-transition x-show="showDeleteDialog"
                                                        class="absolute bottom-0 right-0 z-10">
                                                        <form
                                                            action="{{ route('admin.manage-classrooms.delete', $classroom) }}"
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $classrooms->links() }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Create Modal --}}
        <div x-cloak x-transition x-show="showModal">
            <div class="modal">
                <div class="max-w-md mx-auto mt-8">
                    <form action="{{ route('admin.manage-classrooms.update-or-create') }}" method="POST"
                        class="card grid grid-cols-1 gap-4">
                        @csrf
                        <div class="flex justify-between">
                            <h2 class="font-medium">
                                <span x-text="action"></span>
                                Classroom
                            </h2>
                            <button type="button" @click="showModal = false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <input type="hidden" name="id" x-model="classroomId">
                        <input type="text" name="name" placeholder="Name" class="form-input" x-model="classroomName">
                        <button type="submit" class="btn-primary justify-center">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
