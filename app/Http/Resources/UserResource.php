<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserResource
 *
 * @package App\Http\Resources
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->resource->getKey(),
            'first_name'  => $this->first_name,
            'last_name'   => $this->last_name,
            'photo_url'   => $this->photo_url,
            'email'       => $this->email,
            'roles'       => $this->resource->roles->pluck('name')->toArray(),
            'permissions' => $this->resource->getAllPermissions()->pluck('name')->toArray()
        ];
    }
}
