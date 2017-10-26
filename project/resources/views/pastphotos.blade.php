@php 
        $name = DB::table('events')->where('eventid', $id)->value('eventName');
		$imagesid = DB::table('eventsnimages')->where('eventid',$id)->pluck('imageid');
		$imgArray = [];
		$count = -1;
@endphp

<title>Gallery for {!!$name!!}</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 

<div class = "container">
	<div class = "page-header">
       	<h3 class = "text-uppercase">Photos of {!!$name!!}</h3>
    </div>

    <ul class="list-inline">
    	@foreach($imagesid as $imageid)
    		@php
		  		$image = DB::table('images')->where('imageid',$imageid)->value('image');
		  		$count = $count + 1;
    		@endphp
		<li data-toggle="modal" data-target="#myModal">
			<a href="#myGallery" data-slide-to="0" id="thumbnail">
			  	<img class="img-thumbnail img-responsive" src="{!!$image!!}">
			  	<br>
			</a>

			@php
				$imgArray[$count] = $image; 
			@endphp
		</li>
		@endforeach
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
						@for($i = 0; $i <= $count; $i++)
							@if ($i == 0)
								<div class="item active"> 
									<img class="img-responsive" src="{!!$imgArray[$i]!!}" alt="pastevent">
								</div>
							@else
								<div class="item"> 
									<img class="img-responsive" src="{!!$imgArray[$i]!!}" alt="pastevent">
								</div>
							@endif
						@endfor
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

	<div class = "page-header"></div>
    <h3 class = "text-uppercase">Video of {!!$name!!}</h3>
    <div class="embed-responsive embed-responsive-16by9">
    	<iframe width="560" height="315" src="https://www.youtube.com/embed/BkMtiRQ6hdU?rel=0" frameborder="0" allowfullscreen></iframe>
    </div>
</div>

@include('footer')
@stop