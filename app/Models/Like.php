<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Like extends Model
{
    use HasFactory;
    public function likeable()
    {
        return $this->morphTo();
    }

    static function queryLike($id, $type)
    {
        return  DB::table('likes')
            ->where('user_id','=', auth()->user()->id)
            ->where('likeable_id','=', $id)
             ->where('likeable_type','=' ,$type)
            ->get()->first();
    }
}
