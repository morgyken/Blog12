

@extends('layouts.master')

@section('title')
Welcome 
@endsection

@section('content')
 @include('includes.message-block')

<div class="row">
    <div class="col-sm-6">
        <form action="{{ route ('login')}}" method="post">

            <input type="hidden" name="_token" value="{{Session::token() }}">

            <div class="form-group">
                <label for="email"> Your Email </label>
                <input type="text" class="form-control" id="email" name="email">   
             
            </div>
            
            <div class="form-group">
                <label for="password"> Your Password </label>
                <input type="text" class="form-control" id="password" name="password">   
             
            </div>

            <div class="form-group">
               
                <button type="input" class="butn btn-primary">Log in </button>   
             
            </div>
            
        </form>
        
    </div>

        <div class="col-sm-6">

        <form action="{{route('signup')}}" method="post">

            <input type="hidden" name="_token" value="{{Session::token() }}">

            <div class="form-group">
                <label for="email"> Your Email </label>
                <input type="text" class="form-control" id="email" name="email">   
             
            </div>

            <div class="form-group">
                <label for="first_name"> Name </label>
                <input type="text" class="form-control" id="name" name="name"> 
             
            </div>

            <div class="form-group">
                <label for="password"> Your Password </label>
                <input type="password" class="form-control" id="password" name="password">   
             
            </div>

             <input type="hidden" name="_token" value="{{Session::token() }}">

            <div class="form-group">
               
                <button type="input" class="btn btn-primary">Signup</button>   
             
            </div>
            
        </form>
        
    </div>
    
</div>
 
@endsection