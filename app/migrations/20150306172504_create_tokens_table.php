<?php

use Phinx\Migration\AbstractMigration;

class CreateTokensTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
    public function change()
    {
    }
    */
    
    /**
     * Migrate Up.
     */
    public function up()
    {
        $this->table('tokens')
            ->addColumn('user_id', 'integer')
            ->addColumn('token', 'string')
            ->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addForeignKey('user_id', 'users', 'id')
            ->addIndex('token', ['unique' => true])
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('tokens');
    }
}