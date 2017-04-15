@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if (count($errors) > 0) 
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-8"><h1>New Post</h1></div>
                        <div class="col-md-4">
                            <span class="pull-right">
                                <a href="{{ route('post.index') }}" class="btn btn-danger">
                                    Cancel
                                </a>
                            </span>
                        </div>
                    </div>
                </div>

                <form action="{{ route('post.create.save') }}" method="post" name="form_post">
                    <div class="panel-body">  
                    {{ csrf_field() }}             
                        <div class="row">
                            <div class="col-md-4 col-md-offset-1">
                                <fieldset>
                                    <legend>Title</legend>
                                    <input type="text" name="title" class="form-control" placeholder="Title">
                                </fieldset>
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <fieldset>
                                <legend>Stories</legend>
                                    <textarea name="story" class="form-control" placeholder="Stories"></textarea>
                                </fieldset>
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer" style="height: 50px">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-md btn-success">Post</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
