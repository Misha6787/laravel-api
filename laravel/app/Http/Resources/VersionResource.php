<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

// Между ответом и запросом мы будем походить здесь и фильтровать отданные или полученные данные
class VersionResource extends JsonResource
{
//    public static $wrap = 'test'; Задать обертку в ответе апи запроса
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
//        return [
//            'title' => $this->title
//            'release_date' => $this->id
//        ];
    }
}
