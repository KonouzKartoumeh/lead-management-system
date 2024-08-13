<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        switch (auth()->user()->role) {
            case 'property_manager':
                return redirect()->route('property_manager.dashboard');
                break;
            
            case 'sales_team':
                return redirect()->route('sales_team.dashboard');
                break;
            
            case 'admin':
                return redirect()->route('admin.dashboard');
                break;
                        
            default:
                return redirect()->route('login');
                break;
        }
    }
}
