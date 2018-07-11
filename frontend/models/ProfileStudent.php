<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "profile_student".
 *
 * @property int $id
 * @property string $student_id
 * @property string $first_name
 * @property string $last_name
 * @property string $start_study ปีที่เข้ารับการศึกษา
 * @property string $rotation กลุ่มที่เรียน
 * @property int $first_login login ครั้งแรก
 * @property string $created_at
 * @property string $updated_at
 * @property int $active
 */
class ProfileStudent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile_student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_login', 'created_at', 'updated_at', 'active'], 'integer'],
            [['student_id'], 'string', 'max' => 20],
            [['first_name', 'last_name'], 'string', 'max' => 50],
            [['start_study'], 'string', 'max' => 10],
            [['rotation'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'start_study' => 'Start Study',
            'rotation' => 'Rotation',
            'first_login' => 'First Login',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'active' => 'Active',
        ];
    }
}
