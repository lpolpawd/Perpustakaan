<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "peminjamen".
 *
 * @property int $id
 * @property int $anggota_id
 * @property int $bukus_id
 * @property string $Tanggal_Peminjaman
 * @property string $Tanggal_Pengembalian
 * @property string|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Anggota $anggota
 * @property Bukus $bukus
 * @property RiwayatPeminjaman[] $riwayatPeminjamen
 */
class Peminjamen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'peminjamen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['anggota_id', 'bukus_id', 'Tanggal_Peminjaman', 'Tanggal_Pengembalian'], 'required'],
            [['anggota_id', 'bukus_id'], 'integer'],
            [['Tanggal_Peminjaman', 'Tanggal_Pengembalian', 'created_at', 'updated_at'], 'safe'],
            [['status'], 'string'],
            [['anggota_id'], 'exist', 'skipOnError' => true, 'targetClass' => Anggota::class, 'targetAttribute' => ['anggota_id' => 'id']],
            [['bukus_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bukus::class, 'targetAttribute' => ['bukus_id' => 'id']],
            // Tambahkan aturan validasi untuk peminjaman dan pengembalian
            [['Tanggal_Peminjaman'], 'validatePeminjaman'],
            [['Tanggal_Pengembalian'], 'validatePengembalian'],
        ];
    }

    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REJECTED = 'rejected';

    public static function getStatusList()
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_ACCEPTED => 'Accepted',
            self::STATUS_REJECTED => 'Rejected',
        ];
    }

    public function validatePeminjaman($attribute, $params)
    {
        $today = new \DateTime('today');
        $peminjamanDate = new \DateTime($this->$attribute);

        if ($peminjamanDate < $today) {
            $this->addError($attribute, 'Tanggal peminjaman tidak boleh sebelum hari ini.');
        }
    }

    public function validatePengembalian($attribute, $params)
    {
        $tomorrow = new \DateTime('tomorrow');
        $pengembalianDate = new \DateTime($this->$attribute);

        if ($pengembalianDate < $tomorrow) {
            $this->addError($attribute, 'Tanggal pengembalian harus hari ini atau setelahnya.');
        }
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'anggota_id' => 'Anggota ID',
            'bukus_id' => 'Bukus ID',
            'Tanggal_Peminjaman' => 'Tanggal Peminjaman',
            'Tanggal_Pengembalian' => 'Tanggal Pengembalian',
            'status' => 'Status',
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

    /**
     * Gets query for [[RiwayatPeminjamen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRiwayatPeminjamen()
    {
        return $this->hasMany(RiwayatPeminjaman::class, ['peminjamen_id' => 'id']);
    }
}
