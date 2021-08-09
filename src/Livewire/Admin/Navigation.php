<?php

namespace Firebed\News\Livewire\Admin;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class Navigation extends Component
{
    protected $listeners = ['permissions-updated' => '$refresh'];

    public function render(): Renderable
    {
        return view('news::dashboard.layouts.partials.navigation');
    }
}
