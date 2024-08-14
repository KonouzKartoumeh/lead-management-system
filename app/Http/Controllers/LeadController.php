<?php

// app/Http/Controllers/LeadController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead; // Make sure to import your Lead model

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $leads = Lead::all();
        return view('admin.lead', compact('leads'));
    }
    public function store(Request $request)
    {
        //dd($request);
        // Validate the incoming request
        $validatedData = $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'inquiry' => 'nullable|string',
            'utm_source' => 'nullable|string',
            'utm_medium' => 'nullable|string',
            'utm_campaign' => 'nullable|string',
            'utm_term' => 'nullable|string',
            'utm_content' => 'nullable|string',
            'source' => 'required|string',
            'user_agent' => 'nullable|string',
            'referrer' => 'nullable|string',
            'screen_width' => 'nullable|integer',
            'screen_height' => 'nullable|integer',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // Create a new Lead instance and save it
        $lead = Lead::create($validatedData);

        // Return a response
        return response()->json([
            'message' => 'Lead created successfully!',
            'lead' => $lead,
        ], 201);
    }

}
