<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BlogConroller extends Controller
{
    public function index(){
        
        return view('blogs',[
        "blogs"=>$this->getBlogs(),
        'categories'=>Category::all(),

        ]);
    }
    protected function getBlogs(){
        return Blog::latest()->filter(request(['search','category','username']))->paginate(3)->withQueryString();
         
    }
    public function subscriptionHandler(Blog $blog){
        if(User::find(auth()->id())->isSubscribed($blog)){
            $blog->unsubscribe();
        }else{
            $blog->subscribe();
        }

        return back();
    }
    public function create(){
        return view('admin.create',[
                'categories'=>Category::all()
            ]);
    }
    public function store(){
        
        $formData=request()->validate([
            'title'=>['required'],
            'slug'=>['required',Rule::unique('blogs','slug')],
            'intro'=>['required'],
            'body'=>['required'],
            'category_id'=>['required',Rule::exists('categories','id')],

        ]);
        $formData['user_id']=auth()->id();
        $formData['thumbnail']=request()->file('thumbnail')->store('thumbnails');
        Blog::create($formData);
        return back();
    }
    public function blogs(){
        return view('admin.blogs',[
            'blogs'=>Blog::latest()->paginate(3)
        ]);
    }
    public function destroy(Blog $blog){
        $blog->delete();
        return back();
    }
    public function edit(Blog $blog){
        return view('admin.edit',[
            'categories'=>Category::all(),
            'blog' => $blog,]);
    }
    public function update(Blog $blog){
        $formData = request()->validate([
            "title" => ["required"],
            "slug" =>  ["required", Rule::unique('blogs', 'slug')->ignore($blog->id)],
            "intro" =>  ["required"],
            "body" =>  ["required"],
            "category_id" =>  ["required", Rule::exists('categories', 'id')]
        ]);
        $formData['user_id'] = auth()->id();
        $formData['thumbnail'] = request()->file('thumbnail') ?
            request()->file('thumbnail')->store('thumbnails') : $blog->thumbnail;
        $blog->update($formData);
        return redirect('/');
    }
    

}
