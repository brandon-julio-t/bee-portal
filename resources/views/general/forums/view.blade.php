@extends('layout.layout')

@section('body')
    <div class="container grid grid-cols-1 gap-4">
        <div class="card">
            <h2 class="text-xl font-bold mb-2">{{ $forumThread->title }}</h2>
            <small>
                <span class="font-medium">{{ $forumThread->user->name }}</span>
                &bull;
                {{ $forumThread->created_at->toDayDateTimeString() }}
            </small>
            <div class="my-4">{!! nl2br(e($forumThread->content)) !!}</div>
            @if ($forumThread->attachment)
                <div>
                    <a target="_blank" href="{{ route('storage.download', $forumThread->attachment) }}"
                        class="btn">Download Attachments</a>
                </div>
            @endif
        </div>

        <form x-data="{ file: null }" action="{{ route('general.forums.reply-thread', $forumThread) }}" method="POST"
            class="card grid grid-cols-1 gap-4" enctype="multipart/form-data" accept=".zip,.rar">
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

        <div class="card grid grid-cols-1 gap-4">
            <h2 class="text-xl font-bold">Replies</h2>

            @forelse ($replies as $reply)
                <div class="card">
                    <h3 class="text-md font-bold">{{ $reply->user->name }}</h3>
                    <small>{{ $forumThread->created_at->toDayDateTimeString() }}</small>
                    <div class="my-4">{!! nl2br(e($reply->content)) !!}</div>
                    @if ($reply->attachment)
                        <div>
                            <a href="{{ route('storage.download', $reply->attachment) }}" class="btn">
                                Download Attachments
                            </a>
                        </div>
                    @endif
                </div>
            @empty
                <h3 class="text-lg font-bold text-center">
                    No reply yet.
                </h3>
            @endforelse
        </div>
    </div>
@endsection
