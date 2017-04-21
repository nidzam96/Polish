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
                        <div class="col-md-8"><h3>All Posts</h3></div>
                        <div class="col-md-4">
                            <span class="pull-right" style="margin-top: 10px">
                                <a href="{{ route('post.create') }}" class="btn btn-danger">
                                    Create Post
                                </a>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <form action="/post/searchpost" method="GET">
                    <!-- <form id="searchForm" name="searchForm" action="{{ route('post.search') }}" method="post" class="form-horizontal"> -->
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-12 input-group">
                                <!-- <div class="col-md-6">
                                    <input type="text" name="searchtext" class="form-control" placeholder="Search for.." style="border-radius: 10px">
                                </div>
                                <div class="col-md-4">
                                    <select name="searchopt" class="form-control" style="border-radius: 10px">
                                        <option value="id">ID</option>
                                        <option value="title">Title</option>
                                        <option value="story">Story</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-danger" style="border-radius: 10px">
                                            Go!
                                        </button>
                                    </span>
                                </div> -->
                                <div class="col-sm-3">
                                    <input type="text" name="searchtext" class="form-control" placeholder="Search Title.." value="{{ Request::get('searchtext') }}" style="border-radius: 10px">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" name="searchStory" class="form-control" placeholder="Search Story.." value="{{ Request::get('searchStory') }}" style="border-radius: 10px">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" name="searchId" class="form-control" placeholder="Search Id.." value="{{ Request::get('searchId') }}" style="border-radius: 10px">
                                </div>
                                <div class="col-sm-3">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-danger" style="border-radius: 10px">
                                            Go!
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>

                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>User</th>
                            <th>User ID</th>
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
                                <td>{{ $post->user->name }}</td>
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

                    {{ $postview->appends(Request::except('page'))->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection