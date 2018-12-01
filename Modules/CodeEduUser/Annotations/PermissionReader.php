<?php

namespace CodeEduUser\Annotations;

use CodeEduUser\Annotations\Mapping\Controller;
use Doctrine\Common\Annotations\Reader;

class PermissionReader
{
    /**
     * @var Reader
     */
    private $reader;

    /**
     * PermissionReader constructor.
     */
    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    public function getPermissions()
    {

    }

    public function getPermission($controllerClass)
    {
        $rc = new \ReflectionClass($controllerClass);
        /** @var Controller $controllerAnnotation */
        $controllerAnnotation = $this->reader->getClassAnnotation($rc, Controller::class);
        $permissions = [];
        if ($controllerAnnotation){
            $permissions[] = [
                'name' => $controllerAnnotation->name,
                'description' => $controllerAnnotation->description
            ];
        }
        return $permissions;
    }
}