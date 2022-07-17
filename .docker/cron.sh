#!/bin/bash

source /src/erp/project_env.sh

cd /src/erp && /usr/local/bin/php artisan schedule:run >> /src/erp/storage/logs/laravel.log 2>&1