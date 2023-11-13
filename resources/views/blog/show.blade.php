<x-blog-layout>
    <!-- Page Header -->
    <x-blog-header :header="$post->title" :user="$post->author" />

    <!-- Post Content -->
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    {!! $post->content !!}
                </div>
            </div>

            <!--           Comments Area -->
            <div class="col-lg-8 col-md-10 mx-auto comment">
                <h3>Comments</h3>
                <ul class="commentList">
                    @foreach($post->comments as $comment)
                        <li>
                            <div class="commenterImage">
                                <img src="{{ $comment->user->avatar }}"/>
                            </div>
                            <div class="commentText">
                                {{ $comment->content }}
                                <span class="date sub-text">{{ $comment->user->name }} at {{ $comment->created_at->toFormattedDateString() }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </article>
</x-blog-layout>
