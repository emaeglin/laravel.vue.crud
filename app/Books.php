<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
	protected $fillable = ['title', 'author', 'isbn', 'genre_id', 'owner_id'];


    public function ownerId(){
        $currentUserId = \Auth::user()->id;
        return $this->belongsTo(Books::class,'owner_id','id')->where('user_id', '=', $currentUserId);
    }

}
