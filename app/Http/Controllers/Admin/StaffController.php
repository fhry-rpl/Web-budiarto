<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Repositories\Contracts\StaffRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function __construct(
        protected StaffRepositoryInterface $staffRepo,
    ) {}

    public function index()
    {
        $staff = $this->staffRepo->all();

        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        return view('admin.staff.form');
    }

    public function store(StoreStaffRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('staff', 'uploads');
        }
        $this->staffRepo->create($data);

        return redirect()->route('admin.staff.index')
            ->with('success', 'Staf berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $staff = $this->staffRepo->findById($id);

        return view('admin.staff.form', compact('staff'));
    }

    public function update(UpdateStaffRequest $request, int $id)
    {
        $data = $request->validated();
        if ($request->hasFile('photo')) {
            $old = $this->staffRepo->findById($id);
            if ($old->photo) {
                Storage::disk('uploads')->delete($old->photo);
            }
            $data['photo'] = $request->file('photo')->store('staff', 'uploads');
        }
        $this->staffRepo->update($id, $data);

        return redirect()->route('admin.staff.index')
            ->with('success', 'Staf berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $staff = $this->staffRepo->findById($id);
        if ($staff->photo) {
            Storage::disk('uploads')->delete($staff->photo);
        }
        $this->staffRepo->delete($id);

        return redirect()->route('admin.staff.index')
            ->with('success', 'Staf berhasil dihapus.');
    }
}
