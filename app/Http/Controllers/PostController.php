<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PostRepositoryInterface;

class PostController extends Controller
{
    public function __construct(
        protected PostRepositoryInterface $postRepo,
    ) {}

    public function index()
    {
        $posts = $this->postRepo->publishedByCategory('post', 12);

        return view('posts.index', compact('posts'));
    }

    public function pengumuman()
    {
        $posts = $this->postRepo->publishedByCategory('pengumuman', 12);

        return view('posts.index', compact('posts'));
    }

    public function show(string $slug)
    {
        $post = $this->postRepo->findPublished($slug);

        return view('posts.show', compact('post'));
    }
}
