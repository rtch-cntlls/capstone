<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Your New Account - MotoSmart AI</title>
</head>
<body style="font-family: Arial, sans-serif; background-color:#f8f9fa; padding:20px;">
    <div style="max-width:600px; margin:auto; background:white; padding:30px; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
        <div style="text-align:center; margin-bottom:20px;">
            <h2 style="margin-top:10px; color:#007bff;">MotoSmart AI</h2>
        </div>
        <p>Hi {{ $firstname ?? 'Customer' }},</p>
        <p>An account has been created for you on <strong>MotoSmart AI</strong> so you can track your motorcycle service history.</p>
        
        <p>Here are your login details:</p>
        <ul style="list-style:none; padding:0;">
            <li><strong>Email:</strong> {{ $email }}</li>
            <li><strong>Password:</strong> {{ $password }}</li>
        </ul>

        <p>For security, please change your password after logging in.</p>
        <p>Thanks,<br>The MotoSmart AI Team</p>
        
        <hr style="margin-top:30px;">
        <p style="font-size:12px; color:#6c757d; text-align:center;">This email was sent automatically. Do not reply.</p>
    </div>
</body>
</html>
