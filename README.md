# Time Remaining

Time Remaining is a WordPress plugin which displays a programmable countdown timer in the user administrative toolbar. This can be useful for transient site provisioners or other temporary theme and plugin preview environments.

![Time Remaining](https://cldup.com/Yqlmzmj9Iz.png)

## Installation

Download and extract the [zip archive](https://github.com/aduth/g-debugger/archive/master.zip) to a `time-remaining` folder in your WordPress installation `wp-content/plugins`.

Alternatively, as a single-file plugin, it can be downloaded directly and placed within the [`mu-plugins` directory](https://codex.wordpress.org/Must_Use_Plugins) of a site.

```
mkdir -p wp-content/mu-plugins && curl https://raw.githubusercontent.com/aduth/wp-time-remaining/master/index.php > wp-content/mu-plugins/time-remaining.php
```

## Usage

Time Remaining is configured using either an environment variable or site option. In either case, the value should be the [unix time](https://en.wikipedia.org/wiki/Unix_time) in seconds of the expiration.

As an environment variable, export the value as the `TIME_REMAINING_END` variable.

As a site option, set the value as the `time-remaining-end` site option.

## License

Copyright 2019 Andrew Duthie

Released under the [GPLv2 or later License](https://www.gnu.org/licenses/gpl-2.0.html).
