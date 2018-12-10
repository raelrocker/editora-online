<?php

namespace CodeEduUser\Facade;

use CodeEduUser\Menu\Navbar;
use Illuminate\Support\Facades\Facade;

class NavbarAuthorization extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Navbar::class;
    }
}