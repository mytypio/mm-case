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
     * Display the dashboard
     */
    public function index(Request $request): View
    {
        $users = User::query()->latest()->take(5)->get();

        $totalUsers = User::query()->count();

        $outOfSyncUsers = User::query()
            ->whereRaw('ABS(strftime(\'%s\', last_synced_at) - strftime(\'%s\', updated_at)) > 10')
            ->count();

        $newUsers = User::query()
            ->where('created_at', '>=', now()->subDays(1))
            ->count();

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
