<?php

namespace App\Services;

use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\RunReportRequest;

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
            throw new \Exception('Google Analytics credentials file not found at: ' . $credentialsPath);
        }

        try {
            $this->client = new BetaAnalyticsDataClient([
                'credentials' => $credentialsPath
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Failed to initialize Google Analytics client: ' . $e->getMessage());
        }
    }

    public function getReport($startDate = '30daysAgo', $endDate = 'today')
    {
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

                // Format date untuk readable format
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

    // Method untuk mendapatkan data traffic sources
    public function getTrafficSources($startDate = '30daysAgo', $endDate = 'today')
    {
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
                }
                
                $trafficSources[] = [
                    'source' => $source,
                    'sessions' => $sessions
                ];
            }
            
            return $trafficSources;

        } catch (\Exception $e) {
            logger()->error('GA4 Traffic Sources Error: ' . $e->getMessage());
            return [];
        }
    }
}