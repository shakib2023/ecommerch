@extends('layouts.app')
@section('title') {{'Details'}} @endsection

@section('content')

<div id="home">
<div class="container">
    <div class="row">
         <div class="col-lg-8">
            <h2>{{$blog_details->blog_title}}</h2>
           @php
           echo $blog_details->details

           @endphp
         </div>

         <div class="col-lg-4">
            <img src="{{$blog_details->blog_image}}" alt="">
         </div>
    </div>
</div>
</div>

@endsection
