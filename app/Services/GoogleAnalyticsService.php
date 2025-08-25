<?php

namespace App\Services;

use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\RunReportRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GoogleAnalyticsService
{
    private $client;
    private $propertyId;
    private $credentialsPath;
    private $cacheDuration;

    public function __construct()
    {
        $this->propertyId = 'properties/' . config('analytics.property_id');
        $this->credentialsPath = config('analytics.credentials_path');
        $this->cacheDuration = config('analytics.cache_duration', 60);
        
        $this->validateConfiguration();
        $this->initializeClient();
    }

    private function validateConfiguration()
    {

        if (empty(config('analytics.property_id'))) {
            throw new \Exception('Google Analytics Property ID is not configured. Please set GA4_PROPERTY_ID in your .env file.');
        }

        if (!file_exists($this->credentialsPath)) {
            throw new \Exception('Google Analytics credentials file not found at: ' . $this->credentialsPath);
        }
    }

    private function initializeClient()
    {
        try {
            $this->client = new BetaAnalyticsDataClient([
                'credentials' => $this->credentialsPath
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Failed to initialize Google Analytics client: ' . $e->getMessage());
        }
    }
public function getDevices($startDate, $endDate, $useCache = true)
{
        $startDate = $this->normalizeDate($startDate);
    $endDate   = $this->normalizeDate($endDate);
    $cacheKey = "ga4_devices_{$startDate}_{$endDate}";
    
    if ($useCache && Cache::has($cacheKey)) {
        return Cache::get($cacheKey);
    }
    $dateRange = new DateRange([
                'start_date' => $startDate,
                'end_date' => $endDate,
            ]);

     // Buat metrics
            $metrics = [
                new Metric(['name' => 'sessions']),
            ];

            // Buat dimensions
            $dimensions = [
                new Dimension(['name' => 'deviceCategory']),
            ];


            // Buat request dengan format yang benar
            $request = (new RunReportRequest())
                ->setProperty($this->propertyId)
                ->setDateRanges([$dateRange])
                ->setMetrics($metrics)
                ->setDimensions($dimensions)
                ->setLimit(1000);
                
            $response = $this->client->runReport($request);
    

    $devices = [];
    foreach ($response->getRows() as $row) {
        $devices[] = [
            'device' => $row->getDimensionValues()[0]->getValue(),
            'sessions' => (int) $row->getMetricValues()[0]->getValue(),
        ];
    }

    Cache::put($cacheKey, $devices, now()->addMinutes(30));

    return $devices;
}
    public function getReport($startDate = '30daysAgo', $endDate = 'today', $useCache = true)
    {
        $startDate = $this->normalizeDate($startDate);
$endDate   = $this->normalizeDate($endDate);
        $cacheKey = "ga4_report_{$startDate}_{$endDate}";

        if ($useCache && $this->cacheDuration > 0) {
            $cachedData = Cache::get($cacheKey);
            if ($cachedData) {
                return $cachedData;
            }
        }

        try {
            // Buat date range object
            $dateRange = new DateRange([
                'start_date' => $startDate,
                'end_date' => $endDate,
            ]);

            // Buat metrics
            $metrics = [
                new Metric(['name' => 'activeUsers']),
                new Metric(['name' => 'sessions']),
                new Metric(['name' => 'averageSessionDuration']),
                new Metric(['name' => 'bounceRate']),
            ];

            // Buat dimensions
            $dimensions = [
                new Dimension(['name' => 'date']),
            ];

            // Buat request dengan format yang benar
            $request = (new RunReportRequest())
                ->setProperty($this->propertyId)
                ->setDateRanges([$dateRange])
                ->setMetrics($metrics)
                ->setDimensions($dimensions)
                ->setLimit(1000);

            $response = $this->client->runReport($request);

            $formattedData = $this->formatResponse($response);

            if ($useCache && $this->cacheDuration > 0) {
                Cache::put($cacheKey, $formattedData, now()->addMinutes($this->cacheDuration));
            }
            return $formattedData;

        } catch (\Exception $e) {
            Log::error('GA4 API Error: ' . $e->getMessage());
            throw new \Exception('Google Analytics API Error: ' . $e->getMessage());
        }
    }

    private function formatResponse($response)
    {
        $data = [
            'total_users' => 0,
            'total_sessions' => 0,
            'avg_duration' => 0,
            'bounce_rate' => 0,
            'daily_data' => []
        ];

        if ($response->getRowCount() > 0) {
            $totalDuration = 0;
            $totalBounceRate = 0;
            $rowCount = $response->getRowCount();

            foreach ($response->getRows() as $row) {
                $metrics = $row->getMetricValues();
                
                $date = $row->getDimensionValues()[0]->getValue();
                $users = (int)$metrics[0]->getValue();
                $sessions = (int)$metrics[1]->getValue();
                $duration = (float)$metrics[2]->getValue();
                $bounceRate = (float)$metrics[3]->getValue();

                // Format date untuk readable format (YYYY-MM-DD)
                $formattedDate = substr($date, 0, 4) . '-' . substr($date, 4, 2) . '-' . substr($date, 6, 2);

                $data['daily_data'][] = [
                    'date' => $formattedDate,
                    'users' => $users,
                    'sessions' => $sessions,
                    'duration' => $duration,
                    'bounce_rate' => $bounceRate
                ];

                $data['total_users'] += $users;
                $data['total_sessions'] += $sessions;
                $totalDuration += $duration;
                $totalBounceRate += $bounceRate;
            }

            // Hitung rata-rata
            if ($rowCount > 0) {
                $data['avg_duration'] = round($totalDuration / $rowCount, 2);
                $data['bounce_rate'] = round($totalBounceRate / $rowCount, 2);
            }
        }

        return $data;
    }
public function getTopPages($startDate = '30daysAgo', $endDate = 'today', $useCache = true)
{
    $startDate = $this->normalizeDate($startDate);
    $endDate   = $this->normalizeDate($endDate);

    $cacheKey = "ga4_top_pages_{$startDate}_{$endDate}";

    if ($useCache && $this->cacheDuration > 0) {
        $cachedData = Cache::get($cacheKey);
        if ($cachedData) {
            return $cachedData;
        }
    }

    try {
        $dateRange = new DateRange([
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);

        $request = (new RunReportRequest())
            ->setProperty($this->propertyId)
            ->setDateRanges([$dateRange])
            ->setMetrics([
                new Metric(['name' => 'screenPageViews'])
            ])
            ->setDimensions([
                new Dimension(['name' => 'pagePath']),
                new Dimension(['name' => 'pageTitle'])
            ])
            ->setLimit(10);

        $response = $this->client->runReport($request);

        $pages = [];
        foreach ($response->getRows() as $row) {
            $pagePath = $row->getDimensionValues()[0]->getValue();
            $pageTitle = $row->getDimensionValues()[1]->getValue();
            $views = (int)$row->getMetricValues()[0]->getValue();

            $pages[] = [
                'path' => $pagePath,
                'title' => $pageTitle,
                'views' => $views,
            ];
        }

        if ($useCache && $this->cacheDuration > 0) {
            Cache::put($cacheKey, $pages, now()->addMinutes($this->cacheDuration));
        }

        return $pages;

    } catch (\Exception $e) {
        Log::error('GA4 Top Pages Error: ' . $e->getMessage());
        return [];
    }
}

    public function getTrafficSources($startDate = '30daysAgo', $endDate = 'today', $useCache = true)
    {
        $startDate = $this->normalizeDate($startDate);
$endDate   = $this->normalizeDate($endDate);
        $cacheKey = "ga4_traffic_sources_{$startDate}_{$endDate}";

        if ($useCache && $this->cacheDuration > 0) {
            $cachedData = Cache::get($cacheKey);
            if ($cachedData) {
                return $cachedData;
            }
        }

        try {
            $dateRange = new DateRange([
                'start_date' => $startDate,
                'end_date' => $endDate,
            ]);

            $request = (new RunReportRequest())
                ->setProperty($this->propertyId)
                ->setDateRanges([$dateRange])
                ->setMetrics([new Metric(['name' => 'sessions'])])
                ->setDimensions([new Dimension(['name' => 'sessionSource'])])
                ->setLimit(10);

            $response = $this->client->runReport($request);
            
            $trafficSources = [];
            foreach ($response->getRows() as $row) {
                $source = $row->getDimensionValues()[0]->getValue();
                $sessions = (int)$row->getMetricValues()[0]->getValue();
                
                if ($source === '(direct)') {
                    $source = 'Direct';
                } elseif ($source === '(none)') {
                    $source = 'Unknown';
                }
                
                $trafficSources[] = [
                    'source' => $source,
                    'sessions' => $sessions
                ];
            }

            if ($useCache && $this->cacheDuration > 0) {
                Cache::put($cacheKey, $trafficSources, now()->addMinutes($this->cacheDuration));
            }
            
            return $trafficSources;

        } catch (\Exception $e) {
            Log::error('GA4 Traffic Sources Error: ' . $e->getMessage());
            return [];
        }
    }

    public function clearCache()
    {
        // Clear all GA4 cache
        $keys = Cache::get('ga4_cache_keys', []);
        foreach ($keys as $key) {
            Cache::forget($key);
        }
        Cache::forget('ga4_cache_keys');
    }
    private function normalizeDate($date)
    {
        // Kalau sudah format yg valid (today, yesterday, NdaysAgo)
    if (preg_match('/^\d+daysAgo$|^today$|^yesterday$/', $date)) {
        return $date;
    }

    // Kalau format numeric Ymd (20250726)
    if (preg_match('/^\d{8}$/', $date)) {
        return substr($date, 0, 4) . '-' . substr($date, 4, 2) . '-' . substr($date, 6, 2);
    }

     // Kalau sudah format YYYY-MM-DD atau lainnya, langsung balikin
        return $date;
    }
}