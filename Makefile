# Makefile
init: #собираем композер
	composer install
	php vendor/bin/phinx init
	mk dir db/migrations
	mk dir db/seeds
start: #запускаем сервер
	@cd public; \
	php -S localhost:8000
dump: #обновление автозагрузки
	composer dumpautoload
phinx: #вызов команды пакета phinx
	php vendor/bin/phinx






