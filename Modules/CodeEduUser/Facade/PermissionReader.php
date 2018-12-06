<?php

namespace CodeEduUser\Facade;

use Illuminate\Support\Facades\Facade;
use CodeEduUser\Annotations\PermissionReader as PermissionReaderService;

class PermissionReader extends Facade
{
    protected static function getFacadeAccessor() {
        return PermissionReaderService::class;
    }
}