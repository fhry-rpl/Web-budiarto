<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ServiceRepositoryInterface;

class ServiceController extends Controller
{
    public function __construct(
        protected ServiceRepositoryInterface $serviceRepo,
    ) {}

    public function index()
    {
        $services = $this->serviceRepo->allActive();

        return view('services.index', compact('services'));
    }

    public function show(string $slug)
    {
        $service = $this->serviceRepo->findBySlug($slug);

        return view('services.show', compact('service'));
    }
}
