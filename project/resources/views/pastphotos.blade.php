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
			  	<img class="img-thumbnail" src="{!!$image!!}">
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
									<img src="{!!$imgArray[$i]!!}" alt="pastevent">
								</div>
							@else
								<div class="item"> 
									<img src="{!!$imgArray[$i]!!}" alt="pastevent">
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

    <iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2FGoMonsta%2Fvideos%2F1974826629405407%2F&show_text=0&width=560" width="530" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true"></iframe>
    <br>
    <iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2FGoMonsta%2Fvideos%2F1955773327977404%2F&show_text=0&width=560" width="530" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true"></iframe>
</div>

@include('footer')
@stop