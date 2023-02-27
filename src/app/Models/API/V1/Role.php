<?php
namespace App\Models\API\V1;
use Spatie\Permission\Models\Role as SpatieRole;
use App\Traits\API\V1\HasUuid;

class Role extends SpatieRole
{
    use HasUuid;
}
