@extends('layout.layout')

@section('body')
    <div class="container grid grid-cols-1 gap-4">
        <div x-data="{ showUpdateForm: false, showDeletePopup: false, }" class="card">
            <h2 class="text-xl font-bold mb-2">{{ $forumThread->title }}</h2>
            <small>
                <span class="font-medium">{{ $forumThread->user->name }}</span>
                &bull;
                {{ $forumThread->created_at->toDayDateTimeString() }}
            </small>
            <div class="my-4">{!! nl2br(e($forumThread->content)) !!}</div>
            @if ($forumThread->attachment)
                <div class="mb-4">
                    <a href="{{ route('storage.download', $forumThread->attachment) }}" class="btn">
                        Download Attachments
                    </a>
                </div>
            @endif

            <div>
                @can('update', $forumThread)
                    <button @click="showUpdateForm = true" class="btn">
                        <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                            <path fill-rule="evenodd"
                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                clip-rule="evenodd" />
                        </svg>
                        Edit
                    </button>

                    <div @click.self="showUpdateForm = false" x-cloak x-show="showUpdateForm" class="modal">
                        <div x-cloak x-transition x-show="showUpdateForm" class="container my-8">
                            <form x-data="{ file: null }" action="{{ route('general.forums.update', $forumThread) }}"
                                method="POST" enctype="multipart/form-data" class="card grid grid-cols-1 gap-4">
                                @method('PUT')
                                @csrf
                                <h2 class="text-xl font-bold">Update Forum</h2>
                                <input type="text" name="title" class="form-input" placeholder="Title"
                                    value="{{ $forumThread->title }}">
                                <textarea name="content" rows="10" class="form-input"
                                    placeholder="Content...">{{ $forumThread->content }}</textarea>
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
                                    <button @click.prevent="showUpdateForm = false"
                                        class="justify-center btn-danger">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endcan

                @can('delete', $forumThread)
                    <button @click="showDeletePopup = true" class="btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Delete
                    </button>

                    <div @click.outside="showDeletePopup = false" x-cloak x-transition x-show="showDeletePopup"
                        class="absolute z-10">
                        <form action="{{ route('general.forums.delete', $forumThread) }}" method="POST"
                            class="card bg-white">
                            @csrf
                            @method('DELETE')
                            <p class="mb-2">Are you sure you want to delete?</p>
                            <div class="grid grid-cols-2 gap-2">
                                <button class="btn-danger justify-center">Yes</button>
                                <button type="button" @click="showDeletePopup = false" class="btn justify-center">No</button>
                            </div>
                        </form>
                    </div>
                @endcan
            </div>
        </div>

        <form x-data="{ file: null }" action="{{ route('general.forums.replies.create', $forumThread) }}" method="POST"
            class="card grid grid-cols-1 gap-4" enctype="multipart/form-data">
            @csrf
            <h2 class="text-xl font-bold">Reply</h2>
            <textarea class="form-input" name="content" rows="10"></textarea>
            <input x-ref="attachment" type="file" name="attachment" class="hidden" @change="file = $el.files[0]">
            <div>
                <button @click="$refs.attachment.click()" class="btn" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    Attach File
                </button>
                <button class="btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                    </svg>
                    Submit
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
        </form>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('forumReplies', () => ({
                    currentUserId: '{{ Auth::id() }}',
                    url: '{{ route('forums.replies', $forumThread) }}',
                    isLoading: false,
                    replies: [],
                    fetchReplies() {
                        if (this.isLoading || !this.url) return;
                        (async () => {
                            this.isLoading = true;
                            const resp = await axios.get(this.url);
                            this.replies = [...this.replies, ...resp.data.data];
                            this.url = resp.data.next_page_url;
                            this.isLoading = false;
                        })();
                    }
                }));
            });
        </script>
        <div x-data="forumReplies" class="card grid grid-cols-1 gap-4">
            <h2 class="text-xl font-bold">Replies</h2>

            <div x-cloak x-transition x-show="replies.length" class="grid grid-cols-1 gap-4 mb-4">
                <template x-for="reply in replies">
                    <div class="card">
                        <h3 class="text-md font-bold" x-text="reply.user?.name ?? '-'"></h3>
                        <small x-text="new Date(reply.created_at).toLocaleString()"></small>
                        <div class="my-4 whitespace-pre-line" x-text="reply.content"></div>
                        <div x-cloak x-transition x-show="reply.attachment" class="mb-4">
                            <a :href="`/storage/${reply.attachment}`" class="btn">
                                Download Attachments
                            </a>
                        </div>
                        <div x-show="reply.user?.id === currentUserId"
                            x-data="{ showUpdateForm: false, showDeletePopup: false }">
                            <button @click="showUpdateForm = true" class="btn">
                                <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                    <path fill-rule="evenodd"
                                        d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                        clip-rule="evenodd" />
                                </svg>
                                Edit
                            </button>

                            <div @click.self="showUpdateForm = false" x-cloak x-show="showUpdateForm"
                                class="modal">
                                <div x-cloak x-transition x-show="showUpdateForm" class="container my-8">
                                    <form x-data="{ file: null }"
                                        :action="`{{ route('general.forums.replies.update', [$forumThread, '']) }}/${reply.id}`"
                                        method="POST" class="card grid grid-cols-1 gap-4" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <h2 class="text-xl font-bold">Edit Reply</h2>
                                        <textarea class="form-input" name="content" rows="10"
                                            x-text="reply.content"></textarea>
                                        <input x-ref="attachment" type="file" name="attachment" class="hidden"
                                            @change="file = $el.files[0]">
                                        <div>
                                            <button @click="$refs.attachment.click()" class="btn" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Attach File
                                            </button>
                                            <button class="btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                                </svg>
                                                Submit
                                            </button>
                                        </div>
                                        <div x-cloak x-transition x-show="file" class="card grid grid-cols-12 gap-4">
                                            <div class="col-span-2 font-medium">File name</div>
                                            <div class="col-span-10" x-text="file?.name"></div>
                                            <div class="col-span-2 font-medium">File size</div>
                                            <div class="col-span-10"
                                                x-text="Number(file?.size).toLocaleString() + ' bytes'"></div>
                                            <div class="col-span-2 font-medium">Last modified at</div>
                                            <div class="col-span-10" x-text="file?.lastModifiedDate.toLocaleString()">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

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
                                class="absolute z-10">
                                <form
                                    :action="`{{ route('general.forums.replies.delete', [$forumThread, '']) }}/${reply.id}`"
                                    method="POST" class="card bg-white">
                                    @csrf
                                    @method('DELETE')
                                    <p class="mb-2">Are you sure you want to delete?</p>
                                    <div class="grid grid-cols-2 gap-2">
                                        <button class="btn-danger justify-center">Yes</button>
                                        <button type="button" @click="showDeletePopup = false"
                                            class="btn justify-center">No</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <div x-intersect="fetchReplies()" x-show="!isLoading && url" class="h-8"></div>

            <div x-cloack x-transition x-show="isLoading" class="flex justify-center">
                <svg class="animate-spin -ml-1 mr-3 h-8 w-8 text-black" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </div>


            <h3 x-cloak x-transition x-show="replies.length === 0 && !isLoading" class="text-lg font-bold text-center">
                No reply yet.
            </h3>
        </div>
    </div>
@endsection
