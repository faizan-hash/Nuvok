<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #4f46e5; padding: 20px; text-align: center; color: white; border-radius: 8px 8px 0 0; }
        .content { padding: 25px; border: 1px solid #e5e7eb; border-top: none; border-radius: 0 0 8px 8px; }
        .credentials { background-color: #f9fafb; padding: 15px; border-radius: 6px; margin: 20px 0; }
        .credential-row { margin-bottom: 8px; display: flex; }
        .credential-label { font-weight: 600; width: 100px; color: #6b7280; }
        .button { display: inline-block; padding: 10px 20px; background-color: #4f46e5; color: white; text-decoration: none; border-radius: 6px; font-weight: 500; }
        .footer { margin-top: 30px; font-size: 12px; color: #6b7280; text-align: center; }
        .security-note { color: #ef4444; font-size: 13px; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to {{ config('app.name') }}</h1>
        </div>
        
        <div class="content">
            <p>Dear {{ $client->first_name }} {{ $client->last_name }},</p>
            <p>Your account has been successfully created. Here are your login credentials:</p>
            
            <div class="credentials">
                <div class="credential-row">
                    <span class="credential-label">Login URL:</span>
                    <span><a href="{{ route('login') }}">{{ route('login') }}</a></span>
                </div>
                <div class="credential-row">
                    <span class="credential-label">Email:</span>
                    <span>{{ $client->email }}</span>
                </div>
                <div class="credential-row">
                    <span class="credential-label">Password:</span>
                    <span>{{ $password }}</span> <!-- This will show the plain password -->
                </div>
            </div>
            
            <p class="security-note">
                <strong>Important:</strong> For security reasons, please change your password after first login.
            </p>
            
            <a href="{{ route('login') }}" class="button">
                Login to Your Account
            </a>
            
            @if($client->mobile)
            <p style="margin-top: 20px;">
                Need help? Contact us at {{ $client->mobile }} or reply to this email.
            </p>
            @endif
        </div>
        
        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>If you didn't request this account, please contact us immediately.</p>
        </div>
    </div>
</body>
</html>