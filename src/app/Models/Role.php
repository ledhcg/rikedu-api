<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use App\Traits\HasUuid;

class Role extends SpatieRole
{
    use HasUuid;
}