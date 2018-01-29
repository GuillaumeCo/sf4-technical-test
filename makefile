version = 1

start:
	docker-compose up -d

stop:
	docker-compose down

clear:
	docker exec -it sf4-technical-test /usr/local/bin/php bin/console cache:clear --env=prod

bash:
	docker exec -it -u www-data sf4-technical-test /bin/bash

bash-root:
	docker exec -it sf4-technical-test /bin/bash

install:
	docker/init.sh $(version)