@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Blog List') }}
                    <a href="/create_blog" class="btn btn-primary" style = "float: right;">Add</a>
                </div>

                <div class="card-body">
                   <table>
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Title</th>
                                <th>User Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Is Active</th>
                                <th>Action</th>
                            </tr>
                        </thead> 
                        <tbody>
                        <?php $i = 1;?>
                            @if(count($list)>0)
                                @foreach($list as $rawData)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$rawData['title']}}</td>
                                        <td>{{$rawData['user']['first_name']}}</td>
                                        <td>{{$rawData['start_date']}}</td>
                                        <td>{{$rawData['end_date']}}</td>
                                        <td>@if($rawData['is_active'] == true)Yes @else No @endif</td>
                                        <td>
                                            <a href="/edit_blog/{{$rawData['id']}}" class="btn btn-secondary">Edit</a>
                                            <a href="/delete_blog/{{$rawData['id']}}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>                   
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection