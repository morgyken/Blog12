@extends('layouts.master')

@section('title')
Account

@endsection


@section('content')

<section class="row new-post">
    <div class="col-sm-6 col-md-offset-3">
         <header> <h3>Your Account</h3></header>
        <form action="{{ route('account.save') }} " method="post" enctype="multipart/form-data">           

             <input type="hidden" name="_token" value="{{Session::token() }}">
            
             <div class="form-group">
                <label for="password"> Name </label>
                <input type="text"  value="{{ $user->name}}"  class="form-control" id="name" name="name">   
             
            </div>
             <div class="form-group">
                <label for="password"> Image  </label>
                <input type="file" class="form-control" id="image" name="image">   
             
            </div>
             
            <div class="form-group">
               
                <button type="submit" class="btn btn-primary">Save Account</button>   
             
            </div>
            
        </form>
        
    </div>
    
</section>

@if(Storage::disk('local')->has($user->name.'-'.$user->id.'jpg'))
<section class="row new-post">
	<div class="col-sm-6 col-md-offset-3">
		<img style="width: 700px;"   src="{{ route('account.image', ['filename' => $user->name.'-'.$user->id.'jpg' ])}}">
		
	</div>
</section>
@endif

@endsection