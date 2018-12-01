<?php

namespace CodeEduUser\Annotations;

use CodeEduUser\Annotations\Mapping\Action;
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
            $permission[] = [
                'name' => $controllerAnnotation->name,
                'description' => $controllerAnnotation->description
            ];
            $rcMethods = $rc->getMethods();
            foreach($rcMethods as $rcMethod) {

                /** @var Action $actionAnnotation */
                $actionAnnotation = $this->reader->getMethodAnnotation($rcMethod, Action::class);
                if ($actionAnnotation) {
                    $permission['resource_name'] = $actionAnnotation->name;
                    $permission['resource_description'] = $actionAnnotation->description;
                    $permissions[] = (new \ArrayIterator($permission))->getArrayCopy();
                }
            }
        }
        return $permissions;
    }
}