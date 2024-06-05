<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function subscribers(){
        return $this->belongsToMany(User::class,'blog_user');
    }

    public function subscribe(){
        $this->subscribers()->attach(auth()->id());
    }
    public function unsubscribe(){
        $this->subscribers()->detach(auth()->id());
    }
    public function scopeFilter($blogs,$filter){
        $blogs->when($filter['search']??false,function($blogs,$search){
            $blogs->where('title','LIKE','%'.$search.'%')->orWhere('body','LIKE','%'.$search.'%');
        });

        $blogs->when($filter['category']??false,function($blogs,$slug){
            $blogs->whereHas('category',function($blogs) use($slug){
                $blogs->where('slug',$slug);
            });
        });

        $blogs->when($filter['username']??false,function($blogs,$username){
            $blogs->whereHas('author',function($blogs) use($username){
                $blogs->where('username',$username);
            });
        });

        return $blogs;
    }
}
