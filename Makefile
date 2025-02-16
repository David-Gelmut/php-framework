# Makefile
init: #Инициализация
	composer install
	php vendor/bin/phinx init
	mk dir db/migrations
	mk dir db/seeds
start: #Запускаем сервер
	@cd public; \
	php -S localhost:8000
dump: #Обновление автозагрузки
	composer dumpautoload
phinx: #Вызов списка команд пакета phinx
	php vendor/bin/phinx
migrate_dev: #Накатывание миграции для окружения development
	php vendor/bin/phinx migrate -e development
rollback_dev: #Откат миграции для окружения development
	php vendor/bin/phinx rollback -e development
create:   #Создание миграции например для таблицы users вызов команды "make create m=CreatePostTable"
	php vendor/bin/phinx create $(m)






