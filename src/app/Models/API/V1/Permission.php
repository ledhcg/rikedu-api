<?php
namespace App\Models\API\V1;
use Spatie\Permission\Models\Permission as SpatiePermission;
use App\Traits\API\V1\HasUuid;

class Permission extends SpatiePermission
{
    use HasUuid;
}
