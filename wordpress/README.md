# Williams Excavations: putting the redesign on the live site

This folder holds the WordPress implementation of the redesign that lives as a
standalone page in the repository root (`/index.html`).

## Requirements

| Requirement | Why |
|---|---|
| **ACF Pro** | The layout is repeater driven (services, posters, stats, steps, projects, reviews, FAQs) and the header and footer read from an options page. Repeaters and options pages are Pro only features. |
| **Contact Form 7** | Both quote forms and the inner page banner form render a CF7 form. |
| Twenty Seventeen + the existing child theme | The files below drop into `twenty-seventeen-child-theme`. |

## The approach

**Header and footer are theme files, not widgets.** `header.php` and
`footer.php` are replaced outright, so every page on the site gets the new
design with no per page work. The menu still comes from the existing `top`
menu location, so it stays editable under Appearance > Menus.

**The homepage is an assignable page template.** `Homepage Redesign` appears in
Page Attributes > Template. All of its content comes from ACF, so the page
needs no page builder rows.

**Fields are registered in PHP, not the database.** `inc/acf-fields.php` calls
`acf_add_local_field_group()`. The fields ship with the theme, deploy with git,
cannot be deleted by accident in wp-admin, and need no JSON sync step between
staging and production.

**The seeder runs itself, once.** `inc/seeder.php` hooks `admin_init`, writes
the packaged content into ACF, and records a version in an option so it never
repeats. There is no settings screen and no page to create.

**Everything is namespaced `we-`.** Every class, id, custom property and
keyframe carries the prefix. Dropping generic names like `.btn`, `.container`,
`.section` or `.site-header` onto a site running WPBakery, Contact Form 7 and
Owl Carousel would collide badly. A small block of defensive resets at the end
of the stylesheet also neutralises the bare `p {}`, `h2 {}` and `::placeholder {}`
rules already in the child `style.css`.

## Install

1. **Back up** the site and the database.
2. Copy the contents of `twenty-seventeen-child-theme/` into
   `wp-content/themes/twenty-seventeen-child-theme/`, keeping the existing
   `style.css` and `breadcrumbs.php`. `functions.php`, `header.php` and
   `footer.php` are replacements: keep copies of the originals.
3. Activate **ACF Pro** and **Contact Form 7**.
4. Create or open the page you want as the homepage, set
   **Page Attributes > Template** to **Homepage Redesign**, and publish.
5. Load any wp-admin screen. The seeder fills in the content and shows a notice
   saying how many fields it wrote.
6. Set **Settings > Reading** to use that page as the static front page.
7. In **Site Design** (new admin menu item), pick the CF7 form for the hero, the
   contact block and the inner page banner.

## Contact Form 7

Create one form and reuse it. This markup matches the design grid:

```html
<div class="we-form-grid">
  <p class="we-field"><label>Name <span class="we-req">*</span></label>
    [text* your-name placeholder "Your full name"]</p>
  <p class="we-field"><label>Phone <span class="we-req">*</span></label>
    [tel* your-phone placeholder "04XX XXX XXX"]</p>
  <p class="we-field we-field--full"><label>Email <span class="we-req">*</span></label>
    [email* your-email placeholder "you@email.com.au"]</p>
  <p class="we-field we-field--full"><label>Service needed</label>
    [select your-service "Select a service" "Excavation" "Earthmoving" "Civil Works" "Driveways" "Demolition" "Retaining Walls" "Land Clearing" "Other"]</p>
  <p class="we-field we-field--full"><label>Job details</label>
    [textarea your-message placeholder "Site location, scope and preferred start date"]</p>
  <p class="we-field we-field--full">[submit "Send My Request"]</p>
</div>
```

## Editing later

- **Homepage content**: edit the page, use the tabs in the Homepage Redesign box.
- **Header, footer, inner banner**: **Site Design** in the admin menu.
- **Menu**: Appearance > Menus, `top` location, two levels deep.
- **Inner page banner image**: set a featured image on the page to override the
  site wide default.

Leaving a field empty falls back to the packaged default in
`inc/defaults.php`, so the page never renders blank.

## Re-running the seeder

Bump `WE_SEED_VERSION` in `inc/seeder.php`, or append `&we_reseed=1` to an admin
url with a valid nonce. `we_reseed=force` overwrites values that already exist.
By default the seeder never overwrites a field an editor has filled in, so
re-running after adding new fields is safe.

## Files

```
twenty-seventeen-child-theme/
├── functions.php                     replaced: enqueues, includes, existing sidebars kept
├── header.php                        replaced: global header, drawer, inner banner hook
├── footer.php                        replaced: global footer, floating buttons
├── page-templates/
│   └── template-homepage.php         the assignable template
├── inc/
│   ├── defaults.php                  packaged content, single source of truth
│   ├── helpers.php                   field getters with fallbacks, CF7 renderer
│   ├── nav-walkers.php               desktop and drawer menu walkers
│   ├── acf-fields.php                field groups and the options page
│   └── seeder.php                    the one time seeder
├── template-parts/
│   ├── home/section-*.php            one file per homepage section
│   └── global/inner-banner.php       inner page banner with the quote form
└── assets/
    ├── css/we-redesign.css
    └── js/we-redesign.js
```

## Notes and caveats

- **`page.php` is deliberately not overridden.** Inner page content keeps
  rendering through Twenty Seventeen's own template, so existing WPBakery rows
  are untouched. The new header and footer wrap around them.
- **The old header widgets are now unused.** `Menu Top Number` and
  `Header Phone Number` are still registered so nothing fatals, but the new
  header reads from the Site Design options instead. Remove the widgets once
  you are happy with the result.
- **Font Awesome** is enqueued from cdnjs 6.5.2. If the Font Awesome 5 Pro kit
  the old header loaded is still licensed, swap the url in `we_enqueue_icons()`.
- **Test on staging first.** Replacing `header.php` and `footer.php` changes
  every page on the site.
