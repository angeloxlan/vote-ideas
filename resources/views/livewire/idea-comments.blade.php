<div>
    @if ($comments->isNotEmpty())
        <div class="comments-container relative space-y-6 md:ml-22 pt-4 my-8 mt-1">
            @foreach ($comments as $comment)
                <livewire:idea-comment 
                    :key="$comment->id"
                    :comment="$comment"
                    :ideaUserId="$idea->user->id" />
            @endforeach
        </div><!-- fin comments-container -->
    @else
        <div class="mx-auto w-70 mt-12">
            <img src="{{ asset('img/no-ideas.svg') }}" alt="No Ideas"
                class="mx-auto">
            <div class="text-gray-400 text-center font-bold mt-6">This idea has no comments yet...</div>
        </div>
    @endif
</div>