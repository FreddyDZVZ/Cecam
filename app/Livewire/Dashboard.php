<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Dashboard')]
class Dashboard extends Component
{
    public function mount(): void
    {
        if (! Auth::check()) {
            $this->redirect(route('login'), navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'user' => Auth::user(),
        ]);
    }
}
