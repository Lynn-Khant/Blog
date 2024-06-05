<x-admin-layout>
    <h3 class="my-3 text-center">Blog edit form</h3>
    <div class="col-md-8 mx-auto">
        <x-card-wrapper>
            <form
                enctype="multipart/form-data"
                action="/admin/blogs/{{$blog->slug}}/update"
                method="POST"
            >
                @method('patch')
                @csrf
                <x-input name="title" value="{{$blog->title}}"/>
                <x-input name="slug" value="{{$blog->slug}}"/>
                <x-input name="intro" value="{{$blog->intro}}"/>
                <x-textarea name="body" value="{{$blog->body}}"/>
                <x-input name="thumbnail" type="file" value="{{$blog->thumbnail}}"/>
                

                <x-input-wrapper>
                    <x-label name="category"/>
                    <select
                        name="category_id"
                        id="category"
                        class="form-control"
                    >
                        @foreach ($categories as $category)
                        <option {{$category->id==old('category_id') ? 'selected':''}}
                            value="{{$category->id}}">{{$category->name}}
                        </option>
                        @endforeach
                    </select>
                </x-input-wrapper>
                <div class="d-flex justify-content-start mt-3">
                    <button
                        type="submit"
                        class="btn btn-primary"
                    >Submit</button>
                </div>
            </form>
        </x-card-wrapper>
    </div>
</x-admin-layout>