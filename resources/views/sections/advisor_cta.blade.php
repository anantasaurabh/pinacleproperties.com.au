<section class="advisor-cta section">
    <div class="container">
        <div class="advisor-card">
            <div class="advisor-content">
                <div class="advisor-image-wrapper">
                    <div class="advisor-placeholder-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                </div>
                <div class="advisor-details">
                    <h3>Talk to Our Property Advisor</h3>
                    <p>Connect with our expert to discuss your property goals, investment strategies, or any questions about house and land packages in Victoria and Queensland.</p>
                    
                    <div class="advisor-contact-box">
                        <div class="contact-item">
                            <span class="label">Expert Advisor</span>
                            <span class="value">Aman</span>
                        </div>
                        <div class="contact-divider"></div>
                        <a href="tel:1300000000" class="contact-item phone-link">
                            <span class="label">Call Directly</span>
                            <span class="value"><i class="fas fa-phone-alt"></i> 1300 000 000</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="advisor-action-btn">
                <a href="https://calendly.com/{{ env('CALENDLY_USERNAME', 'pinnacle-group') }}" target="_blank" class="btn-primary">Schedule a Call</a>
            </div>
        </div>
    </div>
</section>
@push('styles')
<style>
.advisor-cta {
    background: var(--bg-light);
    padding: 80px 0;
}

.advisor-card {
    background: var(--white);
    border-radius: 24px;
    padding: 50px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 20px 40px rgba(0,0,0,0.05);
    position: relative;
    overflow: hidden;
    border: 1px solid var(--border-color);
}

.advisor-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 6px;
    height: 100%;
    background: var(--primary-color);
}

.advisor-content {
    display: flex;
    align-items: center;
    gap: 40px;
    flex: 1;
}

.advisor-image-wrapper {
    width: 100px;
    height: 100px;
    background: rgba(var(--primary-color-rgb), 0.1);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.advisor-placeholder-icon {
    font-size: 3rem;
    color: var(--primary-color);
}

.advisor-details h3 {
    font-size: 2rem;
    color: var(--primary-color);
    margin-bottom: 12px;
}

.advisor-details p {
    color: var(--text-muted);
    max-width: 600px;
    line-height: 1.6;
    margin-bottom: 25px;
}

.advisor-contact-box {
    display: flex;
    align-items: center;
    gap: 30px;
}

.contact-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.contact-item .label {
    font-size: 0.85rem;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 600;
}

.contact-item .value {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--secondary-color);
}

.contact-divider {
    width: 1px;
    height: 40px;
    background: var(--border-color);
}

.phone-link {
    text-decoration: none;
    transition: var(--transition);
}

.phone-link .value {
    color: var(--primary-color);
    display: flex;
    align-items: center;
    gap: 10px;
}

.phone-link:hover .value {
    color: var(--secondary-color);
    transform: translateX(5px);
}

.advisor-action-btn .btn-primary {
    padding: 18px 40px;
    font-size: 1.1rem;
    white-space: nowrap;
}

@media (max-width: 1100px) {
    .advisor-card {
        flex-direction: column;
        padding: 40px;
        text-align: center;
        gap: 30px;
    }
    
    .advisor-content {
        flex-direction: column;
        gap: 25px;
    }
    
    .advisor-contact-box {
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .contact-divider {
        display: none;
    }
}

@media (max-width: 600px) {
    .advisor-details h3 {
        font-size: 1.5rem;
    }
    
    .advisor-contact-box {
        flex-direction: column;
        gap: 20px;
    }
}
</style>
@endpush
