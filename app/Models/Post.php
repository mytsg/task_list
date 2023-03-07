<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;

class Post extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function scopeSearchPost($query, $search = null, $label = null){
        if(!empty($search) && !empty($label)){
            return $query->where('title','like',"%".$search."%")
            ->where('label','=',$label);
        } elseif(!empty($search) && empty($label)){
            return $query->where('title','like',"%".$search."%");
        } elseif(empty($search) && !empty($label)) {
            return $query->where('label','=',$label);
        }

        // if(!empty($label) && $label != 'all'){
        //     return $query->where('label','=',$label);
        // }
    }

    // public function scopeGetPostByLabel($query, $label = null){
    //     if(!empty($label) || $label != 'all'){
    //         return $query->where('label','=',$label);
    //     }
    // }

    public function scopeGetPostForParticularUser($query, $search = null, $label = null, $userId) {
        if(!empty($search) && !empty($label)){
            return $query->where('title','like',"%".$search."%")
            ->where('label','=',$label)
            ->where('user_id','=',$userId);
        } elseif(!empty($search) && empty($label)){
            return $query->where('title','like',"%".$search."%")
            ->where('user_id','=',$userId);
        } elseif(empty($search) && !empty($label)) {
            return $query->where('label','=',$label)
            ->where('user_id','=',$userId);
        } else {
            return $query->where('user_id','=',$userId);   
        }
    }

    protected $fillable = [
        'user_id',
        'content',
        'title',
        'deadline',
        'label',
    ];
}
