<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DebtsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
             'clientID'=>$this->clientID,
            'lote' => $this->lote,
            'precio' =>$this->precio,
            'vencimiento' =>$this->vencimiento
                // No incluye timestamps
        ];
    }
}
