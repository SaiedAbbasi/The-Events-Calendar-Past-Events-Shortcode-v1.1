**The Events Calendar Past Events Shortcode**

[![DOI](https://zenodo.org/badge/19480/colundrum/The-Events-Calendar-Past-Events-Shortcode.svg)](https://zenodo.org/badge/latestdoi/19480/colundrum/The-Events-Calendar-Past-Events-Shortcode)

Contributors:  COLUNDRUM
Tags: event, events, calendar, shortcode, past, modern tribe
Requires at least: 3.0
Tested up to: 4.1
Stable tag: master
Version: 1.0.0
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds shortcode functionality to The Events Calendar Plugin (Free Version) by Modern Tribe.

#Description

This plugin adds a shortcode for use with The Events Calendar Plugin (by Modern Tribe).

The shortcode displays lists of your events.  You can control the event display with the shortcode options.
Example shortcode to show next 8 events in the category festival in ASC order with date showing [ecspe-list-events cat='festival' limit='8']

#Shortcode Options:

* Basic shortcode: [ecspe-list-events]
* cat - Represents event category. [ecspe-list-events cat='festival']
* limit - Total number of events to show. Default is 5. [ecspe-list-events limit='3']
* order - Order of the events to be shown. Value can be 'ASC' or 'DESC'. Default is 'ASC'. Order is based on event date. [ecspe-list-events order='DESC']
* date - To show or hide date. Value can be 'true' or 'false'. Default is true. [ecspe-list-events eventdetails='false']
* venue - To show or hide the venue. Value can be 'true' or 'false'. Default is false. [ecspe-list-events venue='true']
* excerpt - To show or hide the excerpt and set excerpt length. Default is false. [ecspe-list-events excerpt='true'] //displays excerpt with length 100
 excerpt='300' //displays excerpt with length 300
 * thumb - To show or hide thumbnail image. Default is false. [ecspe-list-events thumb='true'] //displays post thumbnail in default thumbnail dimension from media settings.
 * You can use 2 other attributes: thumbwidth and thumbheight to customize the thumbnail size [ecspe-list-events thumb='true' thumbwidth='150' thumbheight='150']
 * message - Message to show when there are no events. Defaults to 'There are no upcoming events at this time.'
 * viewall - Determines whether to show 'View all events' or not. Values can be 'true' or 'false'. Default to 'true' [ecspe-list-events cat='festival' limit='3' order='DESC' viewall='false']


##Frequently Asked Questions

###What are the shortcode Options:

**Shortcode Options:**

* Basic shortcode: [ecspe-list-events]
* cat - Represents event category. [ecspe-list-events cat='festival']
* limit - Total number of events to show. Default is 5. [ecspe-list-events limit='3']
* order - Order of the events to be shown. Value can be 'ASC' or 'DESC'. Default is 'ASC'. Order is based on event date. [ecspe-list-events order='DESC']
* date - To show or hide date. Value can be 'true' or 'false'. Default is true. [ecspe-list-events eventdetails='false']
* venue - To show or hide the venue. Value can be 'true' or 'false'. Default is false. [ecspe-list-events venue='true']
* excerpt - To show or hide the excerpt and set excerpt length. Default is false. [ecspe-list-events excerpt='true'] //displays excerpt with length 100
 excerpt='300' //displays excerpt with length 300
 * thumb - To show or hide thumbnail image. Default is false. [ecspe-list-events thumb='true'] //displays post thumbnail in default thumbnail dimension from media settings.
 * You can use 2 other attributes: thumbwidth and thumbheight to customize the thumbnail size [ecspe-list-events thumb='true' thumbwidth='150' thumbheight='150']
 * message - Message to show when there are no events. Defaults to 'There are no upcoming events at this time.'
 * viewall - Determines whether to show 'View all events' or not. Values can be 'true' or 'false'. Default to 'true' [ecspe-list-events cat='festival' limit='3' order='DESC' viewall='false']

###How do I use this shortcode in a widget?

* You can put the shortcode in a text widget.
* Not all themes support use of a shortcode in a widget. If a regular text widget doesn't work, put the shortcode in a <a href="https://wordpress.org/plugins/black-studio-tinymce-widget/">Visual Editor Widget</a>.

###What are the classes for styling the list of events?

The plugin does not include styling. Events are listed in ul li tags with appropriate classes for styling.

* ul class="ecspe-event-list"
* li class="ecspe-event"
* event title link is H4 class="entry-title summary"
* date class is time
* venue class is venue
* span .ecspe-all-events
* p .ecspe-excerpt

###How do I include a list of events in a page template?

include echo do_shortcode("[ecspe-list-events]"); in the template where you want the events list to display.

##Upgrade Notice

###1

* Initial Release

##Changelog

###1

* Initial release
