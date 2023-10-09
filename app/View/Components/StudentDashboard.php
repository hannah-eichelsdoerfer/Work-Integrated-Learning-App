<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\IndustryPartner;

class StudentDashboard extends Component
{
    public $industryPartners;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->industryPartners = IndustryPartner::where('approved', 1)->paginate(5);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.student-dashboard');
    }
}
