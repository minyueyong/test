<title>Events</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"> 
<style>
	.carousel-inner > .item > img,
    .carousel-inner > .item > a > img 
    {
        width: 65%;
        height: 45%;
        margin: auto;
    }	
</style>

<div class = "container">
    <div class = "page-header">
        <h3 class = "text-uppercase">Events</h3>
    </div>
    
    <ul class="list-inline">
	  	<li data-toggle="modal" data-target="#myModal">
		  	<a href="#myGallery" data-slide-to="0" id="thumbnail">
		  		<img class="img-thumbnail" src="/images/featuredevent1.jpg">
		  		<br>
				Featured Event 1
			</a>
		</li>
	  	<li data-toggle="modal" data-target="#myModal">
		  	<a href="#myGallery" data-slide-to="1" id="thumbnail">
		  		<img class="img-thumbnail" src="/images/featuredevent2.jpg">
		  		<br>
				Featured Event 2
			</a>
		</li>
	<!--end of thumbnails-->
	</ul>

	<!--begin modal window-->
	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<div class="pull-left">Featured Event Gallery</div>
						<button type="button" class="close" data-dismiss="modal" title="Close"> <span class="glyphicon glyphicon-remove"></span></button>
				</div>
				<div class="modal-body">
					<!--begin carousel-->
					<div id="myGallery" class="carousel slide" data-interval="false">
						<div class="carousel-inner">
							<div class="item active"> 
								<img src="/images/featuredevent1.jpg" alt="featuredevent1">
								<div class="carousel-caption">
									<h3>Featured Event 1</h3>
									<p>Date: 27/5/17</p>
								</div>
							</div>
							<div class="item"> 
								<img src="/images/featuredevent2.jpg" alt="featuredevent2">
								<div class="carousel-caption">
									<h3>Featured Event 2</h3>
									<p>Date: 29/4/17</p>
								</div>
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