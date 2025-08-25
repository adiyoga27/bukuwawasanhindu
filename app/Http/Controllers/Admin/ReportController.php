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

      public function googleAnalytics(){
          $data = $this->analytics->getReport();
        return view('contents.admin.reports.index',[
            'analyticsData' => $data
        ]);
    }
   
public function getAnalyticsData()
    {
        return response()->json($this->analytics->getReport());
    }
    public function getData()
    {
        return response()->json($this->analytics->getReport());
    }
}
