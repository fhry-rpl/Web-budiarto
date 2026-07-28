<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\DocumentRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct(
        protected PostRepositoryInterface $postRepo,
        protected DocumentRepositoryInterface $documentRepo,
    ) {}

    public function index(Request $request)
    {
        $query = $request->query('q', '');

        if (empty($query)) {
            return view('search', ['query' => '', 'posts' => collect(), 'documents' => collect()]);
        }

        $posts = $this->postRepo->search($query, 5);
        $documents = $this->documentRepo->search($query, 5);

        return view('search', compact('query', 'posts', 'documents'));
    }
}
