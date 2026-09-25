<?php

namespace App\View\Components\User\Layout;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $categories;
    public function __construct($title)
    {
        $this->title = $title;
        $this->categories = Category::whereStatus('active')->whereNull('category_id')->latest()->withCount('children')->with('children')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user.layout.layout');
    }
}
