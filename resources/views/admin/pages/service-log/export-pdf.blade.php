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
    <h3>Service Logs</h3>
    <table>
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Contact Number</th>
                <th>Service</th>
                <th>Date / Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->customer_name }}</td>
                    <td>{{ $log->contact_number ?? '-' }}</td>
                    <td>{{ optional($log->service)->name ?? '-' }}</td>
                    <td>{{ $log->created_at->format('M. d, Y h:i A') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>