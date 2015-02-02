<?php

namespace backend\modules\realestate\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\realestate\Property;

/**
 * PropertySearchModel represents the model behind the search form about `common\models\realestate\Property`.
 */
class PropertySearchModel extends Property
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'addressId', 'typeId', 'constructionTypeId', 'constructionStageId', 'sourceId', 'title', 'rooms', 'parking', 'createdBy', 'updatedBy'], 'integer'],
            [['sourceUrl', 'dateOnMarket', 'dateOffMarket', 'description', 'otherDetails', 'createdAt', 'updatedAt'], 'safe'],
            [['price'], 'number'],
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
        $query = Property::find();

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
            'addressId' => $this->addressId,
            'typeId' => $this->typeId,
            'constructionTypeId' => $this->constructionTypeId,
            'constructionStageId' => $this->constructionStageId,
            'sourceId' => $this->sourceId,
            'dateOnMarket' => $this->dateOnMarket,
            'dateOffMarket' => $this->dateOffMarket,
            'title' => $this->title,
            'rooms' => $this->rooms,
            'parking' => $this->parking,
            'price' => $this->price,
            'createdBy' => $this->createdBy,
            'createdAt' => $this->createdAt,
            'updatedBy' => $this->updatedBy,
            'updatedAt' => $this->updatedAt,
        ]);

        $query->andFilterWhere(['like', 'sourceUrl', $this->sourceUrl])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'otherDetails', $this->otherDetails]);

        return $dataProvider;
    }
}
