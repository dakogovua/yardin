<?php

namespace app\models\yardin;

use Yii;



/**
 * This is the model class for table "user_projects".
 *
 * @property int $id
 * @property string $project_name
 * @property int $user_id
 */
class UserProjectsModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_projects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_name'], 'required'],
            [['user_id'], 'integer'],
            [['project_name'], 'string', 'max' => 222],
            [['project_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_name' => 'Project Name',
            'user_id' => 'User ID',
        ];
    }

    public function beforeDelete(){
      if (parent::beforeDelete()){
        foreach($this->tasks as $task){
          $task->delete();
        }
        
        return true;
      }
      else{
        return false;
      }
    }

    public function getTasks()
    {
        return $this->hasMany(UserTasksModel::className(), ['project_id' => 'id']);
    }
}
