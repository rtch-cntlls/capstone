<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Reports\ServiceReportService;
use Illuminate\Http\Request;

class ServiceReportController extends Controller
{
    protected ServiceReportService $service;

    public function __construct(ServiceReportService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $from = $request->input('from') ?: now()->startOfMonth()->toDateString();
        $to   = $request->input('to') ?: now()->endOfMonth()->toDateString();

        $results = $this->service->getBookingsAndLogs($from, $to, true);

        $dailyTrends = $this->service->getDailyTrends($results['bookings'], $results['logs']);

        return view('admin.pages.service-report.index', [
            'from' => $from,
            'to' => $to,
            'bookings' => $results['bookings'],
            'logs' => $results['logs'],
            'dailyTrends' => $dailyTrends
        ]);
    }

    public function exportPdf(Request $request)
    {
        $from = $request->input('from');
        $to   = $request->input('to');

        $results = $this->service->getBookingsAndLogs($from, $to);

        return $this->service->exportPdf($results['bookings'], $results['logs'], $from, $to);
    }

    public function exportCsv(Request $request)
    {
        $from = $request->input('from');
        $to   = $request->input('to');

        $results = $this->service->getBookingsAndLogs($from, $to);

        return $this->service->exportCsv($results['bookings'], $results['logs'], $from, $to);
    }
}
