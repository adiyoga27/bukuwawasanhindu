<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\GoogleAnalyticsService;
use Illuminate\Http\Request;

class PageAdminController extends Controller
{
    /**
     * Display a listing of the resource.a
     */
    public function index(GoogleAnalyticsService $ga)
    {
          $report = $ga->getReport('30daysAgo', 'today');
        $trafficSources = $ga->getTrafficSources('30daysAgo', 'today');

        // Logic to display admin dashboard or page
        return view('contents.admin.dashboard', compact('report', 'trafficSources')); // Assuming you have a view for the admin dashboard
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Logic to show form for creating a new resource
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Logic to store a new resource
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Logic to display a specific resource
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Logic to show form for editing a specific resource
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Logic to update a specific resource
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Logic to delete a specific resource
    }
}
