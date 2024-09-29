<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enum\UserStatus;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

/**
 * Controller for managing user profiles.
 */
class ProfileController
{
    /**
     * Display the user's profile form.
     *
     * @param Request $request The current request instance.
     * @return View The view displaying the user's profile form.
     */
    public function view(Request $request): View
    {
        /**
         * @var User $user
         */
        $user = $request->user();

        return view(
            'profile.view',
            [
                'user' => $user,
            ]
        );
    }

    /**
     * Update the user's profile information.
     *
     * @param ProfileUpdateRequest $request The request containing the profile update data.
     * @return RedirectResponse A redirect response to the profile view with a status message.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        /**
         * @var User $user
         */
        $user = $request->user();

        $user->fill($request->validated());
        $user->save();

        return Redirect::route('profile.view')
            ->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     *
     * @param Request $request The current request instance.
     * @return RedirectResponse A redirect response to the home page.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag(
            'userDeletion',
            [
                'password' => ['required', 'current_password'],
            ]
        );

        $user = $request->user();

        $user->update(
            [
                'status' => UserStatus::INACTIVE,
            ]
        );

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
