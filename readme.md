# Nomadic

Nomadic is an open source system to let you gather information with your community.

You can collect information,  write reviews, leave comments, and add tags on certain topics.

Currently support list mode, map mode. Features include reviewing/editing/commenting/check-ins/tagging.

*Read this in other languages: [English](readme.md), [中文](readme.zh-tw.md).*

## Examples

### [Cafe Nomad - 2,200+ best cafes to work in Taiwan](https://cafenomad.tw/en)

Cafe Nomad is a platform gathering information for 2,000+ coffee shops in Taiwan.

Users can find and contribute coffee shop information on Cafe Nomad.

![Info Page](/images/screenshot-cafenomad.png?raw=true "Cafe Nomad")

## Installation

Install Nomadic with composer in the terminal

```
composer create-project howtomakeaturn/nomdic
```

## Core Configuration

* config/review-fields.php：Fields for reviewing

* config/info-fields.php：Fields for editing. Support string/radio buttons/select menu

* config/nomadic.php：Other configuration

## How to enable the map mode

1. Set 'map-enabled' as true in 'config/nomadic.php'
2. Go to [Google Cloud Platform](https://console.cloud.google.com) and generate a key, and then enable Google Maps JavaScript API and Google Maps Geocoding API
3. Fill in google.key value in 'config/services.php'

## Notice

Nomadic is developed under Laravel 5.3 and MySQL 5.5.

Currently only support user login with Facebook. You need to register a web app in Facebook developer platform and set up the client id/secret in .env file.

Setup the cronjob for Laravel Task Scheduling,

```
* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
```

## Screenshots

Nomadic Homepage

![Homepage](/images/screenshot-homepage.png?raw=true "Homepage")

Nomadic List Page

![List](/images/screenshot-list.png?raw=true "List")

Nomadic Map Page

![Map](/images/screenshot-map.png?raw=true "Map")

Nomadic Entity Info Page

![Info Page](/images/screenshot-entity-page.png?raw=true "Entity")

## Development Status

1. Nomadic is currenly under beta phase. The system might not be stable and has many issues.

2. The source code is extracted from another project 'Cafe Nomad', so some redundant code and weird naming exist in the codebase. Will refactor them in the following releases.

## License

Licensed under the GNU General Public License Version 2.0 or later.
