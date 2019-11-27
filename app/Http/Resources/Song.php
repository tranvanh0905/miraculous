<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Song extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->name,
            'artist' => '123',
            'mp3' => $this->mp3_url,
            'poster' => $this->cover_image,
            'id' => $this->id,
            'like' => $this->like,
            'view' => $this->view
        ];
    }
}
