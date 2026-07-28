<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct(
        protected PostRepositoryInterface $postRepo,
        protected CategoryRepositoryInterface $categoryRepo,
    ) {}

    public function index()
    {
        $posts = $this->postRepo->all(15);

        return view('admin.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function create()
    {
        $categories = $this->categoryRepo->all();

        return view('admin.posts.form', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('posts/thumbnails', 'uploads');
        }
        $data['user_id'] = auth()->id();
        Post::create($data);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Postingan berhasil dibuat.');
    }

    public function edit(Post $post)
    {
        $categories = $this->categoryRepo->all();

        return view('admin.posts.form', compact('post', 'categories'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail) {
                Storage::disk('uploads')->delete($post->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('posts/thumbnails', 'uploads');
        }
        $post->update($data);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Postingan berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        if ($post->thumbnail) {
            Storage::disk('uploads')->delete($post->thumbnail);
        }
        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Postingan berhasil dihapus.');
    }
}
