@section('title', 'Homepage')
@extends('template.masteradmin')
@section('content')
<div class="card text-center" style="background:black;">
    <video muted autoplay loop>
        <source src="{{asset('storage/trailer/Symphony of Truth Trailer 2.mp4')}}" type="video/mp4"/>
    </video>
    <div class="card-img-overlay">
        <br/><br/><br/><br/><br/>
          <h1 class="card-title" style="color:white; font-family:Brush Script Std; font-size: 45px;">
          Tokotoko.id - Honkai Impact 3rd wiki and tier list
          </h1>
          <p class="card-text" style="color:White;" >
          Welcome Admin!
          </p>
          <h1  style="color:white; font-family:Brush Script Std; font-size: 45px;">
            Current Event:
          </h1>
          <div class="row row-cols-3 justify-content-md-center">
            <div class="card-transparent" style="width: 35rem;">
                <img class="card-img-top" src="{{asset('storage/trailer/Symphony of Truth Banner.png')}}" alt="Card image cap">
                <div class="card-body">
                    <img src="{{asset('storage/image/Symphony of Truth Logo.png')}}">
                </div>
            </div>
          </div>
</div>
<div class="card text-center" style="background:black;">
    <img src="{{asset('storage/image/elysia.jpg')}}" style="opacity: 0.4;">
    <div class="card-img-overlay">
    <br/><br/><br/>
      <h1 class="card-title" style="color:white; font-family:Brush Script Std; font-size: 45px;">
      Tokotoko.id provide everything you need!
      </h1>
      <br/><br/><br/>
      <div class="row row-cols-3 justify-content-md-center">
        <div class="card-transparent" style="width: 20rem;">
          <a href={{ route('Admin Guide Page') }}>
              <img class="card-img-top" src="{{asset('storage/image/guide.jpg')}}" alt="Card image cap">
          </a>
          <div class="card-body">
              <h5 class="card-title" style="color:white;">Guides</h5>
            <p class="card-text" style="color:white;">Knowledge is power and Tokotoko teaches you what to do (or what not to do) in order to gain advantage over other players.</p>
          </div>
        </div>
        <div class="card-transparent" style="width: 20rem;">
          <a href="{{ route('Admin Character Page') }}">
              <img class="card-img-top" src="{{asset('storage/image/charareview.jpg')}}" alt="Card image cap">
          </a>
          <div class="card-body">
              <h5 class="card-title" style="color:white;">Characters Review</h5>
            <p class="card-text" style="color:white;">Gacha games revolve about collecting characters and Tokotoko helps you use them in an optimal way.</p>
          </div>
        </div>
        <div class="card-transparent" style="width: 20rem;">
          <a href={{ route('Admin Tier List Page') }}>
              <img class="card-img-top" src="{{asset('storage/image/tier list.png')}}" alt="Card image cap">
          </a>
          <div class="card-body">
              <h5 class="card-title" style="color:white;">Tier list and meta analysis</h5>
            <p class="card-text" style="color:white;">Whether you are a meta slave or a collector, playing any gacha game without a good tier list makes everything harder.</p>
          </div>
        </div>
        <div class="card-transparent" style="width: 20rem;">
          <a href={{ route('Admin News Page') }}>
              <img class="card-img-top" src="{{asset('storage/image/newsupdate.jpg')}}" alt="Card image cap">
          </a>
          <div class="card-body">
              <h5 class="card-title" style="color:white;">News and updates</h5>
            <p class="card-text" style="color:white;">Stay up to date with any patch notes, new content or other important updates.</p>
          </div>
        </div>
        <div class="card-transparent" style="width: 20rem;">
          <a href={{ route('Admin Blog Page') }}>
              <img class="card-img-top" src="{{asset('storage/image/blog.jpg')}}" alt="Card image cap">
          </a>
          <div class="card-body">
              <h5 class="card-title" style="color:white;">Community Blog</h5>
            <p class="card-text" style="color:white;">Interact and share your though about the game with the Tokotoko community!</p>
          </div>
        </div>
      </div>
  </div>
@endsection
