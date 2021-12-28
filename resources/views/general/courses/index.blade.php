@extends('layout.layout')

@section('body')
    <div class="container">
        <div class="card">
            <h2 class="text-xl font-bold mb-4">My Courses</h2>

            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Subject
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Class
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Lecturer
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($classes as $class)
                                        <tr @click="location.href = '{{ route('general.courses.view', $class) }}'"
                                            class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-100 cursor-pointer">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                [{{ $class->subject->code }}]
                                                {{ $class->subject->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $class->classroom->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $class->lecturer->name }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="bg-white">
                                            <td class="text-center py-4 font-bold" colspan="4">
                                                No class for today.
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
    </div>
@endsection
