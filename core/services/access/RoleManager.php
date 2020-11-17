<?php

namespace core\services\access;

use yii\rbac\ManagerInterface;

class RoleManager
{
    private $manager;

    public function __construct(ManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function assign($userId, $name): void
    {
        if (!$role = $this->manager->getRole($name)) {
            throw new \DomainException('Role "' . $name . '" does not exist.');
        }
        $this->manager->revokeAll($userId);
        $this->manager->assign($role, $userId);
    }
}
