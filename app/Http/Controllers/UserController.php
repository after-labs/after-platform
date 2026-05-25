<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // ── Search: name, email or ID ─────────────────────────
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name',  'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%")
                  ->orWhere('id',    $s);
            });
        }

        // ── Filter tab ────────────────────────────────────────
        match ($request->input('filter', 'all')) {
            'active'   => $query->where('status', 'active'),
            'inactive' => $query->where('status', 'inactive'),
            'admin'    => $query->where('role',   'admin'),
            default    => null,
        };

        $totalUsers = User::count();
        $users      = $query->latest()->paginate(5)->withQueryString();

        return view('backend.users.index', compact('users', 'totalUsers'));
    }

    public function create()
    {
        return view('backend.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role'     => ['required', Rule::in(['client', 'admin'])],
            'status'   => ['required', Rule::in(['active', 'inactive'])],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', __('User created successfully!'));
    }

    public function edit(User $user)
    {
        return view('backend.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'   => ['required', 'string', 'max:255'],
            'email'  => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role'   => ['required', Rule::in(['client', 'admin'])],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        // Only update password if provided
        if ($request->filled('password')) {
            $request->validate(['password' => ['min:8', 'confirmed']]);
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', __('User updated successfully!'));
    }

    public function delete(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', __('User deleted.'));
    }

    // ── Inline update: role or status via AJAX ────────────────
    public function updateField(Request $request, User $user)
    {
        $field = $request->input('field');
        $value = $request->input('value');

        abort_unless(in_array($field, ['role', 'status']), 422, 'Invalid field.');

        $allowed = match ($field) {
            'role'   => ['client', 'admin'],
            'status' => ['active', 'inactive'],
        };

        abort_unless(in_array($value, $allowed), 422, 'Invalid value.');

        $user->update([$field => $value]);

        return response()->json(['ok' => true, 'field' => $field, 'value' => $value]);
    }
}