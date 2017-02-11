#!/bin/bash

redis/redis-server & node nodejs/socket.js localhost & php artisan serve