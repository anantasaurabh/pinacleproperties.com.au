<style>
.form-grid-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}
@media (max-width: 768px) {
    .form-grid-row {
        grid-template-columns: 1fr !important;
        gap: 15px !important;
        margin-bottom: 15px !important;
    }
}
</style>

<form action="{{ route('form.submit') }}" method="POST" class="ajax-form inquiry-form-standard">
    @csrf
    <input type="hidden" name="form-name" value="inquiry_long">
    <input type="hidden" name="ref_url" class="ref-url-field" value="{{ request()->fullUrl() }}">
    <div style="display:none;"><input type="text" name="company-name-required"></div>

    <!-- Row 1: Name Details -->
    <div class="form-grid-row">
        <div class="form-group">
            <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 8px;">First Name</label>
            <input type="text" name="first_name" placeholder="Enter your first name" required style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; background: #fafafa; transition: all 0.2s;" onfocus="this.style.borderColor='var(--primary-color)'; this.style.background='#fff';" onblur="this.style.borderColor='#cbd5e1'; this.style.background='#fafafa';">
        </div>
        <div class="form-group">
            <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 8px;">Family Name</label>
            <input type="text" name="family_name" placeholder="Enter your family name" required style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; background: #fafafa; transition: all 0.2s;" onfocus="this.style.borderColor='var(--primary-color)'; this.style.background='#fff';" onblur="this.style.borderColor='#cbd5e1'; this.style.background='#fafafa';">
        </div>
    </div>

    <!-- Row 2: Contact Details -->
    <div class="form-grid-row">
        <div class="form-group">
            <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 8px;">Email Address</label>
            <input type="email" name="email" placeholder="Enter your email" required style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; background: #fafafa; transition: all 0.2s;" onfocus="this.style.borderColor='var(--primary-color)'; this.style.background='#fff';" onblur="this.style.borderColor='#cbd5e1'; this.style.background='#fafafa';">
        </div>
        <div class="form-group">
            <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 8px;">Phone Number</label>
            <input type="tel" name="phone" placeholder="Enter your phone number" required style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; background: #fafafa; transition: all 0.2s;" onfocus="this.style.borderColor='var(--primary-color)'; this.style.background='#fff';" onblur="this.style.borderColor='#cbd5e1'; this.style.background='#fafafa';">
        </div>
    </div>

    <!-- Row 3: Budget & CBD Distance -->
    <div class="form-grid-row">
        <div class="form-group">
            <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 8px;">House and Land Package Budget</label>
            <select name="budget" onchange="checkOtherBudget(this)" required style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; background: #fafafa; transition: all 0.2s; cursor: pointer;" onfocus="this.style.borderColor='var(--primary-color)'; this.style.background='#fff';" onblur="this.style.borderColor='#cbd5e1'; this.style.background='#fafafa';">
                <option value="" disabled selected>Select Budget</option>
                <option value="Under $500k">Under $500k</option>
                <option value="$500k - $700k">$500k - $700k</option>
                <option value="$700k - $900k">$700k - $900k</option>
                <option value="Over $900k">Over $900k</option>
                <option value="Other">Other</option>
            </select>
            <input type="text" name="other_budget" id="other_budget" placeholder="Specify Budget" style="display:none; margin-top: 10px; width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; background: #fafafa; transition: all 0.2s;" onfocus="this.style.borderColor='var(--primary-color)'; this.style.background='#fff';" onblur="this.style.borderColor='#cbd5e1'; this.style.background='#fafafa';">
        </div>
        <div class="form-group">
            <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 8px;">Preferred Distance from CBD</label>
            <select name="distance_from_cbd" required style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; background: #fafafa; transition: all 0.2s; cursor: pointer;" onfocus="this.style.borderColor='var(--primary-color)'; this.style.background='#fff';" onblur="this.style.borderColor='#cbd5e1'; this.style.background='#fafafa';">
                <option value="" disabled selected>Select Distance</option>
                <option value="Within 20km">Within 20km</option>
                <option value="20km - 40km">20km - 40km</option>
                <option value="40km - 60km">40km - 60km</option>
                <option value="60km+">60km+</option>
            </select>
        </div>
    </div>

    <!-- Row 4: Interest & Location -->
    <div class="form-grid-row">
        <div class="form-group">
            <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 8px;">What are you interested in?</label>
            <select name="interested_in" required style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; background: #fafafa; transition: all 0.2s; cursor: pointer;" onfocus="this.style.borderColor='var(--primary-color)'; this.style.background='#fff';" onblur="this.style.borderColor='#cbd5e1'; this.style.background='#fafafa';">
                <option value="" disabled selected>Select Interest</option>
                <option value="Single Storey Home">Single Storey Home</option>
                <option value="Double Storey Home">Double Storey Home</option>
                <option value="Dual Occupancy / Duplex">Dual Occupancy / Duplex</option>
                <option value="House & Land Package">House & Land Package</option>
            </select>
        </div>
        <div class="form-group">
            <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 8px;">Preferred Location</label>
            <select name="preferred_location" required style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; background: #fafafa; transition: all 0.2s; cursor: pointer;" onfocus="this.style.borderColor='var(--primary-color)'; this.style.background='#fff';" onblur="this.style.borderColor='#cbd5e1'; this.style.background='#fafafa';">
                <option value="" disabled selected>Select Location</option>
                <option value="Melbourne (VIC)">Melbourne (VIC)</option>
                <option value="Brisbane / Gold Coast / Sunshine Coast (QLD)">Brisbane / Gold Coast / Sunshine Coast (QLD)</option>
                <option value="Other">Other</option>
            </select>
        </div>
    </div>

    <!-- Row 5: Purpose & Future Plans -->
    <div class="form-grid-row">
        <div class="form-group">
            <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 8px;">Property Purpose</label>
            <select name="property_purpose" required style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; background: #fafafa; transition: all 0.2s; cursor: pointer;" onfocus="this.style.borderColor='var(--primary-color)'; this.style.background='#fff';" onblur="this.style.borderColor='#cbd5e1'; this.style.background='#fafafa';">
                <option value="" disabled selected>Select Purpose</option>
                <option value="First Home Buyer">First Home Buyer</option>
                <option value="Investor">Investor</option>
                <option value="Upgrading / Next Home">Upgrading / Next Home</option>
            </select>
        </div>
        <div class="form-group">
            <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 8px;">Future Plans</label>
            <select name="future_plans" required style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; background: #fafafa; transition: all 0.2s; cursor: pointer;" onfocus="this.style.borderColor='var(--primary-color)'; this.style.background='#fff';" onblur="this.style.borderColor='#cbd5e1'; this.style.background='#fafafa';">
                <option value="" disabled selected>Select Plans</option>
                <option value="Build immediately">Build immediately</option>
                <option value="Build in 6 months">Build in 6 months</option>
                <option value="Build in 12+ months">Build in 12+ months</option>
            </select>
        </div>
    </div>

    <!-- Row 6: Rental Guarantee & Build Preference -->
    <div class="form-grid-row">
        <div class="form-group">
            <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 8px;">Rental Guarantee</label>
            <select name="rental_guarantee" required style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; background: #fafafa; transition: all 0.2s; cursor: pointer;" onfocus="this.style.borderColor='var(--primary-color)'; this.style.background='#fff';" onblur="this.style.borderColor='#cbd5e1'; this.style.background='#fafafa';">
                <option value="" disabled selected>Select Option</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
        <div class="form-group">
            <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 8px;">How did you hear about us?</label>
            <select name="lead_source" onchange="checkOtherSource(this)" required style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; background: #fafafa; transition: all 0.2s; cursor: pointer;" onfocus="this.style.borderColor='var(--primary-color)'; this.style.background='#fff';" onblur="this.style.borderColor='#cbd5e1'; this.style.background='#fafafa';">
                <option value="" disabled selected>Select Option</option>
                <option value="Google Search">Google Search</option>
                <option value="Social Media">Social Media</option>
                <option value="Signage / Outdoor">Signage / Outdoor</option>
                <option value="Referral / Friend">Referral / Friend</option>
                <option value="Other">Other</option>
            </select>
            <input type="text" name="other_source" id="other_source" placeholder="Specify Source" style="display:none; margin-top: 10px; width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; background: #fafafa; transition: all 0.2s;" onfocus="this.style.borderColor='var(--primary-color)'; this.style.background='#fff';" onblur="this.style.borderColor='#cbd5e1'; this.style.background='#fafafa';">
        </div>
        
    </div>

    <!-- Row 7: How did you hear about us? -->
    <div class="form-grid-row" style="margin-bottom: 30px; align-items: flex-end;">
        <div class="form-group">
            <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 8px;">Build Preference</label>
            <select name="build_preference" required style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; background: #fafafa; transition: all 0.2s; cursor: pointer;" onfocus="this.style.borderColor='var(--primary-color)'; this.style.background='#fff';" onblur="this.style.borderColor='#cbd5e1'; this.style.background='#fafafa';">
                <option value="" disabled selected>Select Preference</option>
                <option value="Pinnacle Exclusive Plan">Pinnacle Exclusive Plan</option>
                <option value="Custom Build">Custom Build</option>
            </select>
            
        </div>
        <div class="form-group">
            <span style="font-size: 0.75rem; color: #94a3b8; display: block; margin-top: 6px; line-height: 1.4;">*Customised packages may include upgraded features, selected materials, and design changes, which may incur additional costs.</span>
        </div>
    </div>

    <!-- Submit Button & Response -->
    <div class="form-footer-v2">
        <p style="font-weight: 600; color: var(--primary-color); margin-bottom: 20px;">Secure your future dream property and start building wealth while saving money.</p>
        <button type="submit" class="btn-primary" style="margin:auto; padding: 15px 30px; background: var(--primary-color); border: none; border-radius: 8px; color: #fff; font-weight: 700; font-size: 1rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; transition: all 0.3s;" onmouseover="this.style.background='#0f4125'; this.style.transform='translateY(-1px)';" onmouseout="this.style.background='var(--primary-color)'; this.style.transform='translateY(0)';">
            <span>Submit Inquiry</span>
            <i class="fa-solid fa-paper-plane"></i>
        </button>
    </div>

    <div class="form-response" style="margin-top: 20px; font-size: 0.95rem; text-align: center;"></div>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var refInputs = document.querySelectorAll(".ref-url-field");
        refInputs.forEach(function(input) {
            input.value = window.location.href;
        });
    });
</script>
