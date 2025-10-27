<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class, 'regex:/^.+@(mahasiswa\.com|admin\.com)$/'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:mahasiswa,dpa'],
        ];

        if ($request->role === 'mahasiswa') {
            $rules['nim'] = ['required', 'string', 'max:255', 'unique:mahasiswas'];
        } elseif ($request->role === 'dpa') {
            $rules['nidn'] = ['required', 'string', 'max:255', 'unique:dosens'];
        }

        $request->validate($rules);

        $mahasiswa_id = null;
        $dosen_id = null;

        if ($request->role === 'mahasiswa') {
            $mahasiswa = Mahasiswa::create([
                'nama' => $request->name,
                'nim' => $request->nim,
                'email' => $request->email,
            ]);
            $mahasiswa_id = $mahasiswa->id;
        } elseif ($request->role === 'dpa') {
            $dosen = Dosen::create([
                'nama' => $request->name,
                'nidn' => $request->nidn,
                'email' => $request->email,
            ]);
            $dosen_id = $dosen->id;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'mahasiswa_id' => $mahasiswa_id,
            'dosen_id' => $dosen_id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
