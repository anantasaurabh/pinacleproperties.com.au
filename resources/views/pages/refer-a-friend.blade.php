@extends('layouts.app')

@section('content')
<main class="page-content">
    <section class="page-hero-premium" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('assets/images/referral-hero.png') }}');">
        <div class="container">
            <div class="hero-text-content">
                <h1>Refer a Friend</h1>
                <p class="lead">Receive exclusive rewards through our Pinnacle Loyalty Club.</p>
            </div>
        </div>
    </section>

    <section class="section" style="background: white;">
        <div class="container">
            <div class="referral-layout">
                <div class="referral-info">
                    <h2>Become a member of the Pinnacle Loyalty Club and enjoy exclusive rewards!</h2>
                    <p>For every successful referral or additional property purchase, you’ll receive a referral fee as a token of our appreciation. Plus, stay informed with regular updates on current and future Pinnacle Home and Investment projects across Victoria and Queensland.</p>
                    <p>At Pinnacle Home and Investment, we’re committed to building strong relationships with our customers, and our Loyalty Club reflects that commitment. With thousands of happy homeowners and decades of experience, we pride ourselves on delivering dream homes that stand the test of time.</p>
                    
                    <div class="referral-steps-box">
                        <h3>How it works:</h3>
                        <ol class="step-list">
                            <li>
                                <strong>Complete the online form:</strong>
                                <p>Simply fill out the form and submit it to our head office. Referring multiple people? No problem! Just complete a form for each referral.</p>
                            </li>
                            <li>
                                <strong>Receive a confirmation email:</strong>
                                <p>A copy of the form will be sent to your email. Share it with your friend or family member who’s interested in building with Pinnacle Home and Investment.</p>
                            </li>
                            <li>
                                <strong>Earn your reward:</strong>
                                <p>Once your referred friend’s new home construction begins, you’ll receive your cash reward via bank transfer.</p>
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="referral-form-box-light" id="referral-form">
                    <div class="form-header">
                        <h3>Submit Referral</h3>
                    </div>
                    @include('forms.referral')
                </div>
            </div>
        </div>
    </section>

    <section class="section" style="background: #fafafa;">
        <div class="container">
            <div class="section-title">
                <h2>Frequently Asked Questions</h2>
            </div>
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        What if my family member or friend have already spoken to a Pinnacle staff member about building their dream home?
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>To be eligible for the referral reward, the referred friend must not be an existing lead in our system. The referral form must be submitted before their first official appointment with a New Home Sales professional.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        Is there a limit to how many friends I can refer?
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>No, there is no limit! You can refer as many friends and family members as you like. A separate form must be completed for each individual referral.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        When will I receive my cash reward?
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>The referral fee is processed once construction of the referred client's new home has officially commenced. Payments are typically made via bank transfer within 30 days of construction start.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        Is there any where I can view the full terms and conditions?
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, here are the key terms and conditions:</p>
                        <ul>
                            <li>The referrer must have been a client of Pinnacle Home and Investment.</li>
                            <li>The referred client must not be an existing or previous Pinnacle Home and Investment customer.</li>
                            <li>The offer will be issued once the referred client's house commences construction.</li>
                            <li>Referrals made after 1st September 2024 will receive $2,000 for a single storey home & $3,000 for a double storey home.</li>
                            <li>A maximum of one referral incentive can be claimed per house sold.</li>
                            <li>Referral form with referring customer details must be completed prior to payment of initial preliminary fee to be claimed.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('styles')
<style>
.page-hero-premium {
    height: 450px;
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    color: white;
}

.hero-text-content h1 {
    font-size: 3.5rem;
    margin-bottom: 20px;
    font-weight: 800;
}

.hero-text-content .lead {
    font-size: 1.4rem;
    max-width: 600px;
}

.referral-layout {
    display: grid;
    grid-template-columns: 1.2fr 0.8fr;
    gap: 60px;
    align-items: start;
}

.referral-info h2 {
    font-size: 2rem;
    margin-bottom: 30px;
    color: var(--primary-color-dark);
    line-height: 1.4;
}

