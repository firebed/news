<?php

namespace App\Listeners;


use Firebed\News\Models\Login;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(): void
    {
        Login::create(['user_id' => auth()->id()]);
    }
}
