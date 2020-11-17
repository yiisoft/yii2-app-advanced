<?php

namespace core\entities\user;

use Yii;
use yii\web\IdentityInterface;
use filsh\yii2\oauth2server\Module;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;
use core\repositories\UserRepository;
use OAuth2\Storage\UserCredentialsInterface;

class Identity implements IdentityInterface, UserCredentialsInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param int|string $id
     * @return Identity|IdentityInterface|null
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    public static function findIdentity($id)
    {
        $user = self::getRepository()->findActiveById($id);
        return $user ? new self($user): null;
    }

    /**
     * @param mixed $token
     * @param null $type
     * @return Identity|IdentityInterface|null
     * @throws InvalidConfigException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $data = self::getOauth()->getServer()->getResourceController()->getToken();
        return !empty($data['user_id']) ? static::findIdentity($data['user_id']) : null;
    }

    public function getId(): int
    {
        return $this->user->id;
    }

    public function getAuthKey(): string
    {
        return $this->user->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @param $username
     * @param $password
     * @return bool
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    public function checkUserCredentials($username, $password): bool
    {
        if (!$user = self::getRepository()->findActiveByUsername($username)) {
            return false;
        }
        return $user->validatePassword($password);
    }

    /**
     * @param string $username
     * @return array
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    public function getUserDetails($username): array
    {
        $user = self::getRepository()->findActiveByUsername($username);
        return ['user_id' => $user->id];
    }

    /**
     * @return UserRepository
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    private static function getRepository(): UserRepository
    {
        return \Yii::$container->get(UserRepository::class);
    }

    private static function getOauth(): Module
    {
        return Yii::$app->getModule('oauth2');
    }
}
