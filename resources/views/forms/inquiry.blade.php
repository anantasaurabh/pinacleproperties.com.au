<form action="{{ route('form.submit') }}" method="POST" class="ajax-form inquiry-form-standard">
    @csrf
    <input type="hidden" name="form-name" value="inquiry">
    <input type="hidden" name="ref_url" class="ref-url-field" value="{{ request()->fullUrl() }}">
    <div style="display:none;"><input type="text" name="company-name-required"></div>

    @if(isset($property))
        <input type="hidden" name="property_id" value="{{ $property->id }}">
        <input type="hidden" name="property_title" value="{{ $property->title }}">
        <div class="property-notice" style="background: #f8fafc; border-left: 4px solid var(--primary-color); padding: 12px 15px; border-radius: 4px 8px 8px 4px; margin-bottom: 20px; font-size: 0.9rem; color: #334155; font-weight: 500;">
            Inquiring about: <strong style="color: var(--primary-color);">{{ $property->title }}</strong>
        </div>
    @endif

    <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
        <div class="form-group">
            <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 6px;">First Name</label>
            <input type="text" name="first_name" placeholder="First Name" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem; outline: none; transition: border-color 0.2s;">
        </div>
        <div class="form-group">
            <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Family Name</label>
            <input type="text" name="family_name" placeholder="Family Name" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem; outline: none; transition: border-color 0.2s;">
        </div>
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Email Address</label>
        <input type="email" name="email" placeholder="Enter your email address" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem; outline: none; transition: border-color 0.2s;">
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Phone Number</label>
        <input type="tel" name="phone" placeholder="Enter your phone number" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem; outline: none; transition: border-color 0.2s;">
    </div>

    <div class="form-group" style="margin-bottom: 20px;">
        <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Message / Enquiry (Optional)</label>
        <textarea name="message" rows="4" placeholder="I am interested in this package. Please contact me with more information." style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem; outline: none; transition: border-color 0.2s; resize: vertical;"></textarea>
    </div>

    <div class="form-footer-v2">
        <button type="submit" class="btn-primary" id="submitBtn" style="width: 100%; padding: 12px; background: var(--primary-color); border: none; border-radius: 8px; color: #fff; font-weight: 700; font-size: 0.95rem; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='#1b4332'" onmouseout="this.style.background='var(--primary-color)'">
            Submit Inquiry
        </button>
    </div>

    <div class="form-response" style="margin-top: 15px; font-size: 0.9rem; text-align: center;"></div>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var refInputs = document.querySelectorAll(".ref-url-field");
        refInputs.forEach(function(input) {
            input.value = window.location.href;
        });
    });
</script>
