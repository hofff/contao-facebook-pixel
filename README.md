[![Latest Version on Packagist](http://img.shields.io/packagist/v/hofff/contao-facebook-pixel.svg?style=flat)](https://packagist.org/packages/hofff/contao-facebook-pixel)
[![Installations via composer per month](http://img.shields.io/packagist/dm/hofff/contao-facebook-pixel.svg?style=flat)](https://packagist.org/packages/hofff/contao-facebook-pixel)
[![Installations via composer total](http://img.shields.io/packagist/dt/hofff/contao-facebook-pixel.svg?style=flat)](https://packagist.org/packages/hofff/contao-facebook-pixel)
# Contao Extension: hofff.com - Facebook Pixel Plugin

contao-facebook-pixel is a Contao extension to integrate the Facebook Tracking Pixel.

### settings
Set facebook pixel id in root page under facebook pixel settings
and activate checkbox. The facebook pixel code will be automatically add to template in head section.

for opt out link
- use content element or
- use module or
- use insert tag {{fbPixel::privacyLink}}

set insert tag text like
{{fbPixel::privacyLink|Hier Cookie setzen Text einfügen|Hier Cookie löschen Text einfügen}}

## Compatibility

- min. Contao version: >= 3.5.0
- max. Contao version: 4.4.x


## Dependency

There are no dependencies to other extensions, that have to be installed.


## Screenshots

![Back end configuration](screenshot-backend.png)
![Back end configuration](screenshot-frontend.png)
