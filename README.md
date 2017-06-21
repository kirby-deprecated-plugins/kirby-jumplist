# Kirby - Jumplist

#### Version 1.0.0 - 2016-04-16
- Initial Public Offering...

#### Version 1.1.0 - 2016-11-27
- Fix where submenu's could overlap
- Compatibility check with Kirby 2.4.0
- Minor visual adjustments to seperate the (sub-) menu's

#### Version 1.5.0 - 2017-01-11
- Option to hide pages with "status : invisible"
- Blueprint renamed to ".yml"

****

### What is it?

Kirby Jumplist adds a menu in the upper-right corner of Kirby's panel, allowing you to quickly jump from page to (sub-)page - thus allowing you to change, edit, copy / paste very quickly between individual pages.

More info about Kirby can be found at http://getkirby.com

##Installation##

- Download the .zip and extract it to the root of your site.
- The jumplist acts as a field, simply add it to every blueprint where you want the jumplist to show up.
- See ```\site\blueprints\jumplist_example.yml``` for the basic set-up.
- At default the list shows a maximum of 10 pages per row. You can change this number in ```\site\config\config.php```.
- At default the list shows submenu's for every page. You can change this behaviour in ```\site\config\config.php```.
- At default "invisible" pages are shown as well. You can hide them in ```\site\config\config.php```.
- **See ```\site\config\jumplist_config_example.php``` for the setup of those preferences.**

****

![Kirby - Jumplist](kirby-jumplist.gif "Kirby - Jumplist")

*Version 1.0.0*

![Kirby - Jumplist](kirby-jumplist.png "Kirby - Jumplist")

*Version 1.1.0*