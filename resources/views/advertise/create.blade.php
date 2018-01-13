@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Advertisement</div>


                    <div class="panel-body">
        <form class="form-horizontal" action="/advertise/create" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="form-group">
                <label for="titles" class="col-md-4 control-label">Title</label>
                <div class="col-md-6">
                <input id="titles" class="form-control" type="text" name="titles" >
            </div></div>


                <div class="form-group">
                    <label for="image" class="col-md-4 control-label">Image</label>
                    <div class="col-md-6">
                        <input id=""  type="file" name="image" style="margin: 10px 0px 10px 3px">
                    </div></div>


                    <div class="form-group">
                        <label for="titles" class="col-md-4 control-label">Description</label>
                        <div class="col-md-6">
                            <textarea id="description" class="form-control"
                                      type="text" name="description" ></textarea>
                        </div></div>



                        <div class="form-group">
                            <label for="titles" class="col-md-4 control-label">Url</label>
                            <div class="col-md-6">
                                <input id="url" class="form-control" type="text" name="url" >
                            </div>

            </div>



                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-info btn-lg pull-right">

                                Create

                            </button>
                        </div>
                    </div>


        </form>

                        @include('advertise/validate');

                     </div>
                </div>
            </div>
    </div>
    </div>
@endsection