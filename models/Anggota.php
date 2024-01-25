<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "anggota".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string|null $alamat
 * @property string|null $no_telpon
 * @property string $email
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Peminjamen[] $peminjamens
 * @property ReviewBuku[] $reviewBukus
 */
class Anggota extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public $status;

    public $password_hash;

    public $auth_key;

    const STATUS_ACTIVE = 1;

    public static function tableName()
    {
        return 'anggota';
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdentity($id)
    {
        // Cari pengguna berdasarkan ID
        $user = Anggota::findOne($id);

        // Pastikan pengguna ditemukan dan aktif (jika diterapkan)
        if ($user && $user->status == Anggota::STATUS_ACTIVE) {
            return $user; // Mengembalikan instance pengguna
        }

        return null; // Mengembalikan null jika pengguna tidak ditemukan atau tidak aktif
    }

    public function getAuthKey()
    {

    }

    public function validateAuthKey($authKey)
    {

    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = \Yii::$app->security->generateRandomString();
    }



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email'], 'required'],
            [['alamat'], 'string'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'email'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 100],
            [['no_telpon'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'alamat' => 'Alamat',
            'no_telpon' => 'No Telpon',
            'email' => 'Email',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Peminjamens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeminjamens()
    {
        return $this->hasMany(Peminjamen::class, ['anggota_id' => 'id']);
    }

    /**
     * Gets query for [[ReviewBukus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviewBukus()
    {
        return $this->hasMany(ReviewBuku::class, ['anggota_id' => 'id']);
    }
}
