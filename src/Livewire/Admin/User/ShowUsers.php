<?php

namespace Firebed\News\Livewire\Admin\User;

use Firebed\News\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUsers extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function getUsersProperty(): LengthAwarePaginator
    {
        return User
            ::with('image', 'latestArticle')
            ->withCount('articles')
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->paginate(8);
    }

    public function getUserStatusesProperty(): Collection
    {
        return DB
            ::table('users')
            ->select('active', DB::raw('COUNT(*) as `count`'))
            ->groupBy('active')
            ->get()
            ->keyBy('active');
    }

    public function render()
    {
        return view('news::dashboard.users.index', [
            'users'         => $this->users,
            'user_statuses' => $this->user_statuses
        ])
        ->layout('news::dashboard.layouts.app', ['title' => __('Users')]);
    }
}
