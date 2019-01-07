<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $user_id
 * @property string $name
 * @property string $email
 * @property string $profile_pic
 * @property string $username
 * @property string $password
 * @property int $is_deleted
 * @property string $created_at
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $authKey;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'username', 'is_deleted', 'created_at'], 'required'],
            [['is_deleted'], 'integer'],
            [['created_at', 'authKey'], 'safe'],
            [['name', 'email', 'profile_pic', 'username', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'name' => 'Name',
            'email' => 'Email',
            'profile_pic' => 'Profile Pic',
            'username' => 'Username',
            'password' => 'Password',
            'is_deleted' => 'Is Deleted',
            'created_at' => 'Created At',
        ];
    }


    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $dbUser = Users::find()->where(["accessToken" => $token])->one();
        if (!count($dbUser)) {
            return null;
        }
        return new static($dbUser);
    }


    /**
     * Finds user by username
     *
     * @param  string $username
     * @return static|null
     */


    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }


    public static function findByEmail($username)
    {
        return static::findOne(['email' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->user_id;
    }


    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
}
