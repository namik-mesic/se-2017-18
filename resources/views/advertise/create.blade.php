@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Advertisement</div>


                    <div class="panel-body">
        <form action="/advertise/create" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div>
                <label for="">Title</label>
                <input type="text" name="titles">
            </div>

            <div>
                <label for="">Image</label>
                <input type="file" name="image" id="">
            </div>

            <div>
                <label for="">Description</label>
                <textarea name="description" id="" cols="30" rows="10"></textarea>
            </div>

            <div>
                <label for="">Url</label>
                <input type="text" name="url">

            </div>
                <div>

                    <label for="">Category</label>
                    <select name="category" id="">
                        <option value="">Internships</option>
                        <option value="">Courses</option>
                        <option value="">Electronics</option>
                        <option value="">Clubs</option>
                        <option value="">Restaurants</option>
                        <option value="">Gym</option>
                    </select>

                </div>

                <button>Create</button>
        </form>
                     </div>
                </div>
            </div>
    </div>
    </div>
@endsection