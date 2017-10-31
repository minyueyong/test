@php
	$companyName = DB::table('companies')->where('companyid',$companyid)->value('companyName');
	$phone = DB::table('companies')->where('companyid',$companyid)->value('phone');
	$image = DB::table('companies')->where('companyid',$companyid)->value('image');
	$aboutcompany = DB::table('companies')->where('companyid',$companyid)->value('aboutcompany');
	$interest = DB::table('companies')->where('companyid',$companyid)->value('interest');
	$status = DB::table('companies')->where('companyid',$companyid)->value('status');
	$membershipDate = DB::table('companies')->where('companyid',$companyid)->value('membershipDate');
@endphp

<title>Company Dashboard</title>
@extends('header')
@section('content')

<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/>
<style>
    .containerfluid
	{
		padding: 60px;
		margin-left : -1cm;
	}
</style>

<script>
	var divs = ["demo1", "demo2","demo3", "demo4"];
	var visibleDivId = null;

	function toggleVisibility(divId) 
	{
		if(visibleDivId === divId) 
		{
			//visibleDivId = null;
		} 
		else 
		{
			visibleDivId = divId;
		}
	 	hideNonVisibleDivs();
	}

	function hideNonVisibleDivs() 
	{
		var i, divId, div;
		for(i = 0; i < divs.length; i++) 
		{
			divId = divs[i];
			div = document.getElementById(divId);
			if(visibleDivId === divId) 
			{
				div.style.display = "block";
			} 
			else 
			{
				div.style.display = "none";
			}
		}
	}
</script>

<div class="containerfluid">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3">
			<div class="row" class = "collapse">
				<div class="col-sm-9">
					<table class="table-responsive table-condensed table-bordered">
						<thead>
							<tr>
								@php
									$totalEvent = DB::table('events')->where('companyid',$companyid)->count('eventid');
								@endphp

								<th><button type = "button" class = "btn btn-default navbar-btn login-btn" onclick="toggleVisibility('demo2');" style="font-size:1vw;"><b>View Past Activities</b></button></th>
								<th><button type = "button" class = "btn btn-default navbar-btn login-btn" onclick="toggleVisibility('demo3');" style="font-size:1vw;"><b>View Upcoming Activities</b></button></th>
							</tr>
						</thead>
					</table>   
				</div>
						
				<div class="row col-sm-3">  
					<table class="table table-condensed table-bordered" style="font-size:1.2vw;">
						<thead>
							<tr>
								<thead>
									<tr>
										<th>Status: {!!$status!!} </th>
									</tr>
									<tr>
										<th>Expired: {!!$membershipDate!!} </th>
									</tr>
								</thead>
							</tr>
						</thead>
					</table>
				</div>
			</div>

			<div class="row" id = "demo1" class = "collapse">
				<div class="col-sm-6">
					<div style="font-size:18px">
						@php 
							$userid = DB::table('companies')->where('companies.companyid','=',$companyid)->value('companies.userid');
							$email = DB::table('users')->where('id',$userid)->value('email');
						@endphp
						<h2 style="font-size:2vw;font-family:Georgia;
						color: #FF7171;"><u>Contact Information</u></h2>
							<div style="font-size:1.5vw;">Email: {!!$email!!} </div>
							<div style="font-size:1.5vw;">Phone: +60{!!$phone!!} </div>
							<div style="font-size:1.5vw;">Area of Interest: {!!$interest!!} </div>
					</div>
				</div>

				<div class="col-sm-6">
					<div style="font-size:18px">
						<h2 style="font-size:2vw; font-family:Georgia;color: #FF7171;"><u>About Company</u></h2>
							<div style="font-size:1.5vw;"> @php echo nl2br($aboutcompany); @endphp </div>
					</div>
				</div>
			</div>

			<div class="row"  class = "collapse">
				<div class="col-sm-12">
					<div style="font-size:18px" id = "demo3" hidden>
						<h2 style="font-size:2vw; font-family:Georgia; color: #FF7171;"><u>Upcoming Activities</u></h2><br>
							<div>
								<table>
									@php 
										$userid = DB::table('companies')->where('companies.companyid','=',$companyid)->value('companies.userid');
										$events = DB::table('events')->where('events.companyid','=',$companyid)->get();
									@endphp
						
									@foreach($events as $event)
										@php
											$date = date('Y-m-d');
										@endphp
										@if($event->eventDate >= $date && $event->eventApproval === 1)
											<td align="center" style = " vertical-align:bottom;">
												<b>{{$event->eventName}}</b>
												<br>
												<a id = "viewevent" href="{{ url('viewevent/'.$event->eventid) }}">
													<img src ="{!!$event->eventImage!!}" class="img-thumbnail img-responsive"  width ="350" height = "350" alt="eventImage" style="float:left, display:inline">
												</a>
												<br>
												<b>{!!$event->eventDate!!}</b>
											</td>
										@endif
									@endforeach
								</table>
							</div>
						</div>
					</div>

					<div class="col-sm-7">
						<div style="font-size:18px" id="demo2" hidden>
						<h2 style="font-size:2vw; font-family:Georgia; color: #FF7171;"><u>Past Activities</u></h2><br>
							<div>
								@php 
									$userid = DB::table('companies')->where('companies.companyid','=',$companyid)->value('companies.userid');
									$events = DB::table('events')->where('events.companyid','=',$companyid)->get();
								@endphp
					
								@foreach($events as $event)
									@php
										$date = date('Y-m-d');
									@endphp
									@if($event->eventDate < $date && $event->eventApproval === 1)
										{{$event->eventDate}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$event->eventName}} <br>
									@endif
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div> 
					
			<div class="col-sm-3 col-sm-pull-9 sidebar-offcanvas" id="sidebar">
				<table style="font-size:1.5vw;">
					<tr>
						<td rowspan="2">
							<img src = "{!!$image!!}" alt="profilepic" class="img-circle img-responsive"/>
						</td>
						<td>
							<h3 style="font-weight: bold; font-family:Georgia; color: #FF7171;">{!!$companyName!!}</h3>
						</td>
					</tr>

					<tr>
						<td>
							@php 
								$userid = DB::table('companies')->where('companies.companyid','=',$companyid)->value('companies.userid');
								$created_at = DB::table('users')->where('id','=',$userid)->value('created_at');
							@endphp
							<h4 style="font-weight:bold">Member since {!!$created_at!!}</h4>
						</td>
					</tr>
				</table>
					
				<br>
				<div class= "list-group-item" style="font-size:1.5vw;">
					<button class = "btn btn-default navbar-btn" data-toggle="collapse" onclick="toggleVisibility('demo1');">Dashboard</button>
				</div>
			</div><!--/.sidebar-offcanvas-->
		</div>
</div>
@include('footer')
@stop