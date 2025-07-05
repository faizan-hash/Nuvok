<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessAnalytics;
use App\Models\BusinessInvoice;
use App\Models\BusinessClient;
use App\Models\BusinessProject;
use App\Models\BusinessTask;
use App\Services\BusinessCreditService;

class AnalyticsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Get business analytics data
        $analytics = BusinessAnalytics::where('user_id', $user->id)->first();
        
        // Get counts
        $totalInvoices = BusinessInvoice::count();
        $totalClients = BusinessClient::count();
        $totalProjects = BusinessProject::count();
        $totalTasks = BusinessTask::count();
        
        // Get remaining credits
        $remainingCredits = BusinessCreditService::getRemainingCredits($user);
        
        // Calculate total income
        $totalIncome = $analytics ? $analytics->income : 0;
        
        // Get recent activity counts (last 30 days)
        $recentInvoices = BusinessInvoice::where('created_at', '>=', now()->subDays(30))->count();
        $recentClients = BusinessClient::where('created_at', '>=', now()->subDays(30))->count();
        $recentProjects = BusinessProject::where('created_at', '>=', now()->subDays(30))->count();
        $recentTasks = BusinessTask::where('created_at', '>=', now()->subDays(30))->count();
        
        return view('default.panel.business.analytics.index', compact(
            'totalInvoices',
            'totalClients', 
            'totalProjects',
            'totalTasks',
            'remainingCredits',
            'totalIncome',
            'recentInvoices',
            'recentClients',
            'recentProjects',
            'recentTasks'
        ));
    }
}
