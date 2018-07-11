<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "rotation".
 *
 * @property int $id
 * @property string $name
 * @property int $active
 * @property string $created_at
 */
class Rotation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rotation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'active' => 'Active',
            'created_at' => 'Created At',
        ];
    }
}
