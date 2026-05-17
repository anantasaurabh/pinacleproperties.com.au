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
                @include('forms.inquiry_long')
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
</script>
@endpush
