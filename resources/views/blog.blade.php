<x-layout>
    <!-- single blog section -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto text-center">
                <img
                    src='{{asset("storage/$blog->thumbnail")}}'
                    class="card-img-top"
                    alt="..."
                />
                <h3 class="my-3">{{$blog->title}}</h3>
                <div>
                    <div>Author - {{$blog->author->name}}</div>
                    <div ><a href="/categories/{{$blog->category->slug}}"><span class="badge bg-primary">{{$blog->category->name}}</span></a></div>
                    <div class="text-secondary">{{$blog->created_at->diffForHumans()}}</div>
                </div>
                <form 
                action="/blogs/{{$blog->slug}}/subscription"
                method="POST">
                    @csrf
                    @auth
                    @if(auth()->user()->isSubscribed($blog))
                    <button class="btn btn-danger">unsubscribe</button>
                    @else
                    <button class="btn btn-warning">subscribe</button>
                    @endif
                    @endauth
                </form>
                <p class="lh-md mt-3">
                    {{$blog->body}}
                </p>
            </div>
        </div>
    </div>
    <section class="container">
        <div class="col-md-8 mx-auto">
            @auth
            <x-card-wrapper>
                <x-comment-form :blog="$blog"/>
            </x-card-wrapper>
            @else
            <p class="text-center">Please <a href="/login">Login</a>to participate in the discussion</p>
            @endauth
        </div>
    </section>
    <x-comments :comments="$blog->comments" />
    <!-- <x-subscribe /> -->
    <x-blogs_you_may_like_section :randomBlogs="$randomBlogs" />
</x-layout>

