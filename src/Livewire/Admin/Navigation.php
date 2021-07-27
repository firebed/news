<?php

namespace Firebed\News\Livewire\Admin;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class Navigation extends Component
{
    protected array $listeners = ['permissions-updated' => '$refresh'];

    public function render(): Renderable
    {
        return view('admin.layouts.partials.navigation');
    }
}
