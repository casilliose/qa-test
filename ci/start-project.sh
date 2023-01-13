#!/bin/sh

docker-compose down --remove-orphans
docker-compose -f docker-compose.yml up -d --build
cat ./mysql/databases.sql | docker exec -i mysql-myfin-test /usr/bin/mysql -u root --password=admin