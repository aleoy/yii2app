<?php

namespace backend\modules\realestate\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\realestate\PropertySourceEntryPoint;

/**
 * PropertySourceEntryPointSearchModel represents the model behind the search form about `common\models\realestate\PropertySourceEntryPoint`.
 */
class PropertySourceEntryPointSearchModel extends PropertySourceEntryPoint
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sourceId', 'statusId', 'currentPage'], 'integer'],
            [['startedAt', 'finishedAt', 'url', 'description'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = PropertySourceEntryPoint::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'sourceId' => $this->sourceId,
            'statusId' => $this->statusId,
            'startedAt' => $this->startedAt,
            'finishedAt' => $this->finishedAt,
            'currentPage' => $this->currentPage,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
