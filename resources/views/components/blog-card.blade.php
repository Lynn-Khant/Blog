@props(['blog'])
<div class="card">
    <img
        src="{{asset("storage/$blog->thumbnail")}}"
        alt="..."
    />
    <div class="card-body">
        <h3 class="card-title">{{$blog->title}}</h3>
        <p class="fs-6 text-secondary">
            <a href="/?username={{$blog->author->username}}"><apan>{{$blog->author->name}}</apan></a>
            
            <span> - {{$blog->created_at->diffForHumans()}}</span>
        </p>
        <div class="tags my-3">
            <span><a href="/?category={{$blog->category->slug}}"><span class="badge bg-primary">{{$blog->category->name}}</span></a></span>
            
        </div>
        <p class="card-text">
            {{$blog->intro}}
        </p>
        <a
            href="/blogs/{{$blog->slug}}"
            class="btn btn-primary"
        >Read More</a>
    </div>
</div>