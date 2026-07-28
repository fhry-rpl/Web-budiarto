<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\ContactSubmission;
use App\Models\Document;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use App\Models\Staff;
use App\Policies\CategoryPolicy;
use App\Policies\ContactSubmissionPolicy;
use App\Policies\DocumentPolicy;
use App\Policies\GalleryPolicy;
use App\Policies\PagePolicy;
use App\Policies\PostPolicy;
use App\Policies\ServicePolicy;
use App\Policies\StaffPolicy;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ContactSubmissionRepositoryInterface;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use App\Repositories\Contracts\GalleryRepositoryInterface;
use App\Repositories\Contracts\PageRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\ServiceRepositoryInterface;
use App\Repositories\Contracts\SettingRepositoryInterface;
use App\Repositories\Contracts\StaffRepositoryInterface;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\ContactSubmissionRepository;
use App\Repositories\Eloquent\DocumentRepository;
use App\Repositories\Eloquent\GalleryRepository;
use App\Repositories\Eloquent\PageRepository;
use App\Repositories\Eloquent\PostRepository;
use App\Repositories\Eloquent\ServiceRepository;
use App\Repositories\Eloquent\SettingRepository;
use App\Repositories\Eloquent\StaffRepository;
use App\View\Composers\NavigationComposer;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(DocumentRepositoryInterface::class, DocumentRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(GalleryRepositoryInterface::class, GalleryRepository::class);
        $this->app->bind(PageRepositoryInterface::class, PageRepository::class);
        $this->app->bind(StaffRepositoryInterface::class, StaffRepository::class);
        $this->app->bind(ContactSubmissionRepositoryInterface::class, ContactSubmissionRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
    }

    public function boot(): void
    {
        Gate::policy(Post::class, PostPolicy::class);
        Gate::policy(Document::class, DocumentPolicy::class);
        Gate::policy(Category::class, CategoryPolicy::class);
        Gate::policy(Service::class, ServicePolicy::class);
        Gate::policy(Gallery::class, GalleryPolicy::class);
        Gate::policy(Page::class, PagePolicy::class);
        Gate::policy(Staff::class, StaffPolicy::class);
        Gate::policy(ContactSubmission::class, ContactSubmissionPolicy::class);

        View::composer(['layouts.front', 'components.navigation'], NavigationComposer::class);

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
