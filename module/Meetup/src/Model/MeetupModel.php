<?php
/**
 * Created by PhpStorm.
 * User: sridar
 * Date: 07/01/2018
 * Time: 10:51
 */

namespace Meetup\Model;


class MeetupModel
{


    public function exchangeArray($data){
        //$this->id = $data['id'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->title = $data['title'] ?? null;
        $this->date_debut = $data['date_debut'] ?? null;
        $this->date_fin = $data['date_fin'] ?? null;
    }

}