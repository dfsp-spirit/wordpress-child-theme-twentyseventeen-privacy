# wordpress-child-theme-twentyseventeen-textfooter
A privacy-aware wordpress child theme for the twenty seventeen theme. This gives visitors of your site better privacy.

## Features

* Restyles the social menu on the bottom to have text links instead of icon links. This is useful especially in Germany if you want to put some of the legally required links in there, which have to carry certain names ("Impressum/imprint" and "Datenschutz/privacy").
* Disables HTTP referer [sic] so it is not tracked where people are coming from
* Loads the fonts locally instead of using Google Fonts remotely (so Google cannot track them)  
* Disables saving of IP addresses of people who comment. This is not needed and IP addresses are personal data, so storing them is questionable at least.
* Remove emticons. The graphic that gets inserted when you have them on and type something like ":)" in a post are retrieved from a remote server(!) it seems. Ridiculous.


## Preview

From a visual perspective, there is almost no change. This only changed privacy settings under the hood.

Have a look at the following image if you want a preview of this style. In this example, I have added 3 text links (titled `Kontakt`, `Datenschutz`, and `Impressum`) to the footer menu.

![Theme preview](https://github.com/dfsp-spirit/wordpress-child-theme-twentyseventeen-textfooter/blob/master/preview_twentyseven_child_theme_text_footer_menu.jpg)


## Installation

0) - Make a full backup of your site.  
   - Make sure you copy/backup any custom CSS you have added to the Twentyseventeen theme, you may want to apply that to the child theme as well.

1) On your server, copy the directories `twentyseventeen-child/` and `fonts/` from this repo to `<your-wordpress-dir>/wp-content/themes/`. Make sure the directory and all its contents have proper access rights so your web server can read the files.

    - Check: as a result, you should now have the following file: `<your-wordpress-dir>/wp-content/themes/twentyseventeen-child/style.css` (and some more in the same location).

2) Activate the child theme in the Wordpress Admin panel (see `Appearance => Themes`).

3) You may have to re-save your menus and theme options (including background and header images) in the Wordpress Admin panel (see `Appearance => Menus`). To make it clear: The images are not lost on the server, but you need to go there again, select them and hit save.

## License, Source and Author

License is GPL v2 or later (no warranties!), the repo is at https://github.com/dfsp-spirit/wordpress-child-theme-twentyseventeen-textfooter

Written by Tim. For contact info, see http://rcmd.org/contact/
