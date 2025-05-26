<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function show()
    {
        $users = User::all();

        return view('data_user', compact('users'));
    }

    public function create(request $requst)
    {
        $user = User::all();
        return view('create_user');
    }

    // buat akun user
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'class' => 'required|string',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'class' => $request->class,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users')
            ->with('success', 'Users berhasil ditambahkan');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('name', $request->name)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    public function hapus(User $user)
    {

        $user->delete();

        return redirect()->route('users')
            ->with('success', 'User berhasil dihapus');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
