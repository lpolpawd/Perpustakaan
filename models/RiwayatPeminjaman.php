<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "riwayat_peminjaman".
 *
 * @property int $id
 * @property int $peminjamen_id
 * @property string $Status_Peminjaman
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Peminjamen $peminjamen
 */
class RiwayatPeminjaman extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'riwayat_peminjaman';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['peminjamen_id', 'Status_Peminjaman'], 'required'],
            [['peminjamen_id'], 'integer'],
            [['Status_Peminjaman'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['peminjamen_id'], 'exist', 'skipOnError' => true, 'targetClass' => Peminjamen::class, 'targetAttribute' => ['peminjamen_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'peminjamen_id' => 'Peminjamen ID',
            'Status_Peminjaman' => 'Status Peminjaman',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Peminjamen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeminjamen()
    {
        return $this->hasOne(Peminjamen::class, ['id' => 'peminjamen_id']);
    }
}
