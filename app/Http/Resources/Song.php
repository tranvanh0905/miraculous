<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Song extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $array_artistId = [];
        $array_artistName = [];

        foreach ($this->artists as $artist) {
            array_push($array_artistId, $artist->id);
        };

        foreach ($this->artists as $artist) {
            array_push($array_artistName, $artist->nick_name);
        };

        return [
            'title' => $this->name,
            'artist_id' => $array_artistId,
            'artist' => $array_artistName,
            'mp3' => $this->mp3_url,
            'poster' => $this->cover_image,
            'id' => $this->id,
            'like' => $this->like,
            'view' => $this->view
        ];
    }
}
