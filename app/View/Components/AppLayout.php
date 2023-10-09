<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

use Usernotnull\Toast\Concerns\WireToast; // Import the WireToast trait

class AppLayout extends Component
{
    use WireToast; // Add the WireToast trait to your component

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
