@extends('layouts.app')
@section('title') {{'Home'}} @endsection

@section('content')

<div class="slider">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!-- this is slider section start-->

                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{asset('img/banner/p3.jpg')}}" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{asset('img/banner/p1.jpg')}}" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{asset('img/banner/p2.jpg')}}" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
                <!-- this is slider section end -->
            </div>
        </div>
    </div>
</div>

<div id="home">
<div class="container-fluid">
    <div class="row">

    @foreach ($all_blog as $blog)
    <div class="col-lg-3">
            <div class="card home-card">
            <img src="{{$blog->blog_image}}" class="card-img-top" alt="Image">
            <div class="card-body">
                <h5 class="card-title">{{$blog->blog_title}}</h5>
                <a href="{{url('details',['id' => $blog->id])}}" class="btn btn-primary">Details</a>
            </div>
            </div>
        </div>
@endforeach


    </div>
</div>
</div>

@endsection
