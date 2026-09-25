<?php

namespace App\View\Components\Dashboard\Layout;

use App\Models\Order;
use App\Models\Refund;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $newPendingOrderCount;
    public $newRefundOrderItemsCount;
    public function __construct($title)
    {
        $this->title = $title;
        $this->newPendingOrderCount = Order::where('status','pending')->count();
        $this->newRefundOrderItemsCount= Refund::where('status','pending')->count();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.layout.layout');
    }
}
