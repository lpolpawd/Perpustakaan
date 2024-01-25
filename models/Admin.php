<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property int $id
 * @property string|null $Nama_Admin
 * @property string $Username
 * @property string $Password
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Bukus[] $bukuses
 */
class Admin extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin';
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id'=> $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token'=> $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {

    }

    public function validateAuthKey($authKey)
    {

    }
    
    public static function findByUsername($username)
    {
        return self::findOne(['Username' => $username]);
    }

    public function validatePassword($password)
    {
        return $this->Password === $password; 
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Username', 'Password'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['Nama_Admin', 'Password'], 'string', 'max' => 255],
            [['Username'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Nama_Admin' => 'Nama Admin',
            'Username' => 'Username',
            'Password' => 'Password',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Bukuses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBukuses()
    {
        return $this->hasMany(Bukus::class, ['admin_id' => 'id']);
    }
}
