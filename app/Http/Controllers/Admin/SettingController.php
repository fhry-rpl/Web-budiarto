<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingRequest;
use App\Repositories\Contracts\SettingRepositoryInterface;

class SettingController extends Controller
{
    public function __construct(
        protected SettingRepositoryInterface $settingRepo,
    ) {}

    public function index()
    {
        $settings = $this->settingRepo->getAll();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(UpdateSettingRequest $request)
    {
        foreach ($request->validated()['settings'] as $key => $value) {
            $this->settingRepo->set($key, $value);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
