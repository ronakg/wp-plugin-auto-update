Auto Update script for WP Plugins not hosted on WordPress.org
=============================================================

This script can be used for WordPress plugins that are not hosted on
WordPress.org. It works transparently for users providing same experience as if
the plugin was hosted on WordPress.org.

Features
--------

* Serve multiple plugins using same script
* Serve different types of versions like stable, alpha, beta, lite, pro, test
  etc.
* Easy to configure ini file

How to use this script
----------------------

* Copy contents of this project (excluding ``test-plugin/``) to a location on
  your website
* Rename ``test-plugin.ini`` to ``your-plugin-slug.ini``
* Modify ``your-plugin-slug.ini`` file according the help instructions in the
  file
* Modify ``test-plugin/test-plugin.php`` file to reflect the location of
  ``index.php`` on your website
* Copy contents of ``test-plugin/test-plugin.php`` file to your plugin's main
  file

Credits
-------

* `Kaspars <http://konstruktors.com/blog/wordpress/2538-automatic-updates-for-plugins-and-themes-hosted-outside-wordpress-extend/#comment-2550>`_, for original idea of this script
* `michelf <http://michelf.com/projects/php-markdown/>`_, for the markdown
  script
