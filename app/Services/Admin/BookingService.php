<?php

namespace App\Services\Admin;

use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class BookingService
{
    public function getBookingsWithFilters($status = null, $perPage = 10)
    {
        $query = Booking::with(['customer.user', 'service'])->latest();

        if ($status) {
            $query->where('status', $status);
        } else {
            $query->whereNotIn('status', ['Completed', 'Cancelled', 'Failed']);
        }

        return $query->paginate($perPage);
    }

    public function getBookingStats()
    {
        $stats = Booking::select('status', DB::raw('COUNT(*) as total'))
            ->whereIn('status', ['Pending', 'Approved', 'Completed', 'Cancelled', 'Failed'])
            ->groupBy('status')
            ->pluck('total', 'status');

        return [
            [
                'title' => 'Pending/Approved',
                'value' => ($stats['Pending'] ?? 0) + ($stats['Approved'] ?? 0),
                'type'  => 'bookings',
                'icon'  => 'fas fa-clock',
            ],
            [
                'title' => 'Completed',
                'value' => $stats['Completed'] ?? 0,
                'type'  => 'bookings',
                'icon'  => 'fas fa-clipboard-check',
            ],
            [
                'title' => 'Cancelled',
                'value' => $stats['Cancelled'] ?? 0,
                'type'  => 'bookings',
                'icon'  => 'fas fa-times-circle',
            ],
            [
                'title' => 'Failed',
                'value' => $stats['Failed'] ?? 0,
                'type'  => 'bookings',
                'icon'  => 'fas fa-times-circle',
            ],
        ];
    }

    public function updateStatus($booking, $action, $schedule = null)
    {
        return DB::transaction(function () use ($booking, $action, $schedule) {

            if ($action === 'approve') {
                $isAvailable = Booking::where('schedule', $booking->schedule)
                    ->where('status', 'Approved')
                    ->where('booking_id', '!=', $booking->booking_id)
                    ->doesntExist();

                if ($isAvailable) {
                    $booking->status = 'Approved';
                    $booking->notes = "Your booking has been approved. Please come to the shop on your scheduled date: " 
                        . \Carbon\Carbon::parse($booking->schedule)->format('M d, Y') . ".";
                } else {
                    return [
                        'success' => false,
                        'message' => 'The current schedule is already taken.'
                    ];
                }
            }

            if ($action === 'reschedule') {
                if (!$schedule) {
                    return [
                        'success' => false,
                        'message' => 'Please provide a new schedule for rescheduling.'
                    ];
                }

                $booking->previous_schedule = $booking->schedule;
                $booking->schedule = $schedule;
                $booking->rescheduled_at = now();
                $booking->status = 'Rescheduled';

                $booking->notes = "Your booking has been rescheduled. New date: " 
                    . \Carbon\Carbon::parse($schedule)->format('M d, Y') 
                    . ". Please make sure to come to the shop on this date.";
            }

            if ($action === 'complete') {
                $booking->status = 'Completed';
            }

            if ($action === 'failed') {
                $booking->status = 'Failed';
            }

            $booking->save();

            return [
                'success' => true,
                'message' => 'Booking status updated successfully!'
            ];
        });
    }
}
