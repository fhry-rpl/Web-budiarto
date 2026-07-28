<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $posts = Post::where('is_published', true)
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->get();

        $services = Service::where('is_active', true)->orderBy('order')->get();

        $galleries = Gallery::where('is_published', true)
            ->latest('published_at')
            ->get();

        $pages = Page::where('is_published', true)->get();

        $content = view('sitemap', compact('posts', 'services', 'galleries', 'pages'))->render();

        return response($content, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}
