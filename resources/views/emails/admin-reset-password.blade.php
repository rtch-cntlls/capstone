<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Password Reset - MotoSmart AI</title>
</head>
<body style="font-family: Arial, sans-serif; background-color:#f8f9fa; padding:20px;">
    <div style="max-width:600px; margin:auto; background:white; padding:30px; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
        <div style="text-align:center; margin-bottom:20px;">
            <h2 style="margin-top:10px; color:#007bff;">MotoSmart AI</h2>
        </div>
        <p>Hi {{ $user->name ?? 'Admin' }},</p>
        <p>You recently requested to reset your password. Click the button below to proceed:</p>
        <div style="text-align:center; margin:30px 0;">
            <a href="{{ route('admin.reset-password.form', $token) }}" 
               style="background:#007bff; color:white; text-decoration:none; padding:12px 24px; border-radius:5px; font-weight:bold;">
               Reset Password
            </a>
        </div>
        <p>If you didn’t request this, you can safely ignore this email.</p>
        <p>Thanks,<br>The MotoSmart AI Team</p>
        <hr style="margin-top:30px;">
        <p style="font-size:12px; color:#6c757d; text-align:center;">This email was sent automatically. Do not reply.</p>
    </div>
</body>
</html>
