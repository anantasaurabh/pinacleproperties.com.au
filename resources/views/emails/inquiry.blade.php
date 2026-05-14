<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Inter', sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
        .header { background: #2D4628; color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { padding: 20px; }
        .field { margin-bottom: 15px; border-bottom: 1px solid #f9f9f9; padding-bottom: 5px; }
        .label { font-weight: bold; color: #2D4628; display: block; font-size: 0.9rem; }
        .value { font-size: 1.1rem; }
        .footer { text-align: center; font-size: 0.8rem; color: #777; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Inquiry Received</h2>
        </div>
        <div class="content">
            <div class="field">
                <span class="label">Name:</span>
                <span class="value">{{ $data['first_name'] }} {{ $data['family_name'] }}</span>
            </div>
            <div class="field">
                <span class="label">Email Address:</span>
                <span class="value">{{ $data['email'] }}</span>
            </div>
            <div class="field">
                <span class="label">Phone Number:</span>
                <span class="value">{{ $data['phone'] }}</span>
            </div>
            <div class="field">
                <span class="label">Estate:</span>
                <span class="value">{{ $data['estate'] ?? 'N/A' }}</span>
            </div>
            <div class="field">
                <span class="label">Looking to buy in:</span>
                <span class="value">{{ $data['city'] }}</span>
            </div>
            <div class="field">
                <span class="label">Finance Ready:</span>
                <span class="value">{{ $data['finance'] }}</span>
            </div>
            <div class="field">
                <span class="label">How did they hear about us:</span>
                <span class="value">{{ $data['source'] ?? 'Not specified' }}</span>
            </div>
            <div class="field">
                <span class="label">Planning to move in:</span>
                <span class="value">{{ $data['timeline'] }}</span>
            </div>
            <div class="field">
                <span class="label">Build Type:</span>
                <span class="value">{{ $data['build_type'] }}</span>
            </div>
        </div>
        <div class="footer">
            <p>This inquiry was sent from the Pinnacle Properties website.</p>
        </div>
    </div>
</body>
</html>
