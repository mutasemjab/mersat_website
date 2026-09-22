<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Location;
use App\Models\PortfolioItem;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'servicesCount'  => Service::count(),
            'portfolioCount' => PortfolioItem::count(),
            'locationsCount' => Location::count(),
            'unreadCount'    => ContactMessage::unread()->count(),
            'latest'         => ContactMessage::latest()->limit(6)->get(),
        ]);
    }
}
