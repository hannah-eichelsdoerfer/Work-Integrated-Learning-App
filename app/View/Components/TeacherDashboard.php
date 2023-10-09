<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\IndustryPartner;

class TeacherDashboard extends Component
{
    public $industryPartners;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // show not approved first
        $this->industryPartners = IndustryPartner::orderBy('approved', 'asc')->paginate(5);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.teacher-dashboard');
    }
}
