<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Prikaz svih korisnika u JSON formatu
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Prikaz jednog korisnika u JSON formatu
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    //Kreiranje novog korisnika
     public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

         // Provera da li email već postoji
        if (User::where('email', $validated['email'])->exists()) {
            return response()->json(['message' => 'Korisnik sa tim emailom već postoji'], 409);
        }

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);
        return response()->json($user, 201);
    }

    // Ažuriranje postojećeg korisnika
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:6',
        ]);

        if (isset($validated['email']) && User::where('email', $validated['email'])->where('id', '!=', $id)->exists()) {
            return response()->json(['message' => 'Korisnik sa tim emailom već postoji'], 409);
        }

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user->update($validated);
        return response()->json($user);
    }
      // Brisanje korisnika
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }
}