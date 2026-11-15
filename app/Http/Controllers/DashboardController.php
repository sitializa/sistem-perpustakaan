<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_titles' => Book::count(),
            'total_stock' => Book::sum('stock'),
            'total_members' => Member::count(),
            'active_borrowings' => Borrowing::where('status', 'borrowed')->count(),
        ];

        return view('dashboard', compact('stats'));
    }
}