<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
    //     $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    // }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $users = User::query()
        ->when($search, fn ($query, $search) =>
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
        )
        ->paginate(10);

        return view('users/user-management', compact('users', 'search'));
    }

    public function create()
    {
        $roles = ['superadmin', 'admin', 'operator', 'owner'];
        return view('users/user-create')->with('roles', $roles);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'string', Password::min(8)->mixedCase()->numbers()],
            'password_confirmation' => 'required|same:password',
            'role' => 'required|in:superadmin,admin,operator,owner',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('user-management.index')->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('user.show', compact('user'));
    }

    public function status($id)
    {
        $user = User::find($id);
        $user->update([
            'is_active' => ! $user->is_active]);
        return redirect()->route('user-management.index')->with('success', 'User status updated successfully.');
    }

    public function edit($id)
    {
        $users = User::find($id);
        $roles = ['superadmin', 'admin', 'operator', 'owner'];
        return view('users/user-edit', compact('users'))->with('roles', $roles);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $id,
            'address' => 'required',
            'phone' => 'required|numeric',
            'role' => 'required|in:superadmin,admin,operator,owner',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('user-management.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('user-management.index')->with('success', 'User deleted successfully.');
    }
}
