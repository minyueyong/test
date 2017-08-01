<title>Gallery</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"> 
<style>
	.carousel-inner > .item > img,
    .carousel-inner > .item > a > img 
    {
        width: 65%;
        height: 55%;
        margin: auto;
    }
</style>

<div class = "container">
    <div class = "page-header">
        <h3 class = "text-uppercase">Gallery</h3>
    </div>

    <div class="embed-responsive embed-responsive-16by9">
       	<iframe class = "embed-responsive-item" src="https://www.youtube.com/embed/EgMXxK4MtPM" allowfullscreen></iframe>
    </div>

    <div class = "page-header">
    </div>

    <ul class="list-inline">
		<li data-toggle="modal" data-target="#myModal">
			<a href="#myGallery" data-slide-to="0" id="thumbnail">
			  	<img class="img-thumbnail" src="/images/event1.jpg">
			  	<br>
			</a>
		</li>
		<li data-toggle="modal" data-target="#myModal">
			<a href="#myGallery" data-slide-to="1" id="thumbnail">
			  	<img class="img-thumbnail" src="/images/event2.jpg">
			  	<br>
			</a>
		</li>
		<li data-toggle="modal" data-target="#myModal">
			<a href="#myGallery" data-slide-to="2" id="thumbnail">
			  	<img class="img-thumbnail" src="/images/event3.jpg">
			  	<br>
			</a>
		</li>
		<li data-toggle="modal" data-target="#myModal">
			<a href="#myGallery" data-slide-to="3" id="thumbnail">
			  	<img class="img-thumbnail" src="/images/event4.jpg">
			  	<br>
			</a>
		</li>
		<li data-toggle="modal" data-target="#myModal">
			<a href="#myGallery" data-slide-to="4" id="thumbnail">
			  	<img class="img-thumbnail" src="/images/event5.jpg">
			  	<br>
			</a>
		</li>
		<li data-toggle="modal" data-target="#myModal">
			<a href="#myGallery" data-slide-to="5" id="thumbnail">
			  	<img class="img-thumbnail" src="/images/event6.jpg">
			  	<br>
			</a>
		</li>
	<!--end of thumbnails-->
	</ul>

	<!--begin modal window-->
	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<div class="pull-left">Gallery</div>
						<button type="button" class="close" data-dismiss="modal" title="Close"> <span class="glyphicon glyphicon-remove"></span></button>
				</div>
			<div class="modal-body">
				<!--begin carousel-->
				<div id="myGallery" class="carousel slide" data-interval="false">
					<div class="carousel-inner">
						<div class="item active"> 
							<img src="/images/event1.jpg" alt="event1">
						</div>
						<div class="item"> 
							<img src="/images/event2.jpg" alt="event2">
						</div>
						<div class="item"> 
							<img src="/images/event3.jpg" alt="event3">
						</div>
						<div class="item"> 
							<img src="/images/event4.jpg" alt="event4">
						</div>
						<div class="item"> 
							<img src="/images/event5.jpg" alt="event5">
						</div>
						<div class="item"> 
							<img src="/images/event6.jpg" alt="event6">
						</div>
					<!--end carousel-inner-->
					</div>
					<!--Begin Previous and Next buttons-->
					<a class="left carousel-control" href="#myGallery" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span></a>
					<a class="right carousel-control" href="#myGallery" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span></a>
					<!--end carousel-->
				</div>
			<!--end modal-body-->
			</div>
				<div class="modal-footer">
					<button class="btn-sm close" type="button" data-dismiss="modal">
						Close
					</button>
				<!--end modal-footer-->
				</div>
			<!--end modal-content-->
			</div>
		<!--end modal-dialoge-->
		</div>
	<!--end myModal-->>
	</div>
</div>

@include('footer')
@stop