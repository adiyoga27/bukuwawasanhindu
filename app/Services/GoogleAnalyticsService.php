<?php

namespace App\Services;

use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\RunReportRequest;
use Google\Analytics\Data\V1beta\RunReportResponse;

class GoogleAnalyticsService
{
    private $client;
    private $propertyId;

    public function __construct()
    {
        $this->propertyId = 'properties/' . env('GA4_PROPERTY_ID');
        $credentials = storage_path('app/analytics/service-account.json');
        
        $this->client = new BetaAnalyticsDataClient([
            'credentials' => $credentials
        ]);
    }

    public function getReport()
    {
        try {
            // Buat request object
    $request = new RunReportRequest([
        'property' => $this->propertyId,
        'date_ranges' => [
            new DateRange([
                'start_date' => '30daysAgo',
                'end_date' => 'today',
            ]),
        ],
        'metrics' => [
            new Metric(['name' => 'activeUsers']),
            new Metric(['name' => 'screenPageViews']),
        ],
        'dimensions' => [
            new Dimension(['name' => 'date']),
        ],
    ]);

    // Eksekusi request
    $response = $this->client->runReport($request);

            return $this->formatResponse($response);

        } catch (\Exception $e) {
            logger()->error('GA4 API Error: ' . $e->getMessage());
            return null;
        }
    }

    private function formatResponse(RunReportResponse $response)
    {
        $data = [
            'total_users' => 0,
            'total_views' => 0,
            'avg_duration' => 0,
            'bounce_rate' => 0,
            'daily_data' => []
        ];

        foreach ($response->getRows() as $row) {
            $date = $row->getDimensionValues()[0]->getValue();
            $users = $row->getMetricValues()[0]->getValue();
            $views = $row->getMetricValues()[1]->getValue();
            $duration = $row->getMetricValues()[2]->getValue();
            $bounce = $row->getMetricValues()[3]->getValue();

            $data['daily_data'][] = [
                'date' => $date,
                'users' => $users,
                'views' => $views
            ];

            $data['total_users'] += $users;
            $data['total_views'] += $views;
            $data['avg_duration'] = $duration;
            $data['bounce_rate'] = $bounce;
        }

        return $data;
    }
}