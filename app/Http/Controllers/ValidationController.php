<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Rules\Uppercase;
use Illuminate\Http\Request;

class ValidationController extends Controller
{
    public function form()
    {
        return view('validation');
    }

    public function submitForm(UserRequest $request)
    {
        return 'Data berhasil divalidasi!';
    }

    public function uppercase(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:50', new Uppercase],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
        ]);

        return redirect()->back()->with('success', 'Nama berhasil divalidasi!');
    }
}
