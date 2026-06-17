=== Silver Liquid Dev ===

Contributors: pierrejochem
Requires at least: 6.0
Tested up to: 6.5
Requires PHP: 7.4
Stable tag: 1.1.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: blog, portfolio, two-columns, custom-menu, custom-logo, featured-images, translation-ready, full-width-template, block-styles, dark-mode

A modern developer blog and portfolio theme with a brushed-silver, liquid-glass aesthetic.

== Description ==

Silver Liquid Dev is a minimal theme for a developer's blog and portfolio. It pairs a brushed-silver,
liquid-glass surface treatment (frosted translucent cards, iridescent accents) with a
terminal-inspired hero, editor-style code blocks with one-click copy buttons, and typography
tuned for technical writing. Light and dark modes follow the operating system by default and
can be toggled in the header; the choice is remembered.

Features:

* Light & dark mode (system-aware, with header toggle)
* Liquid-glass surfaces with a reduced-transparency fallback
* Terminal-style front-page hero, topics row, and latest posts
* Sticky sidebar on blog/archive/search listings
* Dark code blocks with copy-to-clipboard buttons
* Custom logo, custom background, primary and footer menus
* Responsive, keyboard-accessible, and respects prefers-reduced-motion

== Installation ==

1. In your WordPress admin, go to Appearance > Themes > Add New > Upload Theme.
2. Choose silver-liquid-dev.zip and click Install Now, then Activate.
3. Go to Appearance > Menus, create a menu and assign it to the Primary Menu location.
4. Optional: Settings > Reading to set a static front page. The front-page template works
   either way.

== Frequently Asked Questions ==

= How do I change the social links in the hero and footer? =

Edit the silver_liquid_dev_social_links() function near the top of functions.php, or use the
silver_liquid_dev_social_links filter to add or change links.

= How do I change the accent color or fonts? =

Edit the CSS custom properties at the top of style.css (for example --accent and the
--font-* variables).

= Does the theme require any plugins? =

No. The theme has no required or bundled plugins.

== Changelog ==

= 1.1.0 =
* New brushed-silver, liquid-glass visual design (frosted surfaces, iridescent accents).
* Added a reduced-transparency fallback for browsers without backdrop-filter.
* Updated screenshot.

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 1.1.0 =
Refreshed visual design (silver / liquid glass). No breaking changes.

== Resources ==

Fonts are served from Google Fonts (https://fonts.google.com/) and are not bundled in the theme.

* Space Grotesk — Copyright Florian Karsten, SIL Open Font License 1.1, https://fonts.google.com/specimen/Space+Grotesk
* IBM Plex Sans — Copyright IBM Corp., SIL Open Font License 1.1, https://fonts.google.com/specimen/IBM+Plex+Sans
* JetBrains Mono — Copyright JetBrains s.r.o., SIL Open Font License 1.1, https://fonts.google.com/specimen/JetBrains+Mono

SIL Open Font License 1.1: https://opensource.org/licenses/OFL-1.1

All icons are original inline SVG created for this theme (GPLv2 or later).
screenshot.png is an original screenshot of the theme, created by the theme author (GPLv2 or later).

== Copyright ==

Silver Liquid Dev WordPress Theme, (C) 2026 Pierre Jochem.
Silver Liquid Dev is distributed under the terms of the GNU GPL version 2 or later.

This program is free software: you can redistribute it and/or modify it under the terms of
the GNU General Public License as published by the Free Software Foundation, either version 2
of the License, or (at your option) any later version.
