<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Enum\UserStatus;
use App\Enum\UserStorageType;
use App\Event\User\UserWasCreated;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * Controller for handling user registration.
 */
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return View The view displaying the registration form.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param Request $request The incoming registration request.
     * @return RedirectResponse A redirect response to the profile view.
     * @throws ValidationException If the validation fails.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'firstName' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]
        );

        /** @var User $user */
        $user = User::create(
            [
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
                'email_verified_at' => now(),
                'status' => UserStatus::INACTIVE,
                'user_storage_type' => UserStorageType::MIXPANEL,
                'last_synced_at' => now(),
                'role' => 'ROLE_USER',
                'password' => Hash::make($request->password),
            ]
        );

        $user->save();

        event(new UserWasCreated($user));

        Auth::login($user);

        return redirect()->route('profile.view');
    }
}
