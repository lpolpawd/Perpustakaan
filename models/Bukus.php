<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "bukus".
 *
 * @property int $id
 * @property string $Sampul
 * @property string $Judul
 * @property string|null $Penulis
 * @property string|null $Penerbit
 * @property int|null $Tahun_Terbit
 * @property int|null $Jumlah_Salinan
 * @property int|null $Kategori_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $admin_id
 *
 * @property Admin $admin
 * @property Kategori $kategori
 * @property Peminjamen[] $peminjamens
 * @property ReviewBuku[] $reviewBukus
 */
class Bukus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bukus';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Sampul', 'Judul'], 'required'],
            [['Tahun_Terbit', 'Jumlah_Salinan', 'Kategori_id', 'admin_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['Sampul'], 'string', 'max' => 200],
            [['Judul', 'Penulis', 'Penerbit'], 'string', 'max' => 255],
            [['Kategori_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kategori::class, 'targetAttribute' => ['Kategori_id' => 'id']],
            [['admin_id'], 'exist', 'skipOnError' => true, 'targetClass' => Admin::class, 'targetAttribute' => ['admin_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Sampul' => 'Sampul',
            'Judul' => 'Judul',
            'Penulis' => 'Penulis',
            'Penerbit' => 'Penerbit',
            'Tahun_Terbit' => 'Tahun Terbit',
            'Jumlah_Salinan' => 'Jumlah Salinan',
            'Kategori_id' => 'Kategori ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'admin_id' => 'Admin ID',
        ];
    }

    /**
     * Gets query for [[Admin]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdmin()
    {
        return $this->hasOne(Admin::class, ['id' => 'admin_id']);
    }

    /**
     * Gets query for [[Kategori]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKategori()
    {
        return $this->hasOne(Kategori::class, ['id' => 'Kategori_id']);
    }

    /**
     * Gets query for [[Peminjamens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeminjamens()
    {
        return $this->hasMany(Peminjamen::class, ['bukus_id' => 'id']);
    }

    /**
     * Gets query for [[ReviewBukus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviewBukus()
    {
        return $this->hasMany(ReviewBuku::class, ['bukus_id' => 'id']);
    }
}
