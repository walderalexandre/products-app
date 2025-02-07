<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id' => $this->id,
            'nome' => $this->nome,
            'preco' => $this->preco,
            'descricao' => $this->descricao,
            'created_at' => $this->created_at->format('d/m/Y H:i:s'), // Formata a data
            'updated_at' => $this->updated_at->format('d/m/Y H:i:s'), // Formata a data
        ];
    }
}
