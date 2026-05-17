<form action="{{ route('form.submit') }}" method="POST" class="ajax-form referral-form-standard">
    @csrf
    <input type="hidden" name="form-name" value="referral">
    <div style="display:none;"><input type="text" name="company-name-required"></div>

    <div class="form-section">
        <span class="section-label">Your Details (Referrer)</span>
        <div class="form-group">
            <label class="field-label">Full Name</label>
            <input type="text" name="referrer_name" placeholder="John Doe" required>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label class="field-label">Phone Number</label>
                <input type="text" name="referrer_phone" placeholder="0400 000 000" required>
            </div>
            <div class="form-group">
                <label class="field-label">Email Address</label>
                <input type="email" name="referrer_email" placeholder="john@example.com" required>
            </div>
        </div>
        <div class="form-group">
            <label class="field-label">Build Street Address</label>
            <input type="text" name="referrer_street" placeholder="123 Example St" required>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label class="field-label">Suburb</label>
                <input type="text" name="referrer_suburb" placeholder="Melbourne" required>
            </div>
            <div class="form-group">
                <label class="field-label">State</label>
                <select name="referrer_state" required>
                    <option value="Victoria">Victoria</option>
                    <option value="Queensland">Queensland</option>
                </select>
            </div>
        </div>
        <div class="form-group" style="width: 50%;">
            <label class="field-label">Postcode</label>
            <input type="text" name="referrer_postcode" placeholder="3000" required>
        </div>
    </div>

    <div class="form-section" style="margin-top: 30px;">
        <span class="section-label">Friend / Family Details</span>
        <div class="form-group">
            <label class="field-label">Full Name</label>
            <input type="text" name="friend_name" placeholder="Jane Smith" required>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label class="field-label">Phone Number</label>
                <input type="text" name="friend_phone" placeholder="0400 000 000" required>
            </div>
            <div class="form-group">
                <label class="field-label">Email Address</label>
                <input type="email" name="friend_email" placeholder="jane@example.com" required>
            </div>
        </div>
    </div>

    <div class="checkbox-group" style="margin: 25px 0;">
        <input type="checkbox" id="agree_terms" name="agree_terms" required>
        <label for="agree_terms">
            I agree to Pinnacle Home and Investment's 
            <a href="/privacy-policy" target="_blank" style="color: var(--primary-color); text-decoration: underline;">privacy policy</a> and 
            <a href="/terms-of-service" target="_blank" style="color: var(--primary-color); text-decoration: underline;">terms</a>
        </label>
    </div>

    <div class="form-footer">
        <button type="submit" class="btn-primary" style="width: 100%; padding: 15px;">Submit Referral</button>
    </div>
    <div class="form-response"></div>
</form>

<style>
.referral-form-standard .form-section {
    border-bottom: 1px solid #f0f0f0;
    padding-bottom: 20px;
    margin-bottom: 20px;
}
.referral-form-standard .section-label {
    display: block;
    text-transform: uppercase;
    font-size: 0.75rem;
    font-weight: 800;
    color: var(--primary-color);
    letter-spacing: 1px;
    margin-bottom: 20px;
}
.referral-form-standard .field-label {
    display: block;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 8px;
    color: #333;
}
.referral-form-standard .form-group {
    margin-bottom: 15px;
}
.referral-form-standard .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}
.referral-form-standard input, 
.referral-form-standard select {
    width: 100%;
    padding: 12px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    background: #f9f9f9;
}
.referral-form-standard .checkbox-group {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 0.9rem;
    color: #666;
}
.referral-form-standard .checkbox-group input {
    width: auto;
    margin-top: 4px;
}
</style>
