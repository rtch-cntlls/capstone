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

        $bookings    = $this->service->getBookings($from, $to, true);
        $dailyTrends = $this->service->getDailyTrends($bookings);

        return view('admin.pages.service-report.index', compact('from', 'to', 'dailyTrends', 'bookings'));
    }

    public function exportPdf(Request $request)
    {
        $from = $request->input('from');
        $to   = $request->input('to');

        $bookings = $this->service->getBookings($from, $to);

        return $this->service->exportPdf($bookings, $from, $to);
    }

    public function exportCsv(Request $request)
    {
        $from = $request->input('from');
        $to   = $request->input('to');

        $bookings = $this->service->getBookings($from, $to);

        return $this->service->exportCsv($bookings, $from, $to);
    }
}
