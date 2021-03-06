<aside class="col-md-4">
    <!-- Widget [Search Bar Widget]-->
    <div class="widget search">
        <header>
            <h3 class="h6">Search the blog</h3>
        </header>
        <form action="" method="GET" class="search-form">
            @csrf
            <div class="form-group">
                <input type="text" name="search" placeholder="What are you looking for?" value="{{ request()->query('search') }}">
                <button type="submit" class="submit">
                    <i class="icon-search fas fa-search"></i>
                </button>
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
                            <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                        </div>
                        <div class="title">
                            <strong>{{ $post->title }}</strong>
                            <div class="d-flex align-items-center">
                                <div class="views">
                                    <i class="icon-eye fas fa-eye"></i> {{ $post->view_count }}
                                </div>
                                <div class="date">
                                    <i class="icon-date fas fa-clock"></i> {{ $post->created_at->diffForHumans() }}
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
