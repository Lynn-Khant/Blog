<x-admin-layout>
    <h3 class="my-3 text-center">Blog create form</h3>
    <div class="col-md-8 mx-auto">
        <x-card-wrapper>
            <form
                enctype="multipart/form-data"
                action="/admin/blogs/store"
                method="POST"
            >
                @csrf
                <x-input name="title"/>
                <x-input name="slug"/>
                <x-input name="intro"/>
                <x-textarea name="body"/>
                <x-input name="thumbnail" type="file"/>
                

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