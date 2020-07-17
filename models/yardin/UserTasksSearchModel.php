<?php

namespace app\models\yardin;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\yardin\UserTasksModel;

/**
 * UserTasksSearchModel represents the model behind the search form of `app\models\yardin\UserTasksModel`.
 */
class UserTasksSearchModel extends UserTasksModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'project_id'], 'integer'],
            [['task_name', 'task_status', 'task_file'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = UserTasksModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'project_id' => $this->project_id,
        ]);

        $query->andFilterWhere(['like', 'task_name', $this->task_name])
            ->andFilterWhere(['like', 'task_status', $this->task_status])
            ->andFilterWhere(['like', 'task_file', $this->task_file]);

        return $dataProvider;
    }
}
