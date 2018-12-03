<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $password
 * @property string $raw_password
 * @property string $photo
 * @property string $email
 * @property string $dob
 * @property string $mobile
 * @property string $accessToken
 * @property string $created_at
 * @property string $device_name
 * @property string $device_os_version
 * @property string $device_type
 * @property string $app_version
 * @property string $device_id
 * @property int $is_deleted
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
            [['dob', 'created_at'], 'safe'],
            [['accessToken'], 'string'],
            [['is_deleted'], 'integer'],
            [['first_name', 'last_name', 'raw_password', 'email'], 'string', 'max' => 100],
            [['username', 'device_name', 'device_os_version', 'device_type', 'app_version', 'device_id'], 'string', 'max' => 255],
            [['password', 'photo'], 'string', 'max' => 200],
            [['mobile'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'username' => 'Username',
            'password' => 'Password',
            'raw_password' => 'Raw Password',
            'photo' => 'Photo',
            'email' => 'Email',
            'dob' => 'Dob',
            'mobile' => 'Mobile',
            'accessToken' => 'Access Token',
            'created_at' => 'Created At',
            'device_name' => 'Device Name',
            'device_os_version' => 'Device Os Version',
            'device_type' => 'Device Type',
            'app_version' => 'App Version',
            'device_id' => 'Device ID',
            'is_deleted' => 'Is Deleted',
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
