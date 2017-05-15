<?php
namespace frontend\models;

use Yii;
use yii\base\Security;

/**
 * User model
 */
class User extends \common\models\User
{
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->storage = (new Security())->generateRandomString();
            if (!mkdir($this->getStoragePath())) {
                throw new \Exception('Can not create user storage');
            }
        }

        return parent::beforeSave($insert);
    }
}
