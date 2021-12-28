@extends('layout.layout')

@section('body')
    <div x-data="{ showCreateForm: false }">
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
                <header class="flex justify-between">
                    <h2 class="text-xl font-bold">Forums</h2>
                    <button @click.prevent="showCreateForm = true" class="btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Create
                    </button>
                </header>

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
                                            <tr @click="location.href = '{{ route('general.forums.view', $forum) }}'"
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

        <section x-cloak x-show="showCreateForm" class="modal" @click.self="showCreateForm = false">
            <div x-cloak x-transition x-show="showCreateForm" class="container my-8">
                <form x-data="{ file: null }"
                    action="{{ route('general.forums.create', $currentClassTransactionDetail) }}" method="POST"
                    enctype="multipart/form-data" class="card grid grid-cols-1 gap-4">
                    @csrf
                    <h2 class="text-xl font-bold">Create Forum</h2>
                    <input type="text" name="title" class="form-input" placeholder="Title">
                    <textarea name="content" rows="10" class="form-input" placeholder="Content..."></textarea>
                    <input @change="file = $el.files[0]" x-ref="attachment" type="file" name="attachment"
                        class="hidden">
                    <div>
                        <button @click.prevent="$refs.attachment.click()" class="btn">
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
                        <div class="col-span-10" x-text="Number(file?.size).toLocaleString() + ' bytes'"></div>
                        <div class="col-span-2 font-medium">Last modified at</div>
                        <div class="col-span-10" x-text="file?.lastModifiedDate.toLocaleString()"></div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <button class="justify-center btn-primary">Submit</button>
                        <button @click.prevent="showCreateForm = false" class="justify-center btn-danger">Cancel</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
