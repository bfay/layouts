Toolset Bootstrap 3
A Responsive WordPress Theme for Modular Layouts
======================================================

Thank you for using Toolset Bootstrap Theme - minimalistic Bootstrap theme for responsive grid sites.

== More info ==
* Official website						»	http://wp-types.com/home/toolset-bootstrap/
* User guides							»	http://wp-types.com/documentation/user-guides/

== Author ==
OnTheGoSystems							»	http://www.onthegosystems.com/

== License ==
GNU General Public License v2 or later	»	http://www.gnu.org/licenses/gpl-2.0.html

== Credits ==
* Twitter Bootstrap framework			»	http://twitter.github.com/bootstrap/
* HTML5 Boilerplate template			»	http://html5boilerplate.com/
* The Roots theme						»	http://www.rootstheme.com/
* The Bootstrap theme					»	http://wordpress.org/extend/themes/the-bootstrap
* rbootstrap							»	http://rbootstrap.ir/


== Description ==

The Toolset Bootstrap theme lets you build modular and responsive WordPress sites.
* Create elegant layouts with the Bootstrap 3 grid system
* Fluid, fixed-width and responsive layouts
* Drop-in powerful modules with advanced functionality

Toolset Bootstrap lets you concentrate on design and functionality. A convenient grid-system, simple and clean CSS and a variety of theme options will let you build sites, instead of debugging code. The best thing about working with a grid system is that it’s simple to design unique layouts. Place elements in columns and the theme handles everything for you.
With one click you can enable responsive mode and columns will automatically resize and shift to fit into the browser size automatically. Your site will adjust to display right on full-width PC monitors, tablets and phones.


== Main features ==

Multi-lingual
-------------
Toolset Bootstrap support for translation

Page templates
--------------
* basic full-width page template,
* template support for Layouts plugin.

Theme customization
-------------------
Basic theme settings:
* site title,
* colors and background image,
* menu and front page selection.

Theme options panel
-------------------
Control the page and choose which sections are displayed
* navigation menu style, position and features,
* comments, post meta data, post thumbnails,
* titles for posts, pages, archives and more.

Theme support for:
------------------
* post formats: aside, image, link, quote, status, chat, gallery, video,
* widgetized area,
* custom editor style,
* RSS feed links,
* Bootstrap navbar, pager,
* custom gallery in a grid layout,

Layouts support
---------------
* built-in example cell types for easy drag and drop composition,
* reference cell - well documented template of custom cell type for developers use,
* layouts import/export feature - reuse or share your designs,
* predefined, ready to use layouts examples you can adapt to your needs


== Directory structure ==

THEME_DIR/header-layouts.php - The template for displaying the header (loaded by page-layouts.php).
THEME_DIR/page-layouts.php   - Layouts page template (Loads header-layouts.php and footer-layouts.php files) and executes the_ddlayout() function instead of WordPress the_content() function.
THEME_DIR/footer-layouts.php - The template for displaying the footer (loaded by page-layouts.php).

THEME_DIR/embedded-layouts/  - This directory contains plugin core files. It's an embeded version of Layouts plugin.
THEME_DIR/dd-layouts-cells/  - This directory contains custom cells' types built for Toolse Bootstrap theme.

	THEME_DIR/dd-layouts-cells/ayouts-site-title-cell.class.php - It's a custom cell to tisplay the header of the site.
	THEME_DIR/dd-layouts-cells/layouts-nav-bar-cell.class.php   - It's a custom cell to display the main navbar.
	THEME_DIR/dd-layouts-cells/layouts-footer-cell.class.php    - It's a cutsom cell to display the footer of the site.
	THEME_DIR/dd-layouts-cells/layouts-footer-cell.class.php    - It's a cutsom cell to display the gallery cell type (Uses Twitter Bootstrap thumbnail component).

	THEME_DIR/dd-layouts-cells/reference-cell/ - This directory contains a a sample cell type to show how a cell can be created using the API.I. If you want to build a custom cell this is what you're looking for! It contains following files:

		THEME_DIR/dd-layouts-cells/reference-cell/reference-cell.php - Main file which registers.
		THEME_DIR/dd-layouts-cells/reference-cell/reference-cell.js  - JS file - for custom JS code.
		THEME_DIR/dd-layouts-cells/reference-cell/reference-cell.css - CSS file - for custom CSS code.