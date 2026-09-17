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

**reCAPTCHA and floating buttons**
A mock reCAPTCHA badge is included so the stacking order can be checked. The
scroll to top button sits above it. The CSS also targets the real
`.grecaptcha-badge` class, so the live badge inherits the same placement.
On phones the order from the bottom up is: call now button, reCAPTCHA badge,
scroll to top button.

**Map**
The contact map uses a keyless Google Maps embed. Swap in an API embed if the
site needs a custom pin or styling.

## Verified

- No horizontal scroll from 320px to 1920px
- No em dashes in any content
- All service and feature cards are a single clickable link
- Respects `prefers-reduced-motion`
