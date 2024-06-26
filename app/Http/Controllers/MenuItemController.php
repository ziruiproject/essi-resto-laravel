<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Orion\Http\Controllers\Controller;
use Orion\Concerns\DisableAuthorization;

class MenuItemController extends Controller
{
    use DisableAuthorization;
    protected $model = MenuItem::class;
}