.referral-info p {
    margin-bottom: 25px;
    line-height: 1.8;
    color: #444;
}

.referral-steps-box {
    margin-top: 50px;
    padding: 40px;
    background: #fdfdfd;
    border-radius: 20px;
    border: 1px solid var(--border-color);
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
}

.referral-steps-box h3 {
    margin-bottom: 25px;
    font-size: 1.4rem;
    color: var(--primary-color);
}

.step-list {
    counter-reset: step-counter;
    list-style: none;
    padding-left: 0;
}

.step-list li {
    position: relative;
    padding-left: 50px;
    margin-bottom: 30px;
}

.step-list li::before {
    counter-increment: step-counter;
    content: counter(step-counter);
    position: absolute;
    left: 0;
    top: 0;
    width: 35px;
    height: 35px;
    background: var(--primary-color);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.step-list li strong {
    display: block;
    color: var(--primary-color-dark);
    margin-bottom: 8px;
    font-size: 1.1rem;
}

/* Light Form Styles */
.referral-form-box-light {
    background: white;
    padding: 40px;
    border-radius: 24px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.08);
    border: 1px solid var(--border-color);
    position: sticky;
    top: 100px;
}

.form-header h3 {
    margin-bottom: 35px;
    font-size: 1.8rem;
    color: var(--primary-color-dark);
    text-align: center;
}

.form-section {
    margin-bottom: 35px;
}

.section-label {
    display: block;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 1.5px;
    color: var(--primary-color);
    margin-bottom: 20px;
    font-weight: 800;
    border-bottom: 2px solid #f0f0f0;
    padding-bottom: 10px;
}

.field-label {
    display: block;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 8px;
    color: #666;
}

.referral-form-box-light .form-group input,
.referral-form-box-light .form-group select {
    background: #f9f9f9;
    border: 1px solid #e0e0e0;
    color: #333;
    width: 100%;
    padding: 12px 15px;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.referral-form-box-light .form-group input:focus,
.referral-form-box-light .form-group select:focus {
    border-color: var(--primary-color);
    background: white;
    box-shadow: 0 0 0 4px rgba(65, 182, 251, 0.1);
    outline: none;
}

.checkbox-group {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 25px;
}

.checkbox-group input[type="checkbox"] {
    width: 18px !important;
    height: 18px !important;
    margin-top: 2px;
    cursor: pointer;
}

.checkbox-group label {
    line-height: 1.5;
    cursor: pointer;
}

.checkbox-group a {
    color: var(--primary-color);
    text-decoration: underline;
    font-weight: 600;
}


/* FAQ Styles */
.faq-container {
    max-width: 900px;
    margin: 0 auto;
}

.faq-item {
    background: white;
    margin-bottom: 15px;
    border-radius: 12px;
    border: 1px solid var(--border-color);
    overflow: hidden;
    transition: all 0.3s ease;
}

.faq-item.active {
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    border-color: var(--primary-color);
}

.faq-question {
    padding: 22px 30px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: var(--primary-color-dark);
}

.faq-question i {
    transition: transform 0.3s ease;
    color: var(--primary-color);
}

.faq-answer {
    padding: 0 30px;
    max-height: 0;
    overflow: hidden;
    transition: all 0.3s ease;
    background: #fff;
}

.faq-item.active .faq-answer {
    padding: 10px 30px 30px;
    max-height: 500px;
}

.faq-item.active .faq-question i {
    transform: rotate(45deg);
}

@media (max-width: 992px) {
    .referral-layout {
        grid-template-columns: 1fr;
        gap: 50px;
    }
    
    .referral-form-box-light {
        position: static;
    }
    
    .hero-text-content h1 {
        font-size: 2.5rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Referral page JS loaded');
    
    // FAQ Accordion
    const faqQuestions = document.querySelectorAll('.faq-question');
    faqQuestions.forEach(question => {
        question.addEventListener('click', () => {
            const item = question.parentElement;
            
            // Close other items
            document.querySelectorAll('.faq-item').forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });
            
            item.classList.toggle('active');
        });
    });
});
</script>
@endpush

