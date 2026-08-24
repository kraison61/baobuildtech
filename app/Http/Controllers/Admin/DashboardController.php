<?php

namespace App\Http\Controllers\Admin;

use App\Models\Author;
use App\Models\Faq;
use App\Models\Location;
use App\Models\Portfolio;
use App\Models\Post;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceItem;
use App\Models\ServicePrice;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'categories' => ServiceCategory::query()->count(),
                'services' => Service::query()->count(),
                'service_items' => ServiceItem::query()->count(),
                'prices' => ServicePrice::query()->count(),
                'portfolios' => Portfolio::query()->count(),
                'locations' => Location::query()->count(),
                'authors' => Author::query()->count(),
                'posts' => Post::query()->count(),
                'faqs' => Faq::query()->count(),
                'users' => User::query()->count(),
            ],
        ]);
    }
}
