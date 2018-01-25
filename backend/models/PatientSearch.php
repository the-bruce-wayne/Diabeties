<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Patients;

/**
 * PatientSearch represents the model behind the search form about `backend\models\Patients`.
 */
class PatientSearch extends Patients
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by'], 'integer'],
            [['first_name', 'last_name', 'other_name', 'sex', 'national_id', 'vision', 'phone_number', 'phone_number_cell', 'email', 'address', 'date_of_birth', 'smart_phone', 'date_created', 'note', 'hospital_id', 'clinic_number_id'], 'safe'],
            [['waist'], 'number'],
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
        $query = Patients::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        
        $query->joinWith('hospital');
        $query->joinWith('clinicNumber');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }
        
        

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'waist' => $this->waist,
            'date_of_birth' => $this->date_of_birth,
            'created_by' => $this->created_by,
            'date_created' => $this->date_created,
           // 'hospital_id' => $this->hospital_id,
           // 'clinic_number_id' => $this->clinic_number_id,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'other_name', $this->other_name])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'national_id', $this->national_id])
            ->andFilterWhere(['like', 'vision', $this->vision])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'phone_number_cell', $this->phone_number_cell])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'smart_phone', $this->smart_phone])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'hospitals.hospital_name', $this->hospital_id])
            ->andFilterWhere(['like', 'clinics.name', $this->clinic_number_id]);

        return $dataProvider;
    }
}
