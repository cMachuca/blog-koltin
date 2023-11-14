<x-blog-layout>
    <x-blog-header :header="$author->name" />

    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <!-- Post preview-->
                @if($author->comments === null)
                    <div class="post-preview">
                        This user does not have comments
                    </div>
                @endif

                @foreach($author->comments as $comment)
                    <div class="post-preview">
                        <a href="#">
                            <h2 class="post-title"></h2>
                            <h3 class="post-subtitle">{{ $comment->content }}</h3>
                        </a>
                        <p class="post-meta">
                            Commented by
                            <a href="#">{{ $comment->user->name }}</a>
                            on {{ $comment->created_at->toFormattedDateString() }}
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                @endforeach

                <!-- Pager-->
                <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>
            </div>
        </div>
    </div>
</x-blog-layout>
