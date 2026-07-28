<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactSubmissionRequest;
use App\Repositories\Contracts\ContactSubmissionRepositoryInterface;

class ContactController extends Controller
{
    public function __construct(
        protected ContactSubmissionRepositoryInterface $contactRepo,
    ) {}

    public function index()
    {
        return view('contact');
    }

    public function store(StoreContactSubmissionRequest $request)
    {
        $this->contactRepo->create($request->validated());

        return redirect()->route('contact.index')
            ->with('success', 'Pesan Anda telah dikirim. Terima kasih.');
    }
}
