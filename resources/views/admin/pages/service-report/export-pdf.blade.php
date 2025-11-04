<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Service Report PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background-color: #f5f5f5; }
        h4 { text-align: center; margin-bottom: 0; }
        small { text-align: center; display: block; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h3>Service Report</h3>
    <small>
        Date Range:
        <strong>{{ $from ?? 'N/A' }}</strong> to <strong>{{ $to ?? 'N/A' }}</strong>
    </small>

    <table>
        <thead>
            <tr>
                <th style="width: 15%;">Date</th>
                <th style="width: 30%;">Customer</th>
                <th style="width: 35%;">Service Type</th>
                <th style="width: 20%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $b)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($b->schedule)->format('Y-m-d') }}</td>
                    <td>
                        {{ trim(($b->customer->user->firstname ?? '') . ' ' . ($b->customer->user->lastname ?? '')) ?: 'N/A' }}
                    </td>
                    <td>{{ $b->service->name ?? 'N/A' }}</td>
                    <td>{{ ucfirst($b->status ?? 'N/A') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; font-style: italic;">
                        No service records found for the selected date range.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>