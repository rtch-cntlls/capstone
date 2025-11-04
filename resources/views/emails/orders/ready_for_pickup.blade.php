<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Ready for Pickup</title>
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
      background-color: #28a745;
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
      color: #28a745;
    }
    .order-box {
      background: #e6f4ea;
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
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>🏬 Your Order is Ready for Pickup!</h1>
    </div>
    <div class="content">
      <h2>Hi {{ $order->customer->user->firstname }} {{ $order->customer->user->lastname }},</h2>
      <p>
        Good news! Your order <strong>#{{ $order->order_number }}</strong> is now 
        <strong>ready for pickup</strong> at our store.
      </p>

      <div class="order-box">
          <p><strong>Ready for Pickup Since:</strong> 
            {{ \Carbon\Carbon::parse($order->expected_delivery_date)->format('M d, Y, g:i A') }}
          </p>
      </div>
      <p>
        Thank you for shopping with us! We look forward to seeing you at the store.
      </p>
    </div>
    <div class="footer">
      This is an automated email. Please do not reply.
    </div>
  </div>
</body>
</html>
