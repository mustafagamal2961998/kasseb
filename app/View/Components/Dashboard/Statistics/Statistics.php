<?php

namespace App\View\Components\Dashboard\Statistics;

use App\Models\Order;
use App\Models\Orderitem;
use App\Models\Product;
use App\Models\Refund;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Statistics extends Component
{
    /**
     * Create a new component instance.
     */
    public $productsCount;
    // public $tradersCount;
    public $pendingRefundsCount;
    public $pendingOrderCount;
    public $totalProfit;
    public function __construct()
    {
        $this->productsCount = Product::count();
        // $this->tradersCount = User::where('type','trader')->count();
        $this->pendingRefundsCount = Refund::where('status','pending')->count();
        $this->pendingOrderCount = Order::where('status','pending')->count();
        $this->totalProfit = Orderitem::where('status', 'completed')->sum('total');

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.statistics.statistics');
    }
}
