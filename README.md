# Purge

Purge is an extension for ExpressionEngine 2 that ~~sends a purge request~~ calls a local purging script to clear the ~~Varnish~~ FastCGI cache upon entry submission/deletion. There is also an accessory option to manually send the request.

Modified to work with FastCGI cache / nginx, based on Kevin Cupp's Purge (https://github.com/kevincupp/purge.ee2_addon).

## Installation

Add the "purge" folder inside your system/expressionengine/third_party directory, and then install the extension and accessory.

## Prepare purge script

Place purge.php where it will be accessible only via localhost (not web accessible).  Recommend /usr/share/nginx/html (depending on your nginx configuration)

**IMPORTANT: Make sure $cache_path is correctly mapped to your nginx fcgi cache folder.  If this setting is wrong, you could seriously mess things up.  You have been warned.**

## Control panel 

If you click into modules > Purge you can now set URL patterns to purge when entries are saved in different channels. 

## Changelog

* **0.0.1 alpha - August 26, 2016**
	* First release

Licensed Under: MIT
