@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <!-- @if (count($errors) > 0) 
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif -->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-8"><h1>Profile</h1></div>
                        <div class="col-md-4">
                            <span class="pull-right">
                                <a href="{{ route('post.index') }}" class="btn btn-danger">
                                    Back
                                </a>
                            </span>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.edit.update', $id) }}" method="post" name="edit_profile">
                    <div class="panel-body">  
                    {{ csrf_field() }}             
                        <div class="row">
                            <div class="col-md-4 col-md-offset-1">
                                <fieldset>
                                    <legend>Name</legend>
                                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                                </fieldset>
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <fieldset>
                                <legend>Email</legend>
                                    <input name="email" class="form-control" value="{{ Auth::user()->email }}"></input>
                                </fieldset>
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer" style="height: 50px">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-md btn-success">Update</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
