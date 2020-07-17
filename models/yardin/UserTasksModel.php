<?php

namespace app\models\yardin;

use Yii;

/**
 * This is the model class for table "user_tasks".
 *
 * @property int $id
 * @property string $task_name
 * @property string $task_status
 * @property string $task_file
 * @property int $project_id
 */
class UserTasksModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_name', 'task_status', 'project_id'], 'required'],
            [['project_id'], 'integer'],
            [['task_name', 'task_file'], 'string', 'max' => 333],
            [['task_status'], 'string', 'max' => 111],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_name' => 'Task Name',
            'task_status' => 'Task Status',
            'task_file' => 'Task File',
            'project_id' => 'Project ID',
        ];
    }
}
