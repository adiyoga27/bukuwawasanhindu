<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\GoogleAnalyticsService;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
use Illuminate\Http\Request;

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
            
            $data = $this->analytics->getReport($startDate, $endDate);
            
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch analytics data: ' . $e->getMessage()
            ], 500);
        }
    }
}
