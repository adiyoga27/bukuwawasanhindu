<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\GoogleAnalyticsService;
use Carbon\Carbon;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    protected $analytics;

    public function __construct(GoogleAnalyticsService $analytics)
    {
        $this->analytics = $analytics;
    }

    public function googleAnalytics()
    {
        return view('contents.admin.reports.google-analytics');
    }

   public function getAnalyticsData(Request $request)
    {
        try {
            $startDate = $request->get('start_date', '30daysAgo');
            $endDate = $request->get('end_date', 'today');
            
            // Convert human-readable dates to GA4 format if needed
            if ($startDate !== '30daysAgo' && $startDate !== '7daysAgo') {
                $startDate = $this->convertToGa4Date($startDate);
            }
            if ($endDate !== 'today' && $endDate !== 'yesterday') {
                $endDate = $this->convertToGa4Date($endDate);
            }
            
            $data = $this->analytics->getReport($startDate, $endDate);
            
            // Get traffic sources data
            $trafficSources = $this->analytics->getTrafficSources($startDate, $endDate);
            $data['traffic_sources'] = $trafficSources;
            
            return response()->json([
                'success' => true,
                'data' => $data
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
