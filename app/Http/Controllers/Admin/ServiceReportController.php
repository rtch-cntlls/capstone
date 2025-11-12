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

        $results = $this->service->getBookingsAndLogs($from, $to, true, 10);

        $dailyTrends = $this->service->getDailyTrends($results['allItems']);

        return view('admin.pages.service-report.index', [
            'from' => $from,
            'to' => $to,
            'bookingsLogs' => $results['bookingsLogs'],
            'dailyTrends' => $dailyTrends
        ]);
    }

    public function exportPdf(Request $request)
    {
        $from = $request->input('from');
        $to   = $request->input('to');

        $results = $this->service->getBookingsAndLogs($from, $to);

        return $this->service->exportPdf($results['allItems'], $from, $to);
    }

    public function exportCsv(Request $request)
    {
        $from = $request->input('from');
        $to   = $request->input('to');

        $results = $this->service->getBookingsAndLogs($from, $to);

        return $this->service->exportCsv($results['allItems'], $from, $to);
    }
}
