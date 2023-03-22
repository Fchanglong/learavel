<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return $request;
        // return [
        //     'id' => $this->id,
        //     'title' => $this->title,
        //     'body' => $this->body,
        //     // 'created_at' => $this->created_at,
        //     // 'updated_at' => $this->updated_at,
        // ];
        $data = $this->collection->toArray();
        // $meta = $this->meta;
            return $data;
    return [
        // 'data' => $this->collection->toArray(),
        // 'links' => [
        //     'first' => $data['first_page_url'],
        //     'last' => $data['last_page_url'],
        //     'prev' => $data['prev_page_url'],
        //     'next' => $data['next_page_url'],
        // ],
        'meta' => [
            'path' => 3,
            'per_page' => 2,
            'to' => 1,
        ]
    ];
    }
}
