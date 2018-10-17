<?php

use yii\db\Migration;

/**
 * Class m181016_131516_add_comment
 */
class m181016_131516_add_comment extends Migration
{
    const TABLE = 'comment';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer()->comment('Страница'),
            'body' => $this->text()->comment('Текст'),
            'user_id' => $this->integer()->comment('Автор'),
            'status' => $this->tinyInteger()->comment('Статус'),
            'created_at' => $this->integer()->unsigned()->comment('Время создания'),
            'updated_at' => $this->integer()->unsigned()->comment('Время редактирования'),
        ]);

        $this->addForeignKey('fk_comment_article', self::TABLE, 'article_id', 'article', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_comment_user', self::TABLE, 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_comment_article', self::TABLE);
        $this->dropForeignKey('fk_comment_user', self::TABLE);
        $this->dropTable(self::TABLE);
    }
}
