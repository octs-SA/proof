<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Model\Post;
use App\Model\Category;
use App\Model\Tag;

class BlogController extends Controller
{
    public function index()
    {
        $data = [
            'posts' => Post::latest()->simplePaginate(4),
            'latestPosts' => Post::latest()->limit(3)->get(),
            'categories' => Category::with('posts')->get(),
            'tags' => Tag::all()
        ];
        return view('public.blog.all-posts')->with($data);
    }

    public function singlePost($slug)
    {
        $data = [
            'post' => Post::where(['slug' => $slug])->searched()->first(),
//            'latestPosts' => Post::latest()->limit(3)->get(),
            'categories' => Category::with('posts')->get(),
            'tags' => Tag::all()
        ];

        $postss = Post::where(['slug' => $slug])->first();

        $blogKey = 'blog_' . $postss->id;

        if (!Session::has($blogKey)) {
            $postss->increment('view_count');
            Session::put($blogKey, 1);
        }

       // $randomposts = Post::approved()->published()->take(3)->inRandomOrder()->get();

        return view('public.blog.single-post')->with($data);
    }

    public function postByCategory(Category $category, $slug)
    {
        // $cats = Category::with('posts')->get();
        // echo "<pre>"; print_r($cats); die;

        $data = [
            'category' => Category::where('slug', $slug)->with('posts')->first(),
            'posts' => $category->posts()->searched()->simplePaginate(4),
            'categories' => Category::with('posts')->get(),
            'tags' => Tag::all()
        ];
        return view('public.blog.categories')->with($data);
    }

    public function postsByTag($slug)
    {
        $data = [
            'tag' => Tag::where('slug', $slug)->with('posts')->first(),
//            'latestPosts' => Post::latest()->limit(3)->get(),
            'categories' => Category::with('posts')->get(),
            'tags' => Tag::all()
        ];
        return view('public.blog.tag')->with($data);
    }
}
