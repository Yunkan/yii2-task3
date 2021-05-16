<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property int $type_id
 * @property string $name
 * @property string $image
 *
 * @property Types $type
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $imageFile;

    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'name'], 'required'],
            [['type_id'], 'integer'],
            [['name', 'image'], 'string'],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Types::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['imageFile'], 'file']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Тип',
            'name' => 'Название',
            'image' => 'Изображение',
        ];
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Types::className(), ['id' => 'type_id']);
    }

    public function getItems() {
        return Types::find()->all();
    }

    public function upload() {
        if($this->validate()) {
            $path = 'uploads/'.$this->imageFile->baseName.'.'.$this->imageFile->extension;
            $this->imageFile->saveAs($path);
            $this->image = $path;

            return true;
        } else 
            return false;
    }
}
