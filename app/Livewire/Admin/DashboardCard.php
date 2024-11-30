<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class DashboardCard extends Component
{
    public $bgColor;

    public function mount($bgColor)
    {
        $this->bgColor = $bgColor;
    }

    public function render()
    {
        return view('livewire.admin.dashboard-card');
    }
}