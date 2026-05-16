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
                <div class="info-card urgency" style="margin-top: 20px;">
                    <i class="fas fa-question-circle"></i>
                    <h3>Why Choose Pinnacle?</h3>
                    <ul style="list-style: none; padding: 0; margin: 15px 0 0 0;">
                        <li style="margin-bottom: 10px; display: flex; align-items: flex-start; gap: 10px;">
                            <i class="fas fa-check" style="color: var(--primary-color); font-size: 0.9rem; margin-top: 4px;"></i>
                            <span>Tailored property solutions for families & investors</span>
                        </li>
                        <li style="margin-bottom: 10px; display: flex; align-items: flex-start; gap: 10px;">
                            <i class="fas fa-check" style="color: var(--primary-color); font-size: 0.9rem; margin-top: 4px;"></i>
                            <span>Access to exclusive house & land packages</span>
                        </li>
                        <li style="margin-bottom: 10px; display: flex; align-items: flex-start; gap: 10px;">
                            <i class="fas fa-check" style="color: var(--primary-color); font-size: 0.9rem; margin-top: 4px;"></i>
                            <span>Strategic advice for long-term wealth building</span>
                        </li>
                    </ul>
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
                            <label for="budget">House and Land Package Budget</label>
                            <select id="budget" name="budget" required onchange="checkOtherBudget(this)">
                                <option value="" disabled selected>Select Budget</option>
                                <option value="$600,000">$600,000</option>
                                <option value="$625,000">$625,000</option>
                                <option value="$675,000">$675,000</option>
                                <option value="$700,000">$700,000</option>
                                <option value="$725,000">$725,000</option>
                                <option value="$750,000">$750,000</option>
                                <option value="$775,000">$775,000</option>
                                <option value="$800,000">$800,000</option>
                                <option value="$825,000">$825,000</option>
                                <option value="$850,000">$850,000</option>
                                <option value="$875,000">$875,000</option>
                                <option value="$900,000">$900,000</option>
                                <option value="Other">Other amount</option>
                            </select>
                            <input type="text" id="other_budget" name="other_budget" placeholder="Specify other amount" style="display:none; margin-top: 10px;">
                        </div>
                        <div class="form-group">
                            <label for="distance">Preferred Distance from CBD</label>
                            <select id="distance" name="distance" required>
                                <option value="" disabled selected>Select Distance</option>
                                <option value="25 km">25 km</option>
                                <option value="30 km">30 km</option>
                                <option value="35 km">35 km</option>
                                <option value="40 km">40 km</option>
                                <option value="45 km">45 km</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="interest">What are you interested in?</label>
                            <select id="interest" name="interest" required>
                                <option value="" disabled selected>Select Interest</option>
                                <option value="Buying for my own living">Buying for my own living</option>
                                <option value="Investment property">Investment property</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="location">Preferred Location</label>
                            <select id="location" name="location" required>
                                <option value="" disabled selected>Select Location</option>
                                <option value="VIC">Victoria (VIC)</option>
                                <option value="QLD">Queensland (QLD)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="purpose">Property Purpose</label>
                            <select id="purpose" name="purpose" required>
                                <option value="" disabled selected>Select Purpose</option>
                                <option value="Primary home">Primary home</option>
                                <option value="Investment property">Investment property</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="plans">Future Plans</label>
                            <select id="plans" name="plans" required>
                                <option value="" disabled selected>Select Plans</option>
                                <option value="Looking to move in">Looking to move in</option>
                                <option value="Looking to lease to tenants">Looking to lease to tenants</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="rental_guarantee">Rental Guarantee</label>
                            <select id="rental_guarantee" name="rental_guarantee" required>
                                <option value="" disabled selected>Select Option</option>
                                <option value="Yes">Yes, looking for at least 2 years</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="build_preference">Build Preference</label>
                            <select id="build_preference" name="build_preference" required>
                                <option value="" disabled selected>Select Preference</option>
                                <option value="Standard">Standard package</option>
                                <option value="Customised">Customised package</option>
                            </select>
                            <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 10px;">*Customised packages may include upgraded features, selected materials, and design changes, which may incur additional costs.</p>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="source">How did you hear about us?</label>
                            <select id="source" name="source" required onchange="checkOtherSource(this)">
                                <option value="" disabled selected>Select Option</option>
                                <option value="Friends and family">Friends and family</option>
                                <option value="Website">Website</option>
                                <option value="Referral partner">Referral partner</option>
                                <option value="Other">Other (please specify)</option>
                            </select>
                            <input type="text" id="other_source" name="other_source" placeholder="Please specify" style="display:none; margin-top: 10px;">
                        </div>
                    </div>

                    <div class="form-footer" style="text-align: center; margin-top: 30px;">
                        <p style="font-weight: 600; color: var(--primary-color); margin-bottom: 20px;">Secure your future dream property and start building wealth while saving money.</p>
                        <button type="submit" class="btn-primary" id="submitBtn" style="width: 100%; max-width: 400px; padding: 18px;">
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
function checkOtherSource(select) {
        const otherInput = document.getElementById('other_source');
        if (select.value === 'Other') {
            otherInput.style.display = 'block';
            otherInput.required = true;
        } else {
            otherInput.style.display = 'none';
            otherInput.required = false;
        }
    }

    function checkOtherBudget(select) {
        const otherInput = document.getElementById('other_budget');
        if (select.value === 'Other') {
            otherInput.style.display = 'block';
            otherInput.required = true;
        } else {
            otherInput.style.display = 'none';
            otherInput.required = false;
        }
    }

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
