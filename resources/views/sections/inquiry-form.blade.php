<section id="inquiry" class="section">
    <div class="container">
        <div class="section-title">
            <span>Get in Touch</span>
            <h2>Secure Your Dream Home</h2>
            <p class="lead">Fill out the form below to inquire about our premium house and land packages. One can secure the package by making a 5% deposit now before the price increases.</p>
        </div>

        <div class="inquiry-wrapper">
            <div class="inquiry-info">
                <div class="info-image">
                    <img src="{{ asset('assets/images/inquiry-couple.png') }}" alt="Secure Your Dream Home">
                </div>
                <div class="info-card urgency">
                    <!-- <div class="urgency-badge">Act Now</div> -->
                    <i class="fas fa-key"></i>
                    <h3>Secure Today</h3>
                    <p> <em>Prices are increasing rapidly in VIC and QLD. </em> </p> <p > Secure your package with just a <b>5%</b> deposit and lock in current market rates before the next increase.</p>
                </div>
                
            </div>

            <div class="inquiry-form-container">
                <form id="inquiryForm" action="{{ route('inquiry.submit') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" placeholder="Enter your first name" required>
                        </div>
                        <div class="form-group">
                            <label for="family_name">Family Name</label>
                            <input type="text" id="family_name" name="family_name" placeholder="Enter your family name" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="estate">Estate (Optional)</label>
                            <input type="text" id="estate" name="estate" placeholder="Name of estate (if any)">
                        </div>
                        <div class="form-group">
                            <label for="city">Which city are you looking to buy in?</label>
                            <select id="city" name="city" required>
                                <option value="" disabled selected>Select City</option>
                                <option value="VIC">VIC</option>
                                <option value="QLD">QLD</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="timeline">When are you planning to move in?</label>
                            <select id="timeline" name="timeline" required>
                                <option value="" disabled selected>Select Timeline</option>
                                <option value="6 months">6 Months</option>
                                <option value="9 months">9 Months</option>
                                <option value="12 months">12 Months</option>
                                <option value="18 months">18 Months</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="source">How did you hear about us?</label>
                            <select id="source" name="source" required>
                                <option value="" disabled selected>Select Option</option>
                                <option value="Social Media">Social Media</option>
                                <option value="Google Search">Google Search</option>
                                <option value="Friend/Family">Friend/Family</option>
                                <option value="Billboard">Billboard</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Do you have finance ready?</label>
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="finance" value="Ready" required> Yes, <br>finance is ready
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="finance" value="Need Help"> No, <br>I need help
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Build Type</label>
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="build_type" value="Standard" checked> Standard Build
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="build_type" value="Customize"> Customize Build
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn-primary" id="submitBtn">
                            Submit Inquiry
                        </button>
                    </div>

                    <div id="formMessage" class="form-message"></div>

                    
                </form>
                <!-- <div  style="margin-top: 1rem;" >
                    <div style="display:flex;align-items:center;gap:1rem;"><i class="fas fa-hammer"></i>
                    <h3>Expert Builders</h3>
</div>
                    <p>We have top level of experience builders who can build a dream house. Whether you choose a standard design or a fully customized build, we ensure quality at every step.</p>
                </div> -->
            </div>
        </div>
    </div>
</section>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inquiryForm = document.getElementById('inquiryForm');
    const formMessage = document.getElementById('formMessage');
    const submitBtn = document.getElementById('submitBtn');

    if (inquiryForm) {
        inquiryForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Disable button and show loading state
            submitBtn.disabled = true;
            const originalBtnText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
            
            formMessage.style.display = 'none';
            formMessage.className = 'form-message';

            const formData = new FormData(inquiryForm);

            fetch(inquiryForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    formMessage.textContent = data.message || 'Your inquiry has been submitted successfully! We will get back to you soon.';
                    formMessage.classList.add('success');
                    inquiryForm.reset();
                } else {
                    formMessage.textContent = data.message || 'There was an error submitting your inquiry. Please try again.';
                    formMessage.classList.add('error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                formMessage.textContent = 'A network error occurred. Please try again.';
                formMessage.classList.add('error');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
                formMessage.style.display = 'block';
            });
        });
    }
});
</script>
@endpush
