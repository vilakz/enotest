<?php

use yii\db\Migration;

/**
 * Class m181016_131504_add_article
 */
class m181016_131504_add_article extends Migration
{
    const TABLE = 'article';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'title' => $this->string(1024)->comment('Заголовок'),
            'body' => $this->text()->comment('Текст'),
            'user_id' => $this->integer()->comment('Автор'),
            'created_at' => $this->integer()->unsigned()->comment('Время создания'),
            'updated_at' => $this->integer()->unsigned()->comment('Время редактирования'),
        ]);

        $this->addForeignKey('fk_article_user', self::TABLE, 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_article_user', self::TABLE);
        $this->dropTable(self::TABLE);
    }
}
