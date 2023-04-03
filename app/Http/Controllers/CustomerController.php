<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class CustomerController extends Controller
{
    public function index()
    {
        $users = User::latest()->where('role', 'customer')->get();
        return view('employees/customer')->with('users', $users);
    }
    public function show($id)
    {
        $user = User::find($id);
        return view('user.show', compact('user'));
    }

    public function create()
    {
        $roles = ['superadmin', 'admin', 'operator', 'owner'];
        return view('employees/customer-create')->with('roles', $roles);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|digits:10',
            'address' => 'required',
            'role' => 'required|in:superadmin,admin,operator,owner',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('customer.index')->with('success', 'User created successfully.');
    }

    public function status($id)
    {
        $user = User::find($id);
        $user->update([
            'is_active' => ! $user->is_active]);
        return redirect()->route('customer.index')->with('success', 'User status updated successfully.');

    }

    public function edit($id)
    {
        $users = User::find($id);
        $roles = ['superadmin', 'admin', 'operator', 'owner'];
        return view('employees/customer-edit', compact('users'))->with('roles', $roles);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:superadmin,admin,operator,owner',
            'phone' => 'required|numeric|digits:10',
            'address' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('customer.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('customer.index')->with('success', 'User deleted successfully.');
    }

}
