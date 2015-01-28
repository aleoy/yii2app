<?php

namespace backend\modules\location\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\location\Neighborhood;

/**
 * NeighborhoodSearchModel represents the model behind the search form about `common\models\location\Neighborhood`.
 */
class NeighborhoodSearchModel extends Neighborhood
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cityId', 'districtId'], 'integer'],
            [['name'], 'safe'],
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
        $query = Neighborhood::find();

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
            'cityId' => $this->cityId,
            'districtId' => $this->districtId,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
