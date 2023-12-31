<x-blog-layout>
    <!-- Page Header-->
    <x-blog-header :header="'Koltin Blog'" />

    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <!-- Post preview-->
                @foreach($posts as $post)
                    <div class="post-preview">
                        <a href="{{ route('single-post', $post->slug) }}">
                            <h2 class="post-title">{{ $post->title }}</h2>
                            <h3 class="post-subtitle">{{ $post->content }}</h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="#!">{{ $post->author->name }}</a>
                            on {{ $post->created_at->toFormattedDateString() }}
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
