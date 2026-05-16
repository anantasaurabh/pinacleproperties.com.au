<section class="section" id="invest-victoria" style="overflow: hidden;">
    <div class="container">
        <div class="about-grid" style="grid-template-columns: 1.1fr 0.9fr; gap: 60px; align-items: center;">
            <div class="about-image" style="position: relative;">
                <div class="image-wrapper" style="position: relative; z-index: 2;">
                    <img src="{{ asset('assets/images/melbourne_investment.png') }}" alt="Melbourne Victoria" style="width: 100%; border-radius: 24px; box-shadow: 0 40px 80px rgba(0,0,0,0.2);">
                </div>
                <!-- Decorative element -->
                <div style="position: absolute; top: -30px; left: -30px; width: 200px; height: 200px; background: rgba(var(--secondary-color-rgb), 0.1); border-radius: 50%; z-index: 1;"></div>
                <div style="position: absolute; bottom: -40px; right: 20px; background: var(--white); padding: 25px; border-radius: 16px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); z-index: 3; display: flex; align-items: center; gap: 15px;">
                    <div style="width: 50px; height: 50px; background: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--white);">
                        <i class="fa-solid fa-trophy" style="font-size: 20px;"></i>
                    </div>
                    <div>
                        <h5 style="margin: 0; font-size: 1rem; color: var(--dark-color);">Most Liveable City</h5>
                        <p style="margin: 0; font-size: 0.85rem; color: var(--text-muted);">Globally Recognized</p>
                    </div>
                </div>
            </div>
            
            <div class="about-content">
                <div class="section-title" style="text-align: left; margin-bottom: 30px;">
                    <span style="color: var(--secondary-color);">INVESTMENT OPPORTUNITY</span>
                    <h2 style="font-size: 2.8rem; line-height: 1.2; color: var(--primary-color-dark);">The Strategic Choice: Investing in Victoria</h2>
                </div>
                <div class="investment-text">
                    <p style="font-size: 1.2rem; line-height: 1.8; color: var(--text-color); margin-bottom: 25px; font-weight: 400;">
                        Victoria continues to offer some of the <strong>best value house and land packages</strong> in Australia. </p> <p>Melbourne, the capital city of Victoria, has consistently been recognised as one of the world’s most liveable and multicultural cities.
                    </p>
                    <p style="font-size: 1.1rem; line-height: 1.7; color: var(--text-muted); margin-bottom: 35px;">
                        With millions of people from diverse communities calling Melbourne home, purchasing or investing here provides an excellent opportunity to secure a strong future at competitive prices.
                    </p>
                </div>
                
                <div class="feature-pills" style="display: flex; flex-wrap: wrap; gap: 15px;font-size: 14px; font-weight:bold">
                    <div class="pill">
                        <i class="fa-solid fa-earth-americas" style="color:var(--primary-color)"></i>
                        Multicultural Hub
                    </div>
                    <div class="pill">
                        <i class="fa-solid fa-chart-line" style="color:var(--primary-color)"></i>
                        Strong Capital Growth
                    </div>
                    <div class="pill">
                        <i class="fa-solid fa-people-roof" style="color:var(--primary-color)"></i>
                        High Rental Demand
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
#invest-victoria .pill {
    background: var(--white);
    padding: 12px 24px;
    border-radius: 50px;
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--primary-color-dark);
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    border: 1px solid rgba(var(--primary-color-rgb), 0.1);
    transition: all 0.3s ease;
}
#invest-victoria .pill:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(var(--secondary-color-rgb), 0.15);
    border-color: var(--secondary-color);
}
#invest-victoria .pill i {
    color: var(--secondary-color);
}
@media (max-width: 992px) {
    #invest-victoria .about-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
}
</style>
@endpush
