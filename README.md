### This Craft 2.x plugin is no longer maintained. You are free to use it in your Craft2.x projects but no further development will take place and not support is offered.

[![No Maintenance Intended](http://unmaintained.tech/badge.svg)](http://unmaintained.tech/)

# S3 Secure Downloads plugin for Craft CMS

This plugin will return a [signed URL](http://docs.aws.amazon.com/AmazonS3/latest/dev/ShareObjectPreSignedURL.html) used to allow temporary access to private objects with an expiring URL. You can optionally allow file downloads only for logged in users and force file downloads (useful for PDF files). This plugin was originally developed for a client in the financial services industry who wanted to make sure only logged in users had access to downloads of financial reports, and download links couldn't be shared.

Craft introduced the ability to have private S3 assets in [2.6.2771](https://craftcms.com/changelog#build2771). Now you can keep your S3 objects private but grant temporary access to them with an expiring link. 

![Alt text](resources/screenshots/screenshot.png?raw=true "Screenshot")

## Installation

To install S3 Secure Downloads, follow these steps:

1. Download & unzip the file and place the `s3securedownloads` directory into your `craft/plugins` directory
2.  -OR- do a `git clone git@github.com:jonathanmelville/s3securedownloads.git` directly into your `craft/plugins` folder.  You can then update it with `git pull`
3. Install plugin in the Craft Control Panel under Settings > Plugins
4. The plugin folder should be named `s3securedownloads` for Craft to see it.  GitHub recently started appending `-master` (the branch name) to the name of the folder for zip file downloads.

S3 Secure Downloads works on Craft 2.5.x.

## Usage

Pass in an asset's entry id and it will return a signed URL for that asset:

`<a href="{{ getSignedUrl(entry.myAssetField[0].id) }}">{{ entry.myAssetField[0].title }}</a>`

## S3 Secure Downloads Changelog

### 1.0.0 -- 2016.02.25

* Initial release

Brought to you by [Jonathan Melville](http://jonathanmelville.com)
