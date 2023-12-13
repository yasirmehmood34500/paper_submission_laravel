<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Gate;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function AllowPermission(array $permissions): bool
    {
        if (!Gate::any($permissions)) {
            abort(403);
        }
        return true;
    }

    public static function CheckAllowedPermission(array $permissions): bool
    {
        return Gate::any($permissions);
    }
}
