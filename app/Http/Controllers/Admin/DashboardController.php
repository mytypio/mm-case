<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     *
     * @param Request $request The HTTP request instance.
     * @return View The view displaying the dashboard.
     */
    public function index(Request $request): View
    {
        // Retrieve the latest 5 users
        $users = User::query()->latest()->take(5)->get();

        // Count the total number of users
        $totalUsers = User::query()->count();

        // Count the number of users that are out of sync
        $outOfSyncUsers = User::query()
            ->whereRaw('ABS(strftime(\'%s\', last_synced_at) - strftime(\'%s\', updated_at)) > 10')
            ->count();

        // Count the number of new users created in the last day
        $newUsers = User::query()
            ->where('created_at', '>=', now()->subDays(1))
            ->count();

        // Return the view with the dashboard data
        return view(
            'admin.dashboard',
            [
                'users' => $users,
                'totalUsers' => $totalUsers,
                'outOfSyncUsers' => $outOfSyncUsers,
                'newUsers' => $newUsers,
            ]
        );
    }
}
