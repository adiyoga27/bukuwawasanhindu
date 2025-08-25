<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\GoogleAnalyticsService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class PageAdminController extends Controller
{
     protected $analytics;

    public function __construct(GoogleAnalyticsService $analytics)
    {
        $this->analytics = $analytics;
    }

    public function index()
    {
        return view('contents.admin.dashboard', [
            'propertyId' => config('analytics.property_id')
        ]);
    }

    public function getAnalyticsData(Request $request)
    {
        try {
            $startDate = $request->get('start_date', '30daysAgo');
            $endDate = $request->get('end_date', 'today');
            $useCache = $request->get('cache', true);
            
            // Convert human-readable dates to GA4 format if needed
            if ($startDate !== '30daysAgo' && $startDate !== '7daysAgo') {
                $startDate = $this->convertToGa4Date($startDate);
            }
            if ($endDate !== 'today' && $endDate !== 'yesterday') {
                $endDate = $this->convertToGa4Date($endDate);
            }
            
            $data = $this->analytics->getReport($startDate, $endDate, $useCache);
            
            // Get traffic sources data
            $trafficSources = $this->analytics->getTrafficSources($startDate, $endDate, $useCache);
            $data['traffic_sources'] = $trafficSources;
             $data['top_pages'] = $this->analytics->getTopPages($startDate, $endDate);
                // Get devices data
        $data['devices'] = $this->analytics->getDevices($startDate, $endDate, $useCache);
            return response()->json([
                'success' => true,
                'data' => $data,
                'period' => [
                    'start_date' => $startDate,
                    'end_date' => $endDate
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error('Analytics Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch analytics data: ' . $e->getMessage(),
                'debug' => env('APP_DEBUG') ? $e->getTraceAsString() : null
            ], 500);
        }
    }

    public function clearCache()
    {
        try {
            $this->analytics->clearCache();
            
            return response()->json([
                'success' => true,
                'message' => 'Analytics cache cleared successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to clear cache: ' . $e->getMessage()
            ], 500);
        }
    }
    
    private function convertToGa4Date($date)
    {
        // Jika date sudah dalam format GA4 (YYYYMMDD), return langsung
        if (preg_match('/^\d{8}$/', $date)) {
            return $date;
        }
        
        // Convert dari YYYY-MM-DD ke YYYYMMDD
        try {
            return Carbon::parse($date)->format('Ymd');
        } catch (\Exception $e) {
            return $date;
        }
    }
}
