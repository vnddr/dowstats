Dawn of War Statistics webapp
============================

Simple app with multiple ladders, replay storage and player stats.




REQUIREMENTS
------------

The minimum requirement by this project that your Web server supports PHP 5.4.0.


INSTALLATION
------------


If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project template using the following command:

~~~
php composer.phar global require "fxp/composer-asset-plugin:^1.2.0"
php composer.phar install
~~~



CONFIGURATION
-------------

### Database

Database settings and other personal data are stored in .env file. Copy the .env.template file, rename it in .env and fill in your database settings


API
-------------
### Запрос на добавление реплея:
GET `/connect`

#### Параметры запроса:

`p1`, `p2`,.. `p8` - ???? [string]

```apm``` - показатель APM отправившего реплей игрока. [float]

`r1`, `r2`... - ?

`w1`, `w2`... - ?

`type` - ?

`map` - название карты. [string]

`gtime` - длительность игры в секундах. [int]

`sid` - Steam ID отправителя реплея. [numeric string]

`mod` - ? [string]

`winby` - режим игры [string enum]

`key` - ? [string]
