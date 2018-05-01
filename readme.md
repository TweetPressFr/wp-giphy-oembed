# WP Giphy Oembed #

Easy embed of giphy.com gifs

## Description ##

Just copy paste URL and that's it !
For example http://giphy.com/gifs/pitchperfect-movie-pitch-perfect-pitchperfect2-MVDPX3gaKFPuo in WP visual editor and it will do the job.

## Features ##

* support for Gutenberg
* html5 video

## Install

This plugin is available on wordpress.org if you just want to enjoy it without having any command lines to run : https://wordpress.org/plugins/wp-giphy-oembed/

## Contribute ##

Clone this repository to the wp-content/plugins folder of your WordPress installation and run the following commands to make it work:

`npm install && npm run build`

## Changelog ##

### 0.5
* May 2018
* Use i18n API
* refactor
* Handle error 404 "manually" as JavaScript fetch() is not considering it as error
* Inspired by https://github.com/youknowriad/dropit
* TODO: use components, use modules

### 0.4.1
* 17 Jan 2018
* fix edge cases

### 0.4
* 14 Jan 2018
* add gutenberg embed \o/
* switch to html5 support cause I don't like iframes
* html5 is faster here

### 0.3
* 24 June 2017
* add some attributes HTML
* add arg HTML5
* add filters for width and height

### 0.2
* 25 June 2016
* initial

