@extends('layout.layout')

@section('body')
    <form x-data="{ ctid: '{{ $classTransaction->id }}', currentSession: {{ $currentSession }} }" action=""
        class="container grid grid-cols-1 gap-4">
        <section class="card">
            <h2 class="text-xl font-bold mb-4">Course</h2>

            <div class="grid grid-cols-2 sm:grid-cold-3 md:grid-cols-4 gap-4">
                @foreach ($classTransactions as $class)
                    <button @click="ctid = '{{ $class->id }}'"
                        :class="{
                            'btn': ctid !== '{{ $class->id }}',
                            'btn-secondary': ctid === '{{ $class->id }}'
                        }">
                        <label class="text-left cursor-pointer flex items-center my-2">
                            <input type="radio" name="ctid" value="{{ $class->id }}" class="hidden"
                                :checked="ctid === '{{ $class->id }}'">
                            [{{ $class->subject->code }}]
                            {{ $class->subject->name }}
                        </label>
                    </button>
                @endforeach
            </div>
        </section>

        <section class="card grid grid-cols-1 gap-4">
            <h2 class="text-xl font-bold">Forums</h2>

            <div class="flex space-x-2 flex-wrap">
                @foreach ($sessions as $session)
                    <button @click="currentSession = {{ $session }}" class="flex-grow justify-center"
                        :class="{
                            'btn': currentSession !== {{ $session }} && {{ $session }} !== {{ $latestSession }},
                            'btn-primary': currentSession === {{ $session }},
                            'btn-secondary': {{ $session }} === {{ $latestSession }} && currentSession !== {{ $session }},
                        }">
                        <label class="text-left cursor-pointer flex items-center">
                            <input type="radio" name="s" value="{{ $session }}" class="hidden"
                                :checked="currentSession === {{ $session }}">
                            {{ $session }}
                        </label>
                    </button>
                @endforeach
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
                                            Title
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Created By
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Created At
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($forums as $forum)
                                        <tr
                                            class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-100 cursor-pointer">
                                            <td class="px-6 py-4 whitespace-normal text-sm font-medium text-gray-900">
                                                {{ $forum->title }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $forum->user->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $forum->created_at }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="bg-white">
                                            <td class="text-center py-4 font-bold" colspan="5">
                                                No forums yet.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{ $forums->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection
