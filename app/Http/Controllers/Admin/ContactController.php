<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ContactSubmissionRepositoryInterface;

class ContactController extends Controller
{
    public function __construct(
        protected ContactSubmissionRepositoryInterface $contactRepo,
    ) {}

    public function index()
    {
        $submissions = $this->contactRepo->all(15);

        return view('admin.contacts.index', compact('submissions'));
    }

    public function show(int $id)
    {
        $submission = $this->contactRepo->findById($id);
        $this->contactRepo->markAsRead($id);

        return view('admin.contacts.show', compact('submission'));
    }

    public function destroy(int $id)
    {
        $this->contactRepo->delete($id);

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}
