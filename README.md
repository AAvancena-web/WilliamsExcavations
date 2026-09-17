# Williams Excavations - Homepage Redesign

Standalone HTML prototype of the new homepage for williamsexcavations.com.au.

## Files

- `index.html` - the complete page (HTML, CSS and JS inline, no build step)

## Notes for the WordPress build

**Global header and footer**
The header and footer are marked with `GLOBAL` comments in the markup. They are
intended to move into `header.php` and `footer.php` and are duplicated here only
so the page previews on its own.

**Images**
All images currently point at the existing WordPress media library URLs
(`/wp-content/uploads/...`). Replace them as the new artwork is uploaded.

**Container widths**
- Laptop and desktop: `1440px`
- Screens `1800px` and wider: `1880px`

Both are set on `.container` in section 3 of the stylesheet.

**Forms**
The two forms (hero and contact) are front end only. They validate, show a
sending state and render a success message. Wire them to Contact Form 7 and
keep the `.hp` honeypot field.

**Floating buttons**
On phones a glowing call now button is pinned to the bottom centre and the scroll
to top button sits clear of it on the right. On desktop the scroll to top button
sits in the bottom right corner.

**CTA glow**
Every `.btn` carries a soft pulsing glow plus a light sweep across its face, to
pull attention to the calls to action. The pulse pauses and holds at full
brightness on hover, and is disabled under `prefers-reduced-motion`. Glow and
sweep colours are per variant via `--btn-glow` and `--btn-sheen`.

**Footer logo**
The logo artwork is drawn for light backgrounds, so it is placed on a white brand
plate in the dark footer. If a white on dark logo is supplied later, remove the
background and padding from `.footer-brand__logo` and the plate disappears.

**Guide and FAQ**
The guide and FAQ section sits between the quote band and the contact block.

The intro is centre aligned and full width. Only the first paragraph shows on
load, and a read more control reveals the rest, followed by two calls to action.
The panel animates on its measured height, so paragraphs can be edited freely
without touching the CSS.

The ten answers below are rendered in full, with no expand and collapse
behaviour, so every answer is visible to visitors and to search engines on page
load.

**Map**
The contact map uses a keyless Google Maps embed. Swap in an API embed if the
site needs a custom pin or styling.

## Verified

- No horizontal scroll from 320px to 1920px
- No em dashes in any content
- All service and feature cards are a single clickable link
- No reCAPTCHA
- FAQ answers are always visible, no accordion
- Respects `prefers-reduced-motion`
