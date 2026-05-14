<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Inter', sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
        .header { background: #2D4628; color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
        .section-title { font-weight: bold; font-size: 1.2rem; margin-top: 20px; color: #2D4628; border-bottom: 2px solid #f0f0f0; padding-bottom: 5px; }
        .content { padding: 20px; }
        .field { margin-bottom: 10px; }
        .label { font-weight: bold; color: #555; }
        .footer { text-align: center; font-size: 0.8rem; color: #777; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Referral Received</h2>
        </div>
        <div class="content">
            <div class="section-title">Referrer Details</div>
            <div class="field"><span class="label">Name:</span> {{ $data['referrer_name'] }}</div>
            <div class="field"><span class="label">Email:</span> {{ $data['referrer_email'] }}</div>
            <div class="field"><span class="label">Phone:</span> {{ $data['referrer_phone'] }}</div>
            <div class="field"><span class="label">Address:</span> {{ $data['referrer_street'] }}, {{ $data['referrer_suburb'] }}, {{ $data['referrer_state'] }} {{ $data['referrer_postcode'] }}</div>

            <div class="section-title">Friend Details</div>
            <div class="field"><span class="label">Name:</span> {{ $data['friend_name'] }}</div>
            <div class="field"><span class="label">Email:</span> {{ $data['friend_email'] }}</div>
            <div class="field"><span class="label">Phone:</span> {{ $data['friend_phone'] }}</div>
        </div>
        <div class="footer">
            <p>This referral was sent from the Pinnacle Properties website.</p>
        </div>
    </div>
</body>
</html>
