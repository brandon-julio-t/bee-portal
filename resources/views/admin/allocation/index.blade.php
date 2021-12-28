@extends('layout.layout')

@section('body')
    <div class="container">
        <form action="{{ route('admin.allocation') }}" method="GET" id="filter-form">
            <div class="flex flex-col sm:flex-row sm:space-x-2 space-y-4 sm:space-y-0 mb-4">
                <a href="{{ route('admin.allocation.create.view') }}" class="btn-primary justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Create
                </a>

                <div class="flex-grow">
                    <input type="text" name="q" placeholder="Search..." class="form-input" value="{{ request()->q }}">
                </div>

                <div>
                    <div x-data="{ semesterId: '{{ $activeSemester->id }}' }"
                        x-init="$watch('semesterId', () => { const form = document.querySelector('#filter-form'); form.submit(); })">
                        <select name="semester_id" class="form-input" x-model="semesterId">
                            @foreach ($semesters as $semester)
                                <option value="{{ $semester->id }}" @if ($semester->id === $activeSemester->id) selected="selected" @endif>
                                    {{ $semester->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label>
                    <input x-data type="checkbox" name="include_deleted" class="form-check" @if (request()->has('include_deleted')) checked @endif
                        @change="() => { document.querySelector('#filter-form').submit(); }">
                    Include deleted class transactions
                </label>
            </div>
        </form>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mb-4">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subject
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Classroom
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Lecturer
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
                                @foreach ($classTransactions as $classTransaction)
                                    <tr x-data
                                        @click="location.href = '{{ route('general.courses.view', $classTransaction) }}'"
                                        @if ($classTransaction->trashed()) class="{{ $loop->odd ? 'bg-red-50' : 'bg-red-100' }} hover:bg-red-200 cursor-pointer" @else class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-100 cursor-pointer" @endif>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $classTransaction->subject->code }} - {{ $classTransaction->subject->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $classTransaction->classroom->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $classTransaction->lecturer->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $classTransaction->created_at }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.allocation.update.view', $classTransaction) }}" class="btn-secondary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                    <path fill-rule="evenodd"
                                                        d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Update
                                            </a>

                                            <div x-data="{ show: false }" class="inline-block relative">
                                                @if ($classTransaction->trashed())
                                                    <button @click.stop="show = true" class="btn-danger">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0019 16V8a1 1 0 00-1.6-.8l-5.333 4zM4.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0011 16V8a1 1 0 00-1.6-.8l-5.334 4z" />
                                                        </svg>
                                                        Restore
                                                    </button>

                                                    <div x-cloak x-transition x-show="show"
                                                        class="absolute bottom-0 right-0 z-10">
                                                        <form
                                                            action="{{ route('admin.allocation.restore', $classTransaction) }}"
                                                            method="POST" class="card bg-white">
                                                            <p class="mb-2">Are you sure you want to restore?</p>
                                                            @csrf
                                                            <div class="grid grid-cols-2 gap-2">
                                                                <button type="submit"
                                                                    class="btn-danger justify-center">Yes</button>
                                                                <button type="button" @click.stop="show = false"
                                                                    class="btn justify-center">No</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                @else
                                                    <button @click.stop="show = true" class="btn-danger">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Delete
                                                    </button>

                                                    <div x-cloak x-transition x-show="show"
                                                        class="absolute bottom-0 right-0 z-10">
                                                        <form
                                                            action="{{ route('admin.allocation.delete', $classTransaction) }}"
                                                            method="POST" class="card bg-white">
                                                            <p class="mb-2">Are you sure you want to delete?</p>
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="grid grid-cols-2 gap-2">
                                                                <button type="submit"
                                                                    class="btn-danger justify-center">Yes</button>
                                                                <button type="button" @click.stop="show = false"
                                                                    class="btn justify-center">No</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $classTransactions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
