<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\IndustryPartner;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'type' => ['required', Rule::in(['Teacher', 'Student', 'Industry Partner'])],
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
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
                if (!$teacher) {
                    throw new \Exception('Failed to create Teacher');
                }
            } elseif ($request->type === 'Student') {
                $student = Student::create([
                    'user_id' => $user->id,
                ]);
                if (!$student) {
                    throw new \Exception('Failed to create Student');
                }
            } elseif ($request->type === 'Industry Partner') {
                $industryPartner = IndustryPartner::create([
                    'user_id' => $user->id,
                ]);
                if (!$industryPartner) {
                    throw new \Exception('Failed to create Industry Partner');
                }
            }

            // If everything is successful, commit the transaction
            DB::commit();

            return redirect(RouteServiceProvider::HOME);
        } catch (\Exception $e) {
            // Something went wrong, rollback the transaction and handle the error
            DB::rollback();

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }
}
