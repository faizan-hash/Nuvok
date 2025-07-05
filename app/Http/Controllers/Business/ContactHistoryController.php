<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ContactHistory;

class ContactHistoryController extends Controller
{
    public function index()
    {
        $logs = ContactHistory::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('default.panel.business.contact-history.index', compact('logs'));
    }
} 