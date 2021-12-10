<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NoticiasResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'not_id' => $this->not_id,                
            'clu_id_siid' => $this->clu_id_siid,
            'not_fecha' => $this->not_fecha,
            'image'=> "https://ligapremier-fmf.mx/_cpanel/_images/_noticias/$this->not_img",
            'image2'=> "https://ligapremier-fmf.mx/_cpanel/_images/_noticias2/$this->not_img_2",
            'not_desc' => $this->not_desc,
            'not_home' => $this->not_home,
            'not_cat'=> $this->not_cat,
        ];
    }
}
