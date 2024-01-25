<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "review_buku".
 *
 * @property int $id
 * @property int $bukus_id
 * @property int $anggota_id
 * @property string $Isi_Review
 * @property int $Peringkat
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Anggota $anggota
 * @property Bukus $bukus
 */
class ReviewBuku extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review_buku';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bukus_id', 'anggota_id', 'Isi_Review', 'Peringkat'], 'required'],
            [['bukus_id', 'anggota_id', 'Peringkat'], 'integer'],
            [['Isi_Review'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['anggota_id'], 'exist', 'skipOnError' => true, 'targetClass' => Anggota::class, 'targetAttribute' => ['anggota_id' => 'id']],
            [['bukus_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bukus::class, 'targetAttribute' => ['bukus_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bukus_id' => 'Bukus ID',
            'anggota_id' => 'Anggota ID',
            'Isi_Review' => 'Comment',
            'Peringkat' => 'Rating',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Anggota]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnggota()
    {
        return $this->hasOne(Anggota::class, ['id' => 'anggota_id']);
    }

    /**
     * Gets query for [[Bukus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBukus()
    {
        return $this->hasOne(Bukus::class, ['id' => 'bukus_id']);
    }
}
