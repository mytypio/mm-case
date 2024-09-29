<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enum\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Controller for managing users in the admin panel.
 */
class UserController extends Controller
{
    /**
     * Display list of users.
     *
     * @return View The view displaying the list of users.
     */
    public function index(): View
    {
        $users = User::all();

        return view(
            'admin.users.index',
            [
                'users' => $users,
            ]
        );
    }

    /**
     * Display the user's profile.
     *
     * @param string $id The ID of the user.
     * @return View The view displaying the user's profile.
     */
    public function view(string $id): View
    {
        /**
         * @var User $user
         */
        $user = User::query()->findOrFail($id);

        return view(
            'admin.users.view',
            [
                'user' => $user,
            ]
        );
    }

    /**
     * Activate the user.
     *
     * @param string $id The ID of the user.
     * @return RedirectResponse A redirect response to the user's profile view.
     */
    public function activate(string $id): RedirectResponse
    {
        /**
         * @var User $user
         */
        $user = User::query()->findOrFail($id);

        $user->update(
            [
                'status' => UserStatus::ACTIVE,
            ]
        );

        $user->save();

        return redirect()->route(
            'user.view',
            [
                'id' => $id,
            ]
        );
    }

    /**
     * Sync the user.
     *
     * @param string $id The ID of the user.
     * @return RedirectResponse A redirect response to the user's profile view.
     */
    public function sync(string $id): RedirectResponse
    {
        /**
         * @var User $user
         */
        $user = User::query()->findOrFail($id);

        $user->update(
            [
                'last_synced_at' => now(),
            ]
        );

        $user->save();

        return redirect()->route(
            'user.view',
            [
                'id' => $id,
            ]
        );
    }

    /**
     * Delete the user.
     *
     * @param string $id The ID of the user.
     * @return RedirectResponse A redirect response to the user list view.
     */
    public function destroy(string $id): RedirectResponse
    {
        /** @var User $user */
        $user = User::query()->findOrFail($id);

        $user->update(
            [
                'status' => UserStatus::INACTIVE,
            ]
        );

        $user->delete();

        return redirect()->route('user.index');
    }
}
