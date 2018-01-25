<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "patients".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $other_name
 * @property string $sex
 * @property string $national_id
 * @property string $vision
 * @property double $waist
 * @property string $phone_number
 * @property string $phone_number_cell
 * @property string $email
 * @property string $address
 * @property string $date_of_birth
 * @property string $smart_phone
 * @property integer $created_by
 * @property string $date_created
 * @property string $note
 * @property integer $hospital_id
 * @property integer $clinic_number_id
 *
 * @property PatientScreenings[] $patientScreenings
 * @property Screenings[] $screenings
 * @property Hospitals $hospital
 * @property Clinics $clinicNumber
 * @property User $createdBy
 */
class Patients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
                [['first_name', 'last_name', 'sex', 'national_id', 'waist', 'phone_number', 'date_of_birth', 'created_by', 'hospital_id', 'clinic_number_id', 'smart_phone'], 'required'],
            [['sex', 'smart_phone'], 'string'],
            [['waist'], 'number'],
            [['date_of_birth', 'date_created'], 'safe'],
            [['created_by', 'hospital_id', 'clinic_number_id'], 'integer'],
            [['first_name', 'last_name', 'other_name', 'national_id'], 'string', 'max' => 20],
            [['vision'], 'string', 'max' => 30],
            [['phone_number', 'phone_number_cell'], 'string', 'max' => 15],
            [['email', 'email'], 'string', 'max' => 25],
            [['address', 'note'], 'string', 'max' => 255],
            [['hospital_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hospitals::className(), 'targetAttribute' => ['hospital_id' => 'id']],
            [['clinic_number_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clinics::className(), 'targetAttribute' => ['clinic_number_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'other_name' => 'Other Name',
            'sex' => 'Sex',
            'national_id' => 'National ID',
            'vision' => 'Vision',
            'waist' => 'Waist',
            'phone_number' => 'Phone Number',
            'phone_number_cell' => 'Phone Number Cell',
            'email' => 'Email',
            'address' => 'Address',
            'date_of_birth' => 'Date Of Birth',
            'smart_phone' => 'Smart Phone',
            'created_by' => 'Created By',
            'date_created' => 'Date Created',
            'note' => 'Note',
            'hospital_id' => 'Hospital',
            'clinic_number_id' => 'Clinic',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatientScreenings()
    {
        return $this->hasMany(PatientScreenings::className(), ['patient_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScreenings()
    {
        return $this->hasMany(Screenings::className(), ['id' => 'screening_id'])->viaTable('patient_screenings', ['patient_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHospital()
    {
        return $this->hasOne(Hospitals::className(), ['id' => 'hospital_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClinicNumber()
    {
        return $this->hasOne(Clinics::className(), ['id' => 'clinic_number_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
