@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if (Session::has('success')) 
                <div class="alert alert-success">
                {{ Session('success') }}
                </div>
            @endif
            <div class="panel panel-primary">

                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-8"><h1>All Posts</h1></div>
                        <div class="col-md-4">
                            <span class="pull-right">
                                <a href="{{ route('post.create') }}" class="btn btn-danger">
                                    Create Post
                                </a>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>User</th>
                            <th>Title</th>
                            <th>Story</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                        @foreach ($postview as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ Auth::user()->name}}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->story }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td>{{ $post->updated_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i> Edit</a>
                                        <a href="{{ route('post.delete', $post->id) }}" class="btn btn-sm btn-default"> Delete <i class="fa fa-trash-o"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection