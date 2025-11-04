<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Services\Admin\BookingService;
use PDF;
use Illuminate\Support\Facades\Response;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index(Request $request)
    {
        try {
            $status = $request->get('status'); 
            $bookings = $this->bookingService->getBookingsWithFilters($status);
            $cards = $this->bookingService->getBookingStats();
            return view('admin.pages.booking.index', compact('bookings', 'cards', 'status'));
            
        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $result = $this->bookingService->updateStatus(
                $booking,
                $request->action,
                $request->schedule
            );
            if (!$result['success']) {
                return back()->with('error', 'Selected schedule is already taken. Please reschedule');
            }
            return back()->with('success', 'Booking status updated successfully.');

        } catch (\Throwable $e) {
            report($e); 
            return response()->view('error.admin500');
        }
    }

    public function exportPdf(Request $request)
    {
        $status = $request->get('status'); 
        $bookings = $this->bookingService->getBookingsWithFilters($status, 1000);
        $pdf = PDF::loadView('admin.pages.booking.export-pdf', compact('bookings'));
        return $pdf->download('bookings.pdf');
    }

    public function exportCsv(Request $request)
    {
        $status = $request->get('status'); 
        $bookings = $this->bookingService->getBookingsWithFilters($status, 1000); 
    
        $filename = 'bookings.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['ID', 'Customer', 'Service', 'Status', 'Schedule', 'Notes']);
    
        foreach ($bookings as $booking) {
            $customerName = optional($booking->customer->user)->firstname 
                          . ' ' 
                          . optional($booking->customer->user)->lastname;
    
            $customerName = trim($customerName) ?: 'N/A';
    
            fputcsv($handle, [
                $booking->booking_id,
                $customerName,
                $booking->service->name ?? 'N/A',
                $booking->status,
                $booking->schedule,
                $booking->notes ?? 'N/A',
            ]);
        }
    
        fclose($handle);
    
        return response()->download($filename)->deleteFileAfterSend(true);
    }    
}
