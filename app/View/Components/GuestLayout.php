<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    public function render(): \Closure|Application|Htmlable|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|string
    {
        return view('layouts.guest');
    }
}
