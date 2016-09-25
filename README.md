Solved
======


#### Requirements

To run this application on your machine, you need at least:

* >= PHP 5.5
* >= Phalcon 3.0
* Apache Web Server with `mod_rewrite enabled`, and `AllowOverride Options` (or `All`) in your `httpd.conf` or or Nginx Web Server
* Latest Phalcon Framework extension installed/enabled
* MySQL >= 5.1.5

Then you'll need to create the database and initialize schema:

    echo 'CREATE DATABASE solved' | mysql -u root
    cat schemas/solved.sql | mysql -u root solved

Installing Dependencies via Composer
------------------------------------
Solved's dependencies must be installed using Composer. Install composer in a common location or in your project:

```bash
curl -s http://getcomposer.org/installer | php
```

Run the composer installer:

```bash
cd solved
php composer.phar install
```

License
-------
Solved is open-sourced software licensed under the New BSD License.
