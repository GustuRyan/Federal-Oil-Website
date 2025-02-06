<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class DashboardCard extends Component
{
    public $bgColor;
    public $title;
    public $value;
    public $time;

    public function mount($bgColor)
    {
        $this->bgColor = $bgColor;
    }

    public function render()
    {
        return view('livewire.admin.dashboard-card');
    }
}