#!/bin/bash

php app/console fos:user:create --super-admin admin admin admin
php app/console fos:user:promote admin ROLE_SCENARIO_VALIDATION
php app/console fos:user:promote admin ROLE_SCENARIO_LIST
php app/console fos:user:promote admin ROLE_EQUIPMENT
php app/console fos:user:promote admin ROLE_MOBILITY
