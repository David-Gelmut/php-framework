<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreatePhoneTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
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
}


