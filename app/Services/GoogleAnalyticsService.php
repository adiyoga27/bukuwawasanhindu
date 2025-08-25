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
        
        // Pastikan file credentials ada
        $credentialsPath = storage_path('app/analytics/service-account.json');
        
        if (!file_exists($credentialsPath)) {
            throw new \Exception('Google Analytics credentials file not found');
        }

        $this->client = new BetaAnalyticsDataClient([
            'credentials' => $credentialsPath
        ]);
    }

    public function getReport($startDate = '30daysAgo', $endDate = 'today')
    {
        try {
            // Request untuk data utama
            $request = new RunReportRequest([
                'property' => $this->propertyId,
                'dateRanges' => [
                    new DateRange([
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                    ]),
                ],
                'metrics' => [
                    new Metric(['name' => 'activeUsers']),
                    new Metric(['name' => 'sessions']),
                    new Metric(['name' => 'averageSessionDuration']),
                    new Metric(['name' => 'bounceRate']),
                ],
                'dimensions' => [
                    new Dimension(['name' => 'date']),
                ],
                'limit' => 1000
            ]);

            $response = $this->client->runReport($request);

            return $this->formatResponse($response);

        } catch (\Exception $e) {
            logger()->error('GA4 API Error: ' . $e->getMessage());
            throw new \Exception('Google Analytics API Error: ' . $e->getMessage());
        }
    }

    private function formatResponse($response)
    {
        $data = [
            'total_users' => 0,
            'total_views' => 0,
            'avg_duration' => 0,
            'bounce_rate' => 0,
            'daily_data' => []
        ];

        if ($response->getRowCount() > 0) {
            foreach ($response->getRows() as $row) {
                $metrics = $row->getMetricValues();
                
                $date = $row->getDimensionValues()[0]->getValue();
                $users = $metrics[0]->getValue();
                $sessions = $metrics[1]->getValue();
                $duration = $metrics[2]->getValue();
                $bounceRate = $metrics[3]->getValue();

                $data['daily_data'][] = [
                    'date' => $date,
                    'users' => $users,
                    'views' => $sessions
                ];

                $data['total_users'] += (int)$users;
                $data['total_views'] += (int)$sessions;
                $data['avg_duration'] = (float)$duration;
                $data['bounce_rate'] = (float)$bounceRate;
            }

            // Hitung rata-rata
            if ($data['total_views'] > 0) {
                $data['avg_duration'] = $data['avg_duration'] / $response->getRowCount();
            }
        }

        return $data;
    }

    // Method untuk data sebelumnya (comparison)
    public function getPreviousPeriodData($startDate, $endDate)
    {
        // Implementasi untuk mendapatkan data periode sebelumnya
        // ...
    }
}