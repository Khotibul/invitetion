<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Daftar semua user (semua role).
     */
    public function index(): Response
    {
        $data = [
            'title' => 'Manajemen User',
            'list'  => route('user-management.list'),
        ];

        return response()->view('panel.user.index', compact('data'));
    }

    /**
     * DataTable JSON list.
     */
    public function list(Request $request): JsonResponse
    {
        $column = [0 => 'id', 1 => 'name', 2 => 'role', 3 => 'created_at'];

        $totalDataRecord      = User::count();
        $totalFilteredRecord  = $totalDataRecord;
        $limit_val            = $request->input('length');
        $start_val            = $request->input('start');

        $query = User::query();

        // Filter by role
        if ($request->filled('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        if (!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
            $totalFilteredRecord = $query->count();
        } else {
            $totalFilteredRecord = $query->count();
        }

        $datatable = $query->latest()->offset($start_val)->limit($limit_val)->get();

        $roleColors = [
            'developer' => 'bg-danger',
            'admin'     => 'bg-warning',
            'member'    => 'bg-primary',
        ];

        $data_val = [];
        foreach ($datatable as $key => $item) {
            $roleColor = $roleColors[$item->role] ?? 'bg-secondary';
            $editUrl   = route('user-management.edit', $item->id);
            $deleteUrl = route('user-management.destroy', $item->id);

            $data_val[$key]['name']  = anchor(text: $item->name, href: $editUrl)
                . "<small class='d-block text-muted'>{$item->email}</small>";
            $data_val[$key]['role']  = "<span class='badge {$roleColor}'>" . strtoupper($item->role) . "</span>";
            $data_val[$key]['date']  = date_info($item->created_at);
            $data_val[$key]['action'] =
                "<a href='{$editUrl}' class='btn btn-sm btn-outline-primary me-1'><i class='bx bx-edit'></i></a>"
                . "<button type='button' class='btn btn-sm btn-outline-danger btn-delete-user' "
                . "data-url='{$deleteUrl}' data-name='{$item->name}'><i class='bx bx-trash'></i></button>";
        }

        return response()->json([
            'draw'            => intval($request->input('draw')),
            'recordsTotal'    => intval($totalDataRecord),
            'recordsFiltered' => intval($totalFilteredRecord),
            'data'            => $data_val,
        ]);
    }

    /**
     * Form tambah user baru.
     */
    public function create(): Response
    {
        $data = ['title' => 'Tambah User'];
        return response()->view('panel.user.form', compact('data'));
    }

    /**
     * Simpan user baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role'     => ['required', Rule::in(['developer', 'admin', 'member'])],
        ], [
            'name.required'      => 'Nama wajib diisi.',
            'email.required'     => 'Email wajib diisi.',
            'email.unique'       => 'Email sudah digunakan.',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required'      => 'Role wajib dipilih.',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('user-management.index')
            ->with('success', "User '{$request->name}' berhasil ditambahkan.");
    }

    /**
     * Form edit user.
     */
    public function edit(int $id): Response
    {
        $user = User::findOrFail($id);
        $data = ['title' => 'Edit User'];
        return response()->view('panel.user.form', compact('data', 'user'));
    }

    /**
     * Update user.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($id)],
            'role'  => ['required', Rule::in(['developer', 'admin', 'member'])],
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'name.required'      => 'Nama wajib diisi.',
            'email.required'     => 'Email wajib diisi.',
            'email.unique'       => 'Email sudah digunakan.',
            'role.required'      => 'Role wajib dipilih.',
            'password.min'       => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->role  = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user-management.index')
            ->with('success', "User '{$user->name}' berhasil diperbarui.");
    }

    /**
     * Hapus user (soft delete).
     */
    public function destroy(int $id): JsonResponse
    {
        $user = User::findOrFail($id);

        // Jangan hapus diri sendiri
        if ($user->id === auth()->id()) {
            return response()->json(['message' => 'Tidak dapat menghapus akun sendiri.'], 403);
        }

        $user->delete();

        return response()->json(['message' => "User '{$user->name}' berhasil dihapus."]);
    }
}
