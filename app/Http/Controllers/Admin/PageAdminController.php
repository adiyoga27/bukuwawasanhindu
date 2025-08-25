<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\GoogleAnalyticsService;
use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\RunReportRequest;


class PageAdminController extends Controller
{
    private $client;
    private $propertyId;
    private $credentialsPath;
    private $cacheDuration;

    public function __construct()
    {
        $this->propertyId = config('analytics.property_id'); // cukup angka ID
        $this->credentialsPath = config('analytics.credentials_path');
        $this->cacheDuration = config('analytics.cache_duration', 60);

        $this->client = new BetaAnalyticsDataClient([
            'credentials' => $this->credentialsPath,
        ]);
    }

    public function index(GoogleAnalyticsService $ga)
    {
      
       // Awal & akhir bulan
    $startDate = now()->startOfMonth()->format('Y-m-d');
    $endDate   = now()->endOfMonth()->format('Y-m-d');

    // Ambil data dari service
    $report = $ga->getReport($startDate, $endDate);
    $trafficSources = $ga->getTrafficSources($startDate, $endDate);
    $topPages = $ga->getTopPages($startDate, $endDate);

    // Olah data supaya gampang dipakai di Blade
    $totalUsers = $report['total_users'] ?? 0;
    $totalSessions = $report['total_sessions'] ?? 0;
    $dailyDates = collect($report['daily_data'])->pluck('date')->toArray();
    $dailyUsers = collect($report['daily_data'])->pluck('users')->toArray();

    return view('contents.admin.dashboard', compact(
        'totalUsers',
        'totalSessions',
        'dailyDates',
        'dailyUsers',
        'trafficSources',
        'topPages'
    ));
    }

    

    private function normalizeDate($date)
    {
        if (preg_match('/^\d+daysAgo$|^today$|^yesterday$/', $date)) {
            return $date;
        }
        if (preg_match('/^\d{8}$/', $date)) {
            return substr($date, 0, 4) . '-' . substr($date, 4, 2) . '-' . substr($date, 6, 2);
        }
        return $date;
    }
}
