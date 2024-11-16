<!DOCTYPE html>
<html>
<head>
    <title>Verification Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            color: #2e2b2b;
        }
        .header h1 {
            margin: 0;
        }
        .content {
            color: #333333;
            line-height: 1.6;
        }
        .verification-code {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            background-color: #f4f4f4;
            padding: 10px;
            text-align: center;
            border-radius: 8px;
            margin: 20px 0;
        }
        .footer {
            font-size: 12px;
            color: #777;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Email Verification</h1>
        </div>
        <div class="content">
            <p>Hello,</p>
            <p>Please use the verification code below to verify your email address. This code is valid for a limited time only.</p>
            <div class="verification-code">{{ $verificationCode }}</div>
            <p>If you did not request this code, please ignore this email.</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Team Developer. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
