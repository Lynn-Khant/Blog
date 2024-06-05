<x-layout>
<div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <h3 class="text-primary text-center my-2">Register form</h3>
                <div class="card p-4 my-3 shadow-sm">
                    <form method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                            <x-error name="name"/>
                        </div>
                        <div class="form-group">
                            <label for="username">User Name</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{old('username')}}">
                            <x-error name="username"/>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}">
                            <x-error name="email"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" name="password" value="{{old('password')}}">
                            <x-error name="password"/>
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>