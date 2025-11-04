<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Order Has Been Shipped</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      margin: 20px auto;
      background: #ffffff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .header {
      background-color: #007bff;
      color: #ffffff;
      text-align: center;
      padding: 20px;
    }
    .header h1 {
      margin: 0;
      font-size: 22px;
    }
    .content {
      padding: 20px;
      color: #333333;
      line-height: 1.6;
    }
    .content h2 {
      margin-top: 0;
      color: #007bff;
    }
    .order-box {
      background: #e6f0fa;
      padding: 15px;
      border-radius: 6px;
      margin: 15px 0;
      font-size: 15px;
    }
    .footer {
      font-size: 12px;
      color: #777777;
      text-align: center;
      padding: 15px;
      border-top: 1px solid #eeeeee;
    }
    .button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #007bff;
      color: #ffffff !important;
      text-decoration: none;
      border-radius: 5px;
      margin-top: 15px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>📦 Your Order Has Been Shipped!</h1>
    </div>
    <div class="content">
      <h2>Hi {{ $order->customer->user->firstname }} {{ $order->customer->user->lastname }},</h2>
      <p>
        Great news! Your order <strong>#{{ $order->order_number }}</strong> has been shipped.
      </p>
      <div class="order-box">
          <p><strong>Courier:</strong> {{ $order->shipment->courier ?? 'Our shipping partner' }}</p>
          <p><strong>Shipped At:</strong> {{ \Carbon\Carbon::parse($order->shipment->shipped_at)->format('M d, Y, g:i A') }}</p>
      </div>
      <p>
        Thank you for shopping with us! We hope you enjoy your purchase.
      </p>
    </div>
    <div class="footer">
      This is an automated email. Please do not reply.
    </div>
  </div>
</body>
</html>
