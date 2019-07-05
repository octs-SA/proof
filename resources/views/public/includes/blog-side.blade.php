<aside class="col-md-3">
    <!-- Widget [Search Bar Widget]-->
    <div class="widget search">
        <header>
            <h3 class="h6">Search the blog</h3>
        </header>
        <form action="#" class="search-form">
            <div class="form-group">
                <input type="search" class="form-control" placeholder="What are you looking for?">
                <button type="submit" class="btn btn-sucess"><i class="icon-search fa fa-search"></i></button>
            </div>
        </form>
    </div>
    <!-- Widget [Latest Posts Widget]        -->
    <div class="widget latest-posts">
        <header>
            <h3 class="h6">Latest Posts</h3>
        </header>
        <div class="blog-posts">
            @foreach ($latestPosts as $post)
                <a href="{{ route('blog.post', $post->slug) }}">
                    <div class="item d-flex align-items-center">
                        <div class="image">
                            <img src="{{ asset('images/blog/small/'.$post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                        </div>
                        <div class="title">
                            <strong>{{ $post->title }}</strong>
                            <div class="d-flex align-items-center">
                                <div class="views">
                                    <i class="icon-eye fa fa-eye"></i> {{ $post->view_count }}
                                </div>
                                <div class="comments">
                                    <i class="icon-comment fa fa-comment"></i> {{ $post->comments()->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Widget [Categories Widget]-->
    <div class="widget categories">
        <header>
            <h3 class="h6">Categories</h3>
        </header>
        @foreach ($categories as $category)
            <div class="item d-flex justify-content-between">
                <a href="{{ route('blog.category', $category->slug) }}">
                    {{ ucfirst($category->name) }}
                </a>
                <span>{{ count($category->posts) }}</span>
            </div>
        @endforeach
    </div>

    <!-- Widget [Tags Cloud Widget]-->
    <div class="widget tags">
        <header>
            <h3 class="h6">Tags</h3>
        </header>
        <ul class="list-inline">
            @foreach ($tags as $tag)
                <li class="list-inline-item">
                    <a href="{{ route('tag.post', $tag->slug) }}" class="tag">
                        <i class="fa fa-tag"></i>{{ ucfirst($tag->name) }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</aside>
