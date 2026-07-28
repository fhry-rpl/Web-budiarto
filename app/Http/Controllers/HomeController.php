<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\DocumentRepositoryInterface;
use App\Repositories\Contracts\GalleryRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\ServiceRepositoryInterface;
use App\Repositories\Contracts\SettingRepositoryInterface;

class HomeController extends Controller
{
    public function __construct(
        protected PostRepositoryInterface $postRepo,
        protected ServiceRepositoryInterface $serviceRepo,
        protected GalleryRepositoryInterface $galleryRepo,
        protected DocumentRepositoryInterface $documentRepo,
        protected SettingRepositoryInterface $settingRepo,
    ) {}

    public function index()
    {
        $services = $this->serviceRepo->allActive();
        $latestPosts = $this->postRepo->latest(3);
        $pengumuman = $this->postRepo->publishedByCategory('pengumuman', 5)->items();
        $latestGalleries = $this->galleryRepo->latest(3);
        $settings = $this->settingRepo->getAll();

        return view('home', compact(
            'services',
            'latestPosts',
            'pengumuman',
            'latestGalleries',
            'settings',
        ));
    }
}
