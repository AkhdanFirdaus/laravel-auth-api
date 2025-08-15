<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'created_at' => Carbon::parse($this->created_at)->toDateString(),
            'is_done' => (bool) $this->status == 1,
            'user' => $this->whenLoaded('user', new UserResource($this->user)),
        ];
    }
}
