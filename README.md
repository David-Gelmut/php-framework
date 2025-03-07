#  Реализация патерна MVC.

## Инициализация
1. Устанавливаем Composer:

    ```
    composer install
    ```

2. Так как проект учебный запускаем на сервере php в папке public :

    ```
    php -S localhost:8000
    ```

3. Конфигурируем базу данных в config/core.php.

## Миграции
### Для работы с миграциями используется пакет  [Phinx](https://packagist.org/packages/robmorgan/phinx):

1. Команды пакета:
    ```
    php vendor/bin/phinx
    ```
   
2. Инициализация пакета.Создастся файл в корне phinx.php.В нём необходимо внести изменения для конфигурации базы данныых:
    ```
    php vendor/bin/phinx init
    ``` 
3. Создаём папки:

    ```
    mk dir db/migrations
    mk dir db/seeds
    ```
4. Создание миграции:
    ```
    php vendor/bin/phinx create CreateUserTable 
    ```
   
5. Редактирование миграции в файле миграции класса миграции CreateUserTable в нашем случае для таблицы users :
    ```
    public function up(): void
    {
        $table = $this->table('users');
        $table
            ->addColumn('name', 'string')
            ->addColumn('email', 'string')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->save();
    }
    public function down():void
    {
        $exists = $this->hasTable('users');
        if($exists) {

            $this->dropSchema('users');
        }
    }
    ```

6. Создадим связанную  внешним ключом user_id таблицу phones с таблицей users :
    ```
    public function up(): void
    {
            $table = $this->table('phones');
            $table
                ->addColumn('phone_number', 'string')
                ->addColumn('user_id', 'integer', ['null' => true,'signed'=>false])
                ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE'])
                ->addColumn('created_at', 'datetime')
                ->addColumn('updated_at', 'datetime')
                ->save();
    }

    public function down(): void
    {
        $exists = $this->hasTable('phones');
        if ($exists) {

            $this->dropSchema('phones');
        }
    }
    ```

7. Накатывание миграции для окружения development: 
    ```
    php vendor/bin/phinx migrate -e development
    ```
   
8. Откат миграции для окружения development: 
    ```
    php vendor/bin/phinx rollback -e development
    ```
 ### !!! Не забываем прописать конфигурацию базы данных в файле phinx.php !!!

## Логирование

Для извлечения состояния из любых переменных используется пакет [VarDumper](https://symfony.com/doc/current/components/var_dumper.html).

## Отслеживание ошибок 
Пакет [filp/whoops](https://packagist.org/packages/filp/whoops)




## Документация будет дополняться