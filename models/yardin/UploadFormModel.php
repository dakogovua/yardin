<?php

namespace app\models\yardin;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadFormModel extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'imageFile' => 'Вложения'
            ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('files/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }

    public function findFile($file){
      $model = new UploadFormModel();
       $model->imageFile = $file;
       return $model;
    }
}