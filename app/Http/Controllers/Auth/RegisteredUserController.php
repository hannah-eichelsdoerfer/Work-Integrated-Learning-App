<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'type' => ['required', Rule::in(['Teacher', 'Student', 'Industry Partner'])],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Depending on the user type, create the associated entity
        if ($request->type === 'Teacher') {
            $teacher = Teacher::create([
                'user_id' => $user->id,
            ]);
        } elseif ($request->type === 'Student') {
            $student = Student::create([
                'user_id' => $user->id,
            ]);
        } elseif ($request->type === 'Industry Partner') {
            $industryPartner = IndustryPartner::create([
                'user_id' => $user->id,
            ]);
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
