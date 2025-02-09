<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Carbon\Carbon;

class DashboardCard extends Component
{
    public $bgColor;
    public $title;
    public $value;
    public $time;

    public function mount($bgColor)
    {
        $this->bgColor = $bgColor;
        $this->year = Carbon::now()->year;
    }

    public function render()
    {
        return view('livewire.admin.dashboard-card', ['year' => $this->year]);
    }
}