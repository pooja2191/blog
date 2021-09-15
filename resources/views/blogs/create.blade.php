@extends('layouts.app')

@section('content')
<style>
  .required:after {
    content:" *";
    color: red;
  }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Add Blog') }}
                </div>

                <div class="card-body">
                    <form action = "/blog_store" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <label for="title" class = "required">Title</label>
                            <input type="text" class="form-control" id="title" name = "title" placeholder="Enter Title" required>
                        </div>
                        <div class="form-group">
                            <label for="description" class = "required">Description</label>
                            <textarea class="form-control" id="description" name = "description" rows="4" cols="50" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="start_date" class = "required">Start Date</label>
                            <input type="date" class="form-control" id="start-date" name = "start_date" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date" class = "required">End Date</label>
                            <input type="date" class="form-control" id="end-date" name = "end_date" required>
                        </div>

                        <div class="form-group">
                            <label for="end_date" class = "required">Is Active</label>
                           <select id="is-active" name = "is_active" required>
                                <option value = "1">Yes</option>
                                <option value = "0">No</option>
                           </select>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name = "image">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection