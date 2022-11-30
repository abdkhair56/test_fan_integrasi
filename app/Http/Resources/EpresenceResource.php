<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EpresenceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {        

        $tampung = [];
        $no = 0;
        for ($i=0; $i < count($this->waktu_masuk) ; $i++) {             
            $d = [
                'id_users'=> $this->id,
                'nama_user' => $this->name,
                'tanggal' => date("Y-m-d", strtotime($this->waktu_masuk[$i]->date)),
                'waktu_masuk' => date("H:i:s", strtotime($this->waktu_masuk[$i]->date)),
                'waktu_pulang' => isset($this->waktu_pulang[$i + count($this->waktu_masuk) + 1]) ? (date("H:i:s", strtotime($this->waktu_pulang[$i + count($this->waktu_masuk) + 1]->date))) : null,
                'status_masuk' => $this->waktu_masuk[$no]->is_approve == 1 ? 'APPROVED' : 'REJECTED',
                'status_pulang' => isset($this->waktu_pulang[$i + count($this->waktu_masuk) + 1]) ? ($this->waktu_pulang[$i + count($this->waktu_masuk) + 1]->is_approve == 1 ? "APPROVED" : "REJECTED") : null,
            ];
            array_push($tampung, $d);
            $no += 1;
        }

        return $tampung;
    }
}
