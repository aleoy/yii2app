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
    public $city;
    public $district;
    public $constructionType;
    public $type;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'onFloor', 'floorArea', 'addressId', 'typeId', 'constructionTypeId', 'constructionStageId', 'sourceId', 'title', 'rooms', 'parking', 'createdBy', 'updatedBy'], 'integer'],
            [['type', 'constructionType', 'city', 'district', 'sourceUrl', 'dateOnMarket', 'dateOffMarket', 'description', 'otherDetails', 'createdAt', 'updatedAt'], 'safe'],
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

        $query->joinWith(['city', 'district']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Important: here is how we set up the sorting
        // The key is the attribute name on our "PropertySearch" instance
        $dataProvider->sort->attributes['city'] = [
            // The tables are the ones our relation are configured to
            // in this case they are not prefixed, 
            // should the tables be prefixed with "tbl_", we would set 'tbl_city.name' instead
            'asc' => ['city.name' => SORT_ASC],
            'desc' => ['city.name' => SORT_DESC],
        ];
        // Lets do the same with district now
        $dataProvider->sort->attributes['district'] = [
            'asc' => ['district.name' => SORT_ASC],
            'desc' => ['district.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['type'] = [
            'asc' => ['type.name' => SORT_ASC],
            'desc' => ['type.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['constructionType'] = [
            'asc' => ['constructionType.name' => SORT_ASC],
            'desc' => ['constructionType.name' => SORT_DESC],
        ];

        $this->load($params);

        // No search? Then return data Provider
        if (!($this->load($params) && $this->validate())) {
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
            'onFloor' => $this->onFloor,
            'floorArea' => $this->floorArea,
            'parking' => $this->parking,
            'price' => $this->price,
            'createdBy' => $this->createdBy,
            'createdAt' => $this->createdAt,
            'updatedBy' => $this->updatedBy,
            'updatedAt' => $this->updatedAt,
        ]);

        $query->andFilterWhere(['like', 'sourceUrl', $this->sourceUrl])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'otherDetails', $this->otherDetails])
        // Here we search the attributes of our relations using our previously configured
        // ones
        ->andFilterWhere(['like', 'city.name', $this->city])
        ->andFilterWhere(['like', 'district.name', $this->district])
        ->andFilterWhere(['like', 'type.name', $this->type])
        ->andFilterWhere(['like', 'constructionType.name', $this->constructionType]);

        return $dataProvider;
    }
}
