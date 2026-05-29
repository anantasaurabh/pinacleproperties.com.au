<section class="section" id="about-pinnacle">
    <div class="container">
        <div class="about-grid">
            <div class="about-content">
                <div class="section-title" style="text-align: left; margin-bottom: 30px;">
                    <span>ABOUT US</span>
                    <h2 style="font-size: 2.8rem; line-height: 1.2;">About Pinnacle Home and Investments</h2>
                </div>
                <p class="lead" style="font-size: 1.15rem; color: var(--text-color); margin-bottom: 30px;">
                   Pinnacle Home & Investment delivers a premium real estate ecosystem designed to connect buyers, investors, developers, and industry professionals nationwide. Through strategic partnerships, market expertise, and a transparent referral approach, we help clients secure high-quality property opportunities while creating long-term value and sustainable growth.
                </p>
                
                <div class="purpose-box" style="background: rgba(var(--primary-color-rgb), 0.05); padding: 40px; border-radius: 20px; border-left: 5px solid var(--primary-color);">
                    <h4 style="color: var(--primary-color); margin-bottom: 20px; font-size: 1.4rem;">Our purpose is to help families and investors secure:</h4>
                    <ul class="benefits-list" style="margin-bottom: 0;">
                        <li><i class="fa-solid fa-circle-check"></i> Brand-new house and land packages</li>
                        <li><i class="fa-solid fa-circle-check"></i> Land-only opportunities</li>
                        <li><i class="fa-solid fa-circle-check"></i> Flexible settlement options within 6, 12, 18, or 24 months</li>
                        <li><i class="fa-solid fa-circle-check"></i> Opportunities available with as little as a 5% deposit</li>
                    </ul>
                </div>
            </div>
            <div class="about-image">
                <img src="{{ asset('assets/images/pinnacle_about.png') }}" alt="Pinnacle Home and Investments" style="width: 100%; border-radius: 30px; box-shadow: 0 30px 60px rgba(0,0,0,0.15);">
                <div class="about-stats" style="bottom: 20px; right: 20px;">
                    <div class="stat-item text-white">
                        <strong>5%</strong>
                        <span>Minimum Deposit</span>
                    </div>
                    <div class="stat-item text-white">
                        <strong>24m</strong>
                        <span>Flexible Settlement</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('styles')
<style>
#about-pinnacle .benefits-list li {
    font-size: 1.1rem;
    margin-bottom: 15px;
    font-weight: 500;
    transition: var(--transition);
}
#about-pinnacle .benefits-list li:hover {
    transform: translateX(10px);
    color: var(--primary-color);
}
#about-pinnacle .benefits-list li i {
    font-size: 1.2rem;
}
#about-pinnacle .purpose-box {
    transition: var(--transition);
}
#about-pinnacle .purpose-box:hover {
    box-shadow: 0 20px 40px rgba(var(--primary-color-rgb), 0.1);
    transform: translateY(-5px);
}
@media (max-width: 992px) {
    .about-grid {
        grid-template-columns: 1fr;
        gap: 50px;
    }
    .about-content {
        order: 2;
    }
    .about-image {
        order: 1;
    }
}
</style>
@endpush
