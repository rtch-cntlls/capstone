<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bookings Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f0f0f0; }
        h2 { margin-bottom: 0; }
        p { margin-top: 0; font-size: 11px; color: #555; }
    </style>
</head>
<body>
    <h2>Bookings Report</h2>
    <p>Status: {{ $status ?? 'Pending/Approved' }}</p>
    <p>Generated: {{ now()->format('M d, Y h:i a') }}</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Service</th>
                <th>Status</th>
                <th>Schedule</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->booking_id }}</td>
                <td>{{ optional($booking->customer->user)->firstname ?? '' }} {{ optional($booking->customer->user)->lastname ?? '' }}</td>
                <td>{{ $booking->service->name ?? '-' }}</td>
                <td>{{ $booking->status }}</td>
                <td>{{ $booking->schedule }}</td>
                <td>{{ $booking->notes ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
