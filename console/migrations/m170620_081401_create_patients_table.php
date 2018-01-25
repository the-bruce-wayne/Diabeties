<?php

use yii\db\Migration;

/**
 * Handles the creation of table `patients`.
 */
class m170620_081401_create_patients_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('patients', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('patients');
    }
}
