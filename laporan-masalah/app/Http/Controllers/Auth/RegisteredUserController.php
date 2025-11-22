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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class, 'regex:/^.+@(dpa\.com|admin\.com)$/'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nidn' => ['required', 'string', 'max:255', 'unique:dosens'],
        ];

        $request->validate($rules);

        $dosen_id = null;
        $role = null;

        if (str_ends_with($request->email, '@dpa.com') || str_ends_with($request->email, '@admin.com')) {
            $role = 'dpa';
            // Generate new ID for dosen
            $lastDosen = Dosen::orderBy('id', 'desc')->first();
            $nextIdNumber = $lastDosen ? (int)substr($lastDosen->id, 1) + 1 : 1;
            $dosenId = 'D' . str_pad($nextIdNumber, 3, '0', STR_PAD_LEFT);

            $dosen = Dosen::create([
                'id' => $dosenId,
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
            'role' => $role,
            'dosen_id' => $dosen_id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}