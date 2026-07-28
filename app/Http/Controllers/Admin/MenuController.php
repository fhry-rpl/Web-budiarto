<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Services\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct(
        protected MenuService $menuService,
    ) {}

    public function index()
    {
        $menus = MenuItem::root()->ordered()->with('children')->get();

        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $parents = MenuItem::root()->ordered()->get();
        $routes = $this->getAvailableRoutes();

        return view('admin.menus.form', compact('parents', 'routes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'label' => 'required|string|max:255',
            'route' => 'nullable|string|max:255',
            'params' => 'nullable|string',
            'parent_id' => 'nullable|exists:menu_items,id',
            'order' => 'nullable|integer|min:0',
            'icon' => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);

        $data['params'] = $data['params'] ?? '[]';
        $decoded = json_decode($data['params'], true);
        $data['params'] = is_array($decoded) ? $decoded : [];

        if (empty($data['route']) && $request->filled('route_custom')) {
            $data['route'] = $request->input('route_custom');
        }

        $data['is_active'] = $request->boolean('is_active', true);

        if (! isset($data['order'])) {
            $data['order'] = MenuItem::where('parent_id', $data['parent_id'])->max('order') + 1;
        }

        MenuItem::create($data);
        $this->menuService->flush();

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu berhasil dibuat.');
    }

    public function edit(MenuItem $menu)
    {
        $parents = MenuItem::root()->ordered()->where('id', '!=', $menu->id)->get();
        $routes = $this->getAvailableRoutes();

        return view('admin.menus.form', compact('menu', 'parents', 'routes'));
    }

    public function update(Request $request, MenuItem $menu)
    {
        $data = $request->validate([
            'label' => 'required|string|max:255',
            'route' => 'nullable|string|max:255',
            'params' => 'nullable|string',
            'parent_id' => 'nullable|exists:menu_items,id',
            'order' => 'nullable|integer|min:0',
            'icon' => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);

        $data['params'] = $data['params'] ?? '[]';
        $decoded = json_decode($data['params'], true);
        $data['params'] = is_array($decoded) ? $decoded : [];

        if (empty($data['route']) && $request->filled('route_custom')) {
            $data['route'] = $request->input('route_custom');
        }

        $data['is_active'] = $request->boolean('is_active', true);

        if ($data['parent_id'] == $menu->id) {
            $data['parent_id'] = $menu->parent_id;
        }

        $menu->update($data);
        $this->menuService->flush();

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(MenuItem $menu)
    {
        $menu->delete();
        $this->menuService->flush();

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu berhasil dihapus.');
    }

    public function reorder(Request $request)
    {
        $data = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:menu_items,id',
            'items.*.order' => 'required|integer|min:0',
            'items.*.parent_id' => 'nullable|exists:menu_items,id',
        ]);

        foreach ($data['items'] as $item) {
            MenuItem::where('id', $item['id'])->update([
                'order' => $item['order'],
                'parent_id' => $item['parent_id'] ?? null,
            ]);
        }

        $this->menuService->flush();

        return response()->json(['success' => true]);
    }

    protected function getAvailableRoutes(): array
    {
        return [
            'home' => 'Beranda',
            'posts.index' => 'Berita',
            'posts.show' => 'Berita (Detail)',
            'pengumuman.index' => 'Pengumuman',
            'documents.index' => 'Dokumen',
            'documents.show' => 'Dokumen (Detail)',
            'services.index' => 'Layanan',
            'services.show' => 'Layanan (Detail)',
            'galleries.index' => 'Galeri',
            'galleries.show' => 'Galeri (Detail)',
            'contact.index' => 'Kontak',
            'search' => 'Pencarian',
            'profile.page' => 'Halaman Profil',
        ];
    }
}
