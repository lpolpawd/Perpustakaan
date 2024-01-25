<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rekomendasi".
 *
 * @property string $Judul
 * @property string $Kategori
 * @property int $Rating
 */
class Rekomendasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rekomendasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Judul', 'Kategori'], 'required'],
            [['Rating'], 'integer'],
            [['Judul', 'Kategori'], 'string', 'max' => 52],
            [['Judul'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Judul' => 'Judul',
            'Kategori' => 'Kategori',
            'Rating' => 'Rating',
        ];
    }
}
