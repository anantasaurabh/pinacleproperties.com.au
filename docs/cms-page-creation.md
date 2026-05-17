# How to Create a Page (CMS & Database)

This guide explains the architecture of the Pinnacle CMS and provides instructions for creating pages both via the Admin Panel and programmatically via the Database/Eloquent models.

---

## 1. Site Architecture Overview

The CMS follows a hierarchical structure to ensure modularity and ease of design:

1.  **Page**: The top-level entity (e.g., "Home", "About Us").
2.  **Hero**: A dedicated top section for each page (Image, Video, Title, Subtitle).
3.  **Sections**: Modular horizontal blocks that divide a page.
    *   Each Section has a **Layout** (Grid, Slider, List, etc.).
    *   Each Section defines **Columns Per Row**.
4.  **Blocks**: The content units inside a section (Image, Title, Text, Button).

---

## 2. Creating via the CMS (Admin Panel)

1.  **Navigate**: Go to **Content > Pages** in the sidebar.
2.  **Create Page**: Click "New Page", enter the **Title**, and a **Slug** (e.g., `services`).
3.  **Hero Section**: Fill out the Hero tab. Use the **Media Picker** to select or upload a high-quality background.
4.  **Add Sections**:
    *   Switch to the **Sections** tab.
    *   Click "Add Section".
    *   Choose a **Layout** (e.g., "Grid").
    *   Set **Columns Per Row** (e.g., 3).
5.  **Add Blocks**:
    *   Inside the Section, click "Add Block".
    *   Use the **Media Picker** to assign images.
    *   Fill in titles and content.
6.  **Save**: Click "Save" or "Create" at the bottom.

---

## 3. Creating Programmatically (Database/Eloquent)

For AI agents or automated scripts, use the following Eloquent models in the `App\Models` namespace.

### Step 1: Create the Page
```php
use App\Models\Page;

$page = Page::create([
    'title' => 'New Service Page',
    'slug' => 'new-service',
    'is_active' => true,
]);
```

### Step 2: Add a Hero (Optional)
```php
$page->hero()->create([
    'title' => 'Welcome to Our New Service',
    'subtitle' => 'Professional property advisors at your service.',
    'image' => 'media/hero-bg.jpg', // Path relative to storage/app/public
]);
```

### Step 3: Add a Section
```php
$section = $page->sections()->create([
    'title' => 'Our Expertise',
    'layout' => 'grid',
    'columns_per_row' => 3,
    'sort_order' => 1,
]);
```

### Step 4: Add Blocks to the Section
```php
$section->blocks()->create([
    'title' => 'Strategic Planning',
    'content' => 'We help you plan your future with confidence.',
    'image' => 'media/icon-planning.png',
    'sort_order' => 1,
]);
```

---

## 4. Working with Media

The CMS uses a centralized **Media Manager**. When assigning images via code:

1.  **Path**: Always use the path relative to the `public` disk (e.g., `media/filename.png`).
2.  **Asset Storage**: Never use external hotlinks (like Unsplash) in production. Proactively generate premium, high-resolution visual assets locally, copy them to `storage/app/public/media/`, and register them.
3.  **Registration**: It is best practice to first register the file in the `Media` model so it appears in the Media Library:
    ```php
    use App\Models\Media;

    Media::create([
        'title' => 'Victoria Showcase - Family Home',
        'file_path' => 'media/vic-family-home.png',
        'file_type' => 'image',
        'disk' => 'public',
    ]);
    ```

---

## 5. Drag-and-Drop Sorting Standard

To ensure that the drag-and-drop sorting in the Filament admin panel works perfectly and persists correctly to the database:

1.  **Filament Resource Configuration**:
    *   Repeaters that manage relationship records (like `sections` and `blocks`) must use the **`orderColumn('sort_order')`** method instead of (or in addition to) `reorderable('sort_order')`.
    *   This instructs Filament to automatically update and persist the records' index ordering when saving.
2.  **Blade Rendering Configuration**:
    *   Always sort the relationships dynamically in your Blade loops or controllers:
        ```php
        // Loop sections sorted by sort_order
        @foreach($page->sections->where('is_active', true)->sortBy('sort_order') as $section)
        
        // Loop blocks sorted by sort_order
        $blocks = $section->blocks->where('is_active', true)->sortBy('sort_order');
        ```

---

## 6. Advanced Custom Block Layouts (Standard)

To build premium custom sections (like the alternating state showcases) without risking layout breakages from WYSIWYG editor flattening, follow these guidelines:

1.  **Avoid HTML inside rich-text content**: Standard Filament rich text fields will flatten/strip out custom layout CSS and HTML wrappers.
2.  **Create a Named Layout**: Add the layout name to the `layout` Select list inside [app/Filament/Resources/PageResource.php](file:///file:///var/www/web/dev-mpg.altovation.in/public_html/app/Filament/Resources/PageResource.php#L137) (e.g. `'state-showcase' => 'State Showcase'`).
3.  **Develop the layout structure in Blade**: Build the HTML and CSS grids inside [resources/views/pages/show.blade.php](file:///file:///var/www/web/dev-mpg.altovation.in/public_html/resources/views/pages/show.blade.php) using safe, structured block fields:
    *   **Title** -> String title.
    *   **Content** -> Simple paragraph(s) followed by a `<ul>`/`<li>` list which Blade automatically parses into pill badges.
    *   **Image** -> Local media path for the background photo.
    *   **Icon** -> Badge icon class (e.g. `fa-solid fa-trophy`).
    *   **Button Text** -> Formatted as `Badge Title | Badge Subtitle` (e.g. `Most Liveable City | Globally Recognized`).
    *   **Button Link** -> Redirection path (e.g. `/house-and-land-packages/state/VIC`).

4.  **Numbered Steps (Process) Layout**:
    *   **Layout Name**: `'process' => 'Numbered Steps (Process)'`
    *   **Description**: Renders white, modern card structures with subtle, large absolute background step numbers (e.g. `01`, `02`, `03` based on block order), colored headers, divider lines, and custom process icons.
    *   **Fields**: Supports dynamic local image asset paths (under `public/assets/images/icons/` like `pillar-investors.png`, `matching.png`, etc.) or custom user-uploaded `storage/` icons.

---

## 7. Summary Checklist for Agents
- [ ] Create `Page` entry.
- [ ] (Optional) Add `PageHero`.
- [ ] Create `PageSection` entries with an active, sortable layout configuration.
- [ ] Add `PageBlock` entries sorted by `sort_order`.
- [ ] Verify that all repeaters use `orderColumn('sort_order')` in Filament resource configurations.
- [ ] Sort relationships using `->sortBy('sort_order')` inside Blade loop structures.
- [ ] Proactively register all local images in the `Media` model database table.
