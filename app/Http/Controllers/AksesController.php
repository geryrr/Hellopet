<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Akses;

class AksesController extends Controller
{
  public function register(Request $request)
  {
      $this->validate($request, [
          'email' => 'required|unique:akses|email',
          'password' => 'required|min:6'
      ]);

      $email = $request->input('email');
      $password = Hash::make($request->input('password'));

      $akses = Akses::create([
          'email' => $email,
          'password' => $password
      ]);

      return response()->json(['message' => 'Data added successfully'], 201);
  }

  public function login(Request $request)
  {
      $this->validate($request, [
          'email' => 'required|email',
          'password' => 'required|min:6'
      ]);

      $email = $request->input('email');
      $password = $request->input('password');

      $akses = Akses::where('email', $email)->first();
      if (!$akses) {
          return response()->json(['message' => 'Login failed'], 401);
      }

      $isValidPassword = Hash::check($password, $akses->password);
      if (!$isValidPassword) {
        return response()->json(['message' => 'Login failed'], 401);
      }

      $generateToken = bin2hex(random_bytes(10));
      $akses->update([
          'token' => $generateToken
      ]);

      return response()->json($akses);
  }
} 