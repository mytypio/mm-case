<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * Component class for the app layout.
 */
class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return View The view instance representing the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
