<form action="{{ route('form.submit') }}" method="POST" class="ajax-form" id="contact-form">
    @csrf
    <input type="hidden" name="form-name" value="contact">
    <input type="hidden" name="ref_url" class="ref-url-field" value="{{ request()->fullUrl() }}">
    
    {{-- Honey-pot --}}
    <div style="display:none;">
        <input type="text" name="company-name-required">
    </div>

    <div class="form-grid">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" placeholder="John Doe" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" placeholder="john@example.com" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" name="phone" id="phone" placeholder="+61 400 000 000">
        </div>
        <div class="form-group">
            <label for="subject">Subject</label>
            <select name="subject" id="subject">
                <option value="General Inquiry">General Inquiry</option>
                <option value="Property Referral">Property Referral</option>
                <option value="Investment Advice">Investment Advice</option>
                <option value="Partnership">Partnership</option>
            </select>
        </div>
        <div class="form-group full-width">
            <label for="message">How can we help?</label>
            <textarea name="message" id="message" rows="5" placeholder="Your message here..." required></textarea>
        </div>
    </div>

    <div class="form-footer">
        <button type="submit" class="btn-primary">
            <span>Send Message</span>
            <i class="fa-solid fa-paper-plane"></i>
        </button>
    </div>

    <div class="form-response"></div>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var refInputs = document.querySelectorAll(".ref-url-field");
        refInputs.forEach(function(input) {
            input.value = window.location.href;
        });
    });
</script>
