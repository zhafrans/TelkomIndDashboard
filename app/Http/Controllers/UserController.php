<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.user.index', compact('users'));
    }

    public function store(Request $request)
{
    $request->validate([
        'username' => 'required|unique:users',
        'password' => 'required',
    ]);

    User::create([
        'username' => $request->username,
        'password' => bcrypt($request->password),
    ]);

    return redirect()->route('admin.user')->with('success', 'User added successfully.');
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|unique:users,username,' . $id,
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'username' => $request->username,
        ]);

        return redirect()->route('admin.user')->with('success', 'User data updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user')->with('success', 'User deleted successfully.');
    }
}
