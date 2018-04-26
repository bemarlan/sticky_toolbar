Sticky Toolbar

INTRODUCTION
------------

The Sticky Toolbar module allows users to toggle whether their toolbar is sticky, providing more customization to core's toolbar functionality.

REQUIREMENTS
------------

This module requires the following core modules to be enabled:

* Toolbar (https://www.drupal.org/docs/8/core/modules/toolbar)

RECOMMENDED MODULES
-------------------
This module has no recommended modules.

INSTALLATION
------------
 
 * Install as you would normally install a contributed Drupal module. Visit:
  https://drupal.org/documentation/install/modules-themes/modules-8 for further information.

 * You will need to ensure the Toolbar module is enabled, as this module conditionally overrides its functionality.

CONFIGURATION
-------------
 
 * Configure user permissions in Administration » People » Permissions:

   - Use Sticky Toolbar

    Users in roles with the "Use Sticky Toolbar" permission will have access see the configuration page, allowing them to toggle their setting.

 * Toggle the menu setting in Configuration » User interface » Sticky Toolbar settings

TROUBLESHOOTING
---------------

 * If the toolbar does not toggle its sticky after adjusting settings, perform the following:

   - Clear Drupal cache
   - Clear browser cache

MAINTAINERS
-----------

Current maintainers:
 * Beverly Lanning (bemarlan) - https://www.drupal.org/user/3513747/message-follow
