#!/bin/bash

/usr/local/php/bin/php /www/book/leon/app/Http/Shell/RedisSyncMysql.php >> /www/book/leon/app/Http/Shell/queue.log &
