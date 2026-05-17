<form action="{{ route('form.submit') }}" method="POST" class="ajax-form newsletter-form">
    @csrf
    <input type="hidden" name="form-name" value="newsletter">
    <div style="display:none;"><input type="text" name="company-name-required"></div>
    
    <input type="email" name="email" placeholder="Email Address" required>
    <button type="submit" class="btn-submit">Subscribe</button>
    
    <div class="form-response newsletter-response"></div>
</form>
