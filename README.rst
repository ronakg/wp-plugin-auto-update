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

* Upload ``index.php`` file to your website
* Copy ``test-plugin.ini`` to the same location and rename it to
  ``your-plugin-slug.ini``
* Modify ``your-plugin-slug.ini`` file according the help instructions in the
  file
* Modify ``test-plugin/test-plugin.php`` file to reflect the location of
  ``index.php`` on your website
* Copy contents of ``test-plugin/test-plugin.php`` file to your plugin's main
  file
