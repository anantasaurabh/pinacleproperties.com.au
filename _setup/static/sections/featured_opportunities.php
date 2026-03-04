<section class="section">
    <div class="container">
        <div class="section-title">
            <span>PREMIUM SELECTION</span>
            <h2>Featured Opportunities</h2>
            <p class="lead text-muted">Discover our curated selection of premium properties, handpicked for their exceptional quality and investment potential.</p>
        </div>
        <div class="cards-grid">
            <?php
            $cards = [
                ['price' => '$2,400,000', 'tag' => 'FOR SALE', 'title' => 'The Mansion Estate', 'location' => 'Toorak, Melbourne VIC', 'bed' => 4, 'bath' => 3, 'sqft' => '400m²', 'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=600&q=80'],
                ['price' => '$1,820,000', 'tag' => 'OFF PLAN', 'title' => 'Skyline Residences', 'location' => 'Docklands, Melbourne VIC', 'bed' => 3, 'bath' => 2, 'sqft' => '150m²', 'image' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=600&q=80'],
                ['price' => '$3,100,000', 'tag' => 'PREMIUM', 'title' => 'Heritage Court', 'location' => 'Kew, Melbourne VIC', 'bed' => 5, 'bath' => 4, 'sqft' => '550m²', 'image' => 'https://images.unsplash.com/photo-1518780664697-55e3ad937233?auto=format&fit=crop&w=600&q=80'],
                ['price' => '$4,750,000', 'tag' => 'EXCLUSIVE', 'title' => 'Ocean Point Villa', 'location' => 'Brighton, Melbourne VIC', 'bed' => 6, 'bath' => 5, 'sqft' => '720m²', 'image' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=600&q=80'],
                ['price' => '$1,150,800', 'tag' => 'INVESTMENT', 'title' => 'Parkside Flats', 'location' => 'Northcote, Melbourne VIC', 'bed' => 2, 'bath' => 1, 'sqft' => '85m²', 'image' => 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?auto=format&fit=crop&w=600&q=80'],
                ['price' => '$5,200,000', 'tag' => 'PORTFOLIO', 'title' => 'Colossal Manor', 'location' => 'Hawthorn, Melbourne VIC', 'bed' => 7, 'bath' => 6, 'sqft' => '940m²', 'image' => 'https://images.unsplash.com/photo-1723110994499-df46435aa4b3?auto=format&fit=crop&w=600&q=80'],
            ];
            foreach ($cards as $card):
            ?>
            <div class="card">
                <div class="card-img">
                    <img src="<?php echo $card['image']; ?>" alt="<?php echo $card['title']; ?>">
                    <span class="card-tag"><?php echo $card['tag']; ?></span>
                </div>
                <div class="card-content">
                    <div class="card-price"><?php echo $card['price']; ?></div>
                    <div class="card-title"><?php echo $card['title']; ?></div>
                    <div class="card-location"><?php echo $card['location']; ?></div>
                    <div class="card-features">
                        <span><i class="fa-solid fa-bed"></i> <?php echo $card['bed']; ?></span>
                        <span><i class="fa-solid fa-bath"></i> <?php echo $card['bath']; ?></span>
                        <span><i class="fa-solid fa-ruler-combined"></i> <?php echo $card['sqft']; ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div style="text-align: center; margin-top: 50px;">
            <a href="#" class="btn-outline">View All Properties</a>
        </div>
    </div>
</section>
