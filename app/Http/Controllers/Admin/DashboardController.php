<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContactSubmission;
use App\Models\Document;
use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\Post;
use App\Models\Service;
use App\Models\Staff;
use App\Models\User;
use App\Repositories\Contracts\ContactSubmissionRepositoryInterface;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use App\Repositories\Contracts\GalleryRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct(
        protected PostRepositoryInterface $postRepo,
        protected DocumentRepositoryInterface $documentRepo,
        protected ContactSubmissionRepositoryInterface $contactRepo,
        protected GalleryRepositoryInterface $galleryRepo,
    ) {}

    public function index()
    {
        $postCount = Post::count();
        $publishedPosts = Post::where('is_published', true)->count();
        $draftPosts = $postCount - $publishedPosts;

        $documentCount = Document::count();
        $totalDownloads = DB::table('documents')->sum('download_count');

        $galleryCount = Gallery::count();
        $totalImages = GalleryImage::count();

        $serviceCount = Service::count();
        $staffCount = Staff::count();
        $categoryCount = Category::count();
        $userCount = User::count();

        $contactCount = $this->contactRepo->unreadCount();
        $contactTotal = ContactSubmission::count();

        $recentPosts = Post::with('category')->latest()->take(5)->get();
        $recentDocuments = Document::with('category')->latest()->take(5)->get();
        $recentGalleries = Gallery::withCount('images')->latest()->take(5)->get();
        $recentContacts = $this->contactRepo->latest(5);

        return view('admin.dashboard', compact(
            'postCount', 'publishedPosts', 'draftPosts',
            'documentCount', 'totalDownloads',
            'galleryCount', 'totalImages',
            'serviceCount', 'staffCount', 'categoryCount', 'userCount',
            'contactCount', 'contactTotal',
            'recentPosts', 'recentDocuments', 'recentGalleries', 'recentContacts',
        ));
    }
}
