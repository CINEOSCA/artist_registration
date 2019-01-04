<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $guarded = ["id"];

    public function roles(){
        $roles = [];
        if ($this->isSinger){
            array_push($roles, "Singer");
        }
        if ($this->isLyricist){
            array_push($roles, "Lyricist");
        }
        if ($this->isMusician){
            array_push($roles, "Musician");
        }
        if ($this->isAdmin){
            array_push($roles, "Admin");
        }

        return implode(", ", $roles);

    }
}
