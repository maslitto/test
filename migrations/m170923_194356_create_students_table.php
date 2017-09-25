<?php

use yii\db\Migration;

/**
 * Handles the creation of table `students`.
 * Has foreign keys to the tables:
 *
 * - `group`
 */
class m170923_194356_create_students_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('students', [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer()->notNull(),
            'second_name' => $this->string(),
            'name' => $this->string(),
            'third_name' => $this->string(),
            'nzk' => $this->string()->unique(),
            'starosta' => $this->integer(1)->defaultValue(0),
        ]);

        // creates index for column `group_id`
        $this->createIndex(
            'idx-students-group_id',
            'students',
            'group_id'
        );

        // add foreign key for table `group`
        $this->addForeignKey(
            'fk-students-group_id',
            'students',
            'group_id',
            'groups',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `group`
        $this->dropForeignKey(
            'fk-students-group_id',
            'students'
        );

        // drops index for column `group_id`
        $this->dropIndex(
            'idx-students-group_id',
            'students'
        );

        $this->dropTable('students');
    }
}
