DocVer: 0.1


Prerequisites:
* A site (normally the creationg of the site is done by the site mgr Tord), the steps for this part of the setup are listed in [this](setting-up-a-new-site.md) document


Please note:
* The steps below describe the installation process *for the plugin but not the whole setup process* (which includes creating pages and adding shortcodes etc), for setup please see [this document](setting-up-a-new-site.md)
* For developers the standard way of updating is to use an FTP connection and upload the files directly this way

1. Download [the latest version](https://github.com/EmpathyApp/EmpathyApp/archive/master.zip) directly
  * (Alternatively: You can find the same file by going to the [code section](https://github.com/EmpathyApp/EmpathyApp) on github and clicking the button "Download ZIP")
2. Log in as admin on your wp site
3. *If upgrading:* Go to Plugins -> All plugins
  1. Deactivate the Empathy App plugin
  2. Delete the plugin
4. Go to Plugins -> Add new -> Upload plugin -> Browse
5. Find the file you downloaded in the first step above and upload this file
6. When the install process is complete choose "Activate the plugin"

The plugin has settings but they have default values that don't need to be changed (unless you are installing on the actual procuction site where you will need to change the stripe keys)



#### Appendix A: Uninstalling the plugin

TODO

Simple version: Disable the plugin and remove all the files

Removing the files will not remove db tables

