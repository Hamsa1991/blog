<?php

namespace Modules\Auth\transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Auth\Transformers\UserResource;

class LoginResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'user' => new UserResource($this['user']),
            'token' => $this['token'],
        ];
    }
}
