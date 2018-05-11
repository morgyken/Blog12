

@extends('layouts.master')

@section('title')
Dashboard 
@endsection

@section('content')

 @include('includes.message-block')

<section class="row new-post">
    <div class="col-sm-6 col-md-offset-3">
         <header> <h3>What do you have to say</h3></header>
        <form action="{{ route('post.create') }} " method="post">           

             <input type="hidden" name="_token" value="{{Session::token() }}">
            
            <div class="form-group">
               
                <textarea name="body" rows="8" class="form-control" id="new-post" placeholder="Create Post"></textarea>  
             
            </div>
            <div class="form-group">
               
                <button type="input" class="btn btn-primary">Create Post</button>   
             
            </div>
            
        </form>
        
    </div>
    
</section>


<section class="row posts">

   
    <div class="col-sm-6 col-md-offset-3">
          <header> <h3>What Others have to say</h3></header>

         @foreach($posts as $post)
        <article class="post" data-postid="{{$post->id}}">

            <p id="post-body1">
                {{$post->body}}

            </p>
            <div class="info">
                Posted by {{$post->user->name}} on {{$post-> created_at}}
            </div>
            <div class="interaction">
                <a href="#" class="like"> Like </a> |
                 <a href="#" class="like"> Dislike </a> |
                 @if(Auth::user() == $post->user)

                 <a href="#" id="edit"> Edit</a> |
                  <a href="{{ route('post.delete', ['post_id'=> $post->id])}}"> Delete</a>

                  @endif
            </div>
            
        </article>
  @endforeach
    </div>
  
</section>

<div class="modal fade" tabindex="-1" id="edit-modal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit post</h4>
      </div>
      <div class="modal-body">
        <form>
            
             <div class="form-group">
                <label for="password"> Edit Post </label>
                <textarea name="body" id="post-body" rows="5" class="form-control"></textarea>  
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    var token = "{{Session::token()}}";
    var url = "{{ route('edit') }}";
    var urlLike = "{{ route('like') }}";
   
</script> 
@endsection