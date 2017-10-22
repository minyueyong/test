<title>Dashboard</title>
@extends('header')
@section('content')

<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/>
<style>
	.containerfluid1
	{
		padding: 60px;
		margin-left : 2cm;
	}

	.containerfluid2
	{
		padding: 60px;
		margin-left : -1cm;
	}

	.containerfluid3
	{
	    padding : 80px;
	    margin-left : -1cm;
	}

	.containerfluid3 h3
	{
		text-align: center;
	}

	h2,
	h3
	{
		font-family:Georgia;
		color: cornflowerblue; 
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

@if (Auth::user()->role === 1)
<div class = "containerfluid1" >
	<div class="row row-offcanvas row-offcanvas-right">
		<div class="col-xs-12 col-sm-9 col-sm-push-3">
			<button type="button" class="pull-left btn btn-default visible-xs" data-toggle="offcanvas" aria-expanded="false" aria-controls="navbar">
				<i class="fa fa-navicon"></i>
			</button>

			<div class="table-responsive col-xs-4 col-sm-10">
				<table class="table table-condensed table-bordered">
						<div class="row" id = "demo1" class = "collapse" >
							<div class="col-xs-6 col-sm-6">
								<div>
									<h2  style="font-size:2vw;"><u>Community Stats</u></h2>
									<div style="font-size:1.5vw;"><b>Status:</b> {!!$results[0]->status!!}</div>
									<div style="font-size:1.5vw;"><b>Experience:</b> {!!$results[0]->experience!!}</div>
									<div style="font-size:1.5vw;"><b>Campus:</b> {!!$results[0]->campus!!} University </div>
									<div style="font-size:1.5vw;"><b>Education:</b> Bachelor of {!!$results[0]->education!!} </div>
									<div style="font-size:1.5vw;"><b>Area of Interest:</b> {!!$results[0]->interest!!} </div>
									<div style="font-size:1.5vw;"><b>Birthday:</b> {!!$results[0]->dob!!} </div>
									<div style="font-size:1.5vw;"><b>Gender:</b> {!!$results[0]->gender!!} </div>
								</div>
							</div><!--/.col-xs-6.col-sm-6-->

							<div class="col-xs-6 col-sm-6">
								<div style="font-size:18px">
									<h2 style="font-size:2vw;"><u>Contact Information</u></h2>
									<div style="font-size:1.5vw;"><b>Email:</b> {!!$results[0]->email!!} </div>
									<div style="font-size:1.5vw;"><b>Phone:</b> +60{!!$results[0]->phone!!} </div>
								</div>
							</div><!--/.col-xs-6.col-lg-4-->

							<div class="col-xs-6 col-sm-6">
								<div style="font-size:18px">
									<h2 style="font-size:2vw;"><u>About Me</u></h2>
									<div style="font-size:1.5vw;"><b> @php echo nl2br($results[0]->aboutme); @endphp</b> </div>
								</div>
							</div><!--/.col-xs-6.col-lg-4-->

						</div><!--/row-->
				</table>
			</div>

			<div class="table-responsive col-xs-6 col-sm-10" >
				<table class="table table-condensed table-bordered">
					<div class="row" id = "demo2" class = "collapse" hidden>
						<div class="col-xs-6 col-sm-6">
							<div style="font-size:18px">
								<h2 style="font-size:2vw;"><u>Participated Activities</u></h2>
								<div style="font-size:1.5vw;"><b>
									@php 
										$events = DB::table('studentsnevents')->where('studentid', $results[0]->studentid)->pluck('eventid');
									@endphp
					
									@foreach($events as $event)
										@php 
											$currentDate = date('Y-m-d');
											$eventDate = DB::table('events')->where('eventid', $event)->value('eventDate');
											$eventName = DB::table('events')->where('eventid', $event)->value('eventName');
											$studentParticipate = DB::table('studentsnevents')->where('studentid',$results[0]->studentid)->where(DB::raw('eventid'), $event)->value('participate');
										@endphp
									<div style="font-size:2vw;">
										@if($eventDate < $currentDate && $studentParticipate == 1)
											{!!$eventDate!!}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!!$eventName!!}
										@endif
									</div>
									@endforeach</b>
								</div>
							</div>
						</div><!--/.col-xs-6.col-sm-6-->

						<div class="col-xs-6 col-sm-6">
							<div style="font-size:18px" >
								<h2 style="font-size:2vw;"><u>Upcoming Activities</u></h2>
									<div style="font-size:1.2vw;"><b>
										@php 
											$events = DB::table('studentsnevents')->where('studentid', $results[0]->studentid)->pluck('eventid');
										@endphp

										@foreach($events as $event)
											@php 
												$currentDate = date('Y-m-d');
												$eventDate = DB::table('events')->where('eventid', $event)->value('eventDate');
												$eventName = DB::table('events')->where('eventid', $event)->value('eventName');
											@endphp
										<div style="font-size:1.3vw;">
											@if($eventDate >= $currentDate)
												<a href="{{ url('viewevent/'.$event) }}" id="thumbnail">{!!$eventName!!}</a>
											@endif
										</div>
										@endforeach</b>
									</div>
							</div>
						</div><!--/.col-xs-6.col-sm-6-->
					</div><!--/row-->
				</table>
		  	</div>
		</div><!--col-xs-12 col-sm-9 col-sm-push-3 -->

		
		<div class="col-xs-12 col-sm-3 col-sm-pull-10 sidebar-offcanvas" id="sidebar"  >
			<table>
				<tr>
					<td rowspan="2">
						<img src = "{!!$results[0]->image!!}" alt="profilepic" class="img-circle img-responsive"/>
					</td>
					<td>
						<h3 style="font-weight: bold" style="font-size:2vw; padding-left:20px;" >{!!$results[0]->firstName!!} {!!$results[0]->lastName!!}</h3>
					</td>
				</tr>

				<tr>
					<td>
						<h4 style="font-weight:bold" style="font-size:2vw;">Member since {!!Auth::user()->created_at!!}</h4>
					</td>
				</tr>
			</table>
			<br>
			<div class= "list-group-item" style="font-size:2vw;">
				<button class = "btn btn-default navbar-btn" data-toggle="collapse" onclick="toggleVisibility('demo1');">Profile</button>
			</div>

			<div class= "list-group-item" style="font-size:2vw;">
				<button class = "btn btn-default navbar-btn" data-toggle="collapse" onclick="toggleVisibility('demo2');">Activities Review</button>
			</div>
	  </div><!--/.sidebar-offcanvas-->
	</div><!--rowoffcanvas -->
</div><!--containerfluid -->
<!-- role1 -->

@elseif (Auth::user()->role === 2)
	@if ($results[0]->companyApproval === 1)
		<div class="containerfluid2" >
			<div class="row row-offcanvas row-offcanvas-right">
				<div class="col-xs-12 col-sm-9 col-sm-push-3">
					<button type="button" class="pull-left btn btn-default visible-xs" data-toggle="offcanvas" aria-expanded="false" aria-controls="navbar">
					</button>

					<div class="agenda" class="row"  class = "collapse">
						<div class="table-responsive col-xs-6 col-sm-9">
							<table class="table table-condensed table-bordered"  >
								<thead>
									<tr>
										<th><button type = "button" class = "btn btn-default navbar-btn login-btn" onclick="window.location ='{{ url("/postevent")}}'" style="font-size:1vw;"><b>Create New Activity</b></button></th>
										<th><button type = "button" class = "btn btn-default navbar-btn login-btn" onclick="toggleVisibility('demo2');" style="font-size:1vw;"><b>View Past Activities</b></button></th>
										<th><button type = "button" class = "btn btn-default navbar-btn login-btn" onclick="toggleVisibility('demo3');" style="font-size:1vw;"><b>View Upcoming Activities</b></button></th>
									</tr>
								</thead>
							</table>   
							
						</div>
						
						<div class="row col-xs-6 col-sm-3">  
							<table class="table table-condensed table-bordered" style="font-size:1.2vw;">
								<thead>
									<tr>
										<thead>
											<tr>
												<th>Status : {!!$results[0]->status!!} </th>
											</tr>
											<tr>
												<th>Expired : {!!$results[0]->membershipDate!!} </th>
											</tr>
										</thead>
									</tr>
								</thead>
							</table>
						</div>
					</div><!--agenda -->

					<div class="row" id = "demo1" class = "collapse">
						<div class="col-xs-6 col-sm-6">
							<div style="font-size:18px">
								<h2 style="font-size:2vw;"><u>Contact Information</u></h2>
								<div style="font-size:1.5vw;">Email: {!!$results[0]->email!!} </div>
								<div style="font-size:1.5vw;">Phone: +60{!!$results[0]->phone!!} </div>
								<div style="font-size:1.5vw;">Area of Interest: {!!$results[0]->interest!!} </div>
							</div>
						</div><!--/.col-xs-6.col-sm-6-->

						<div class="col-xs-6 col-sm-6">
							<div style="font-size:18px">
								<h2 style="font-size:2vw;"><u>About Company</u></h2>
								<div style="font-size:1.5vw;"> @php echo nl2br($results[0]->aboutcompany); @endphp </div>
							</div>
						</div><!--/.col-xs-6.col-sm-6-->
					</div>

					<div class="row"  class = "collapse"  >
						<div class="col-xs-6 col-sm-12">
							<div style="font-size:18px" id = "demo3" hidden>
								<h2 align ="center" style="font-size:2vw;"><u>Upcoming Activities</u></h2><br>
								<div >
									<table>
										@php 
											$userid = Auth::user()->id;
											$companyid = DB::table('companies')->where('companies.userid','=',$userid)->value('companies.companyid');
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
														<img src ="{!!$event->eventImage!!}" class="img-thumbnail"  width ="350" height = "350" alt="eventImage" style="float:left, display:inline">
													</a>
													<br>
													<b>{!!$event->eventDate!!}</b>
												</td>
											@endif
										@endforeach
									</table>
								</div>
							</div>
						</div><!--/.col-xs-6.col-sm-6-->

						<div class="col-xs-6 col-sm-7" >
						<div style="font-size:18px" id="demo2" hidden>
								<h2 style="font-size:2vw;"><u>Past Activities</u></h2><br>
								<div>
									@php 
										$userid = Auth::user()->id;
										$companyid = DB::table('companies')->where('companies.userid','=',$userid)->value('companies.companyid');
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
						</div><!--/.col-xs-6.col-sm-6-->
					</div><!-- row -->

					<div class="row" id = "demo2" class = "collapse">
					</div>
				</div> <!--xs-12 -->
					
				<div class="col-xs-6 col-sm-3 col-sm-pull-9 sidebar-offcanvas" id="sidebar">
					<table style="font-size:1.5vw;">
						<tr>
							<td rowspan="2">
								<img src = "{!!$results[0]->image!!}" alt="profilepic" class="img-circle img-responsive"/>
							</td>
							<td>
								<h3 style="font-weight: bold">{!!$results[0]->companyName!!}</h3>
							</td>
						</tr>

						<tr>
							<td>
								<h4 style="font-weight:bold">Member since {!!Auth::user()->created_at!!}</h4>
							</td>
						</tr>
					</table>
					
					<br>
					<div class= "list-group-item" style="font-size:1.5vw;">
						<button class = "btn btn-default navbar-btn" data-toggle="collapse" onclick="toggleVisibility('demo1');">Dashboard</button>
					</div>

					<div class= "list-group-item" style="font-size:1.5vw;">
						<button class = "btn btn-default navbar-btn" data-toggle="collapse" onclick="toggleVisibility('demo4');">Analytics</button>
					</div>
				</div><!--/.sidebar-offcanvas-->
				
				@else
				<h3 class ="text-uppercase" style="font-weight:bold">Still waiting for approval from admin</h3>
				@endif
			</div><!-- xs-12 -->
		</div><!-- row -->
	</div><!-- container -->
</div>
<!-- role2 -->

@elseif (Auth::user()->role === 3)
<div class="containerfluid3">
    <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9 col-sm-push-3">
            <button type="button" class="pull-left btn btn-default visible-xs" data-toggle="offcanvas" aria-expanded="false" aria-controls="navbar">
            </button>

			<div class="row"  class = "collapse" id ="demo1">
				<div class="table-responsive col-xs-6 col-sm-10" align = "center">
					<h3 class ="text-uppercase" style="font-weight:bold; font-size:2vw "><u>Waiting for Approval Company</u></h3><br>
					<table class="table table-condensed table-bordered" style="font-size:1.5vw;">
						@php
							$companies = DB::table('companies')->where('companyApproval',0)->pluck('companyid');
						@endphp
						<thead>
							<tr>
								<th>Check Box</th>
								<th>Company Name</th>
								<th>Email</th>
							</tr>
						</thead>

						<tbody>
							@foreach($companies as $company)
								@php
									$companyName = DB::table('companies')->where('companyid', $company)->value('companyName');
									$companyUserId = DB::table('companies')->where('companyid', $company)->value('userid');
									$companyApproval = DB::table('companies')->where('companyid',$company)->value('companyApproval');
									$companyEmail = DB::table('users')->where('id',$companyUserId)->value('email');
								@endphp

								@if ($companyApproval === 0)
									<tr>
										<form action="/checkcompanyapproval" method="post" enctype="multipart/form-data">
											<input type = "hidden" name = "_token" value = "<?php echo csrf_token();?>">
											<td><input name="company[]" type="checkbox" value="{!!$company!!}"></td>
											<td>{!!$companyName!!}</td>
											<td>{!!$companyEmail!!}</td>
									</tr>
								@endif
							@endforeach
						</tbody>
					</table>
						<br><input type="submit" name="checkCompany" class = "btn btn-default login-btn" value="Approve">						
				</div>	
			</div><!--row -->

			<div class="row"  class = "collapse" id ="demo2" hidden>
				<div class="table-responsive col-xs-6 col-sm-10" align = "center">
					<h3 class ="text-uppercase" style="font-weight:bold; font-size:2vw "><u>Waiting for Approval Events</u></h3><br>
						<table class="table table-condensed table-bordered" style="font-size:1.5vw;">
							@php
								$events = DB::table('events')->where('eventApproval',0)->pluck('eventid');
							@endphp
								<thead>
									<tr>
										<th>Check Box</th>
										<th>Event Name</th>
										<th>Organizer</th>
										<th>Date</th>
										<th>Venue</th>
									</tr>
								</thead>

								<tbody>
									@foreach($events as $event)
										@php
											$eventName = DB::table('events')->where('eventid', $event)->value('eventName');
											$eventDate = DB::table('events')->where('eventid', $event)->value('eventDate');
											$eventVenue = DB::table('events')->where('eventid', $event)->value('eventVenue'); 
											$companyid = DB::table('events')->where('eventid',$event)->value('companyid');
											$companyName = DB::table('companies')->where('companyid',$companyid)->value('companyName');
										@endphp
				
									<tr>
										<form action="/checkeventapproval" method="post" enctype="multipart/form-data">
										<input type = "hidden" name = "_token" value = "<?php echo csrf_token();?>">
										<td><input name="event[]" type="checkbox" value="{!!$event!!}"></td>
										<td>{!!$eventName!!}</td>
										<td>{!!$companyName!!}</td>
										<td>{!!$eventDate!!}</td>
										<td>{!!$eventVenue!!}</td>
									</tr>
									@endforeach
							</tbody>
						</table>
							<br><input type="submit" name="checkEvent" class = "btn btn-default login-btn" value="Approve" />				
				</div>	
			</div><!--row -->

			<div class="row"  class = "collapse" id ="demo3" hidden>
				<div class="table-responsive col-xs-6 col-sm-10">
					<h3 class ="text-uppercase" style="font-weight:bold "><u>All Events Statistics</u></h3><br>
						<table class="table table-condensed table-bordered" style="font-size:1.5vw;">
							@php
								$eventsStats = DB::table('events')->where('eventApproval',1)->pluck('eventid');
							@endphp
								<thead>
									<tr>
										<th>Event Name</th>
										<th>Organizer</th>
										<th>Date</th>
										<th>Venue</th>
										<th>Total Student</th>
									</tr>
								</thead>

								<tbody>
									@foreach($eventsStats as $eventStat)
										@php
											$eventSName = DB::table('events')->where('eventid', $eventStat)->value('eventName');
											$eventSDate = DB::table('events')->where('eventid', $eventStat)->value('eventDate');
											$eventSVenue = DB::table('events')->where('eventid', $eventStat)->value('eventVenue'); 
											$totalRegistered = DB::table('studentsnevents')->where('eventid',$eventStat)->count('studentid');
											$companySid = DB::table('events')->where('eventid',$eventStat)->value('companyid');
											$companySName = DB::table('companies')->where('companyid',$companySid)->value('companyName');
										@endphp
				
									<tr>
										<td>{!!$eventSName!!}</td>
										<td>{!!$companySName!!}</td>
										<td>{!!$eventSDate!!}</td>
										<td>{!!$eventSVenue!!}</td>
										<td><a href="/viewevent/{!!$eventStat!!}/participantdetails" id="totalRegisterDetails">{!!$totalRegistered!!}</a></td>
									</tr>
									@endforeach
								</tbody>
					</table>	
				</div>	
			</div><!--row -->

			<div class="row"  class = "collapse" id ="demo4" hidden>
				<div class="table-responsive col-xs-6 col-sm-10">
					<h3 class ="text-uppercase" style="font-weight:bold "><u>Analytics Review</u></h3><br>
						<table class="table table-condensed table-bordered" style="font-size:1.5vw;">
								<thead>
									<tr>
										<th>Total Students Registered</th>
										<th>Total Companies Registered</th>
										<th>Total Events Posted</th>
									</tr>
								</thead>

								<tbody>				
									<tr>
										<td></td>
										<td></td>
										<td></td>
									</tr>
							</tbody>
						</table>	
				</div>	
			</div><!--row -->
		</div><!-- xs12 -->

		<div class="col-xs-6 col-sm-3 col-sm-pull-9 sidebar-offcanvas" id="sidebar">
			<div class= "list-group-item">
				<button class = "btn btn-default navbar-btn" data-toggle="collapse" onclick="toggleVisibility('demo1');" >Company Approval</button>
			</div>

			<div class= "list-group-item" >
				<button class = "btn btn-default navbar-btn" data-toggle="collapse" onclick="toggleVisibility('demo2');" >Events Approval</button>
			</div>

			<div class= "list-group-item">
				<button class = "btn btn-default navbar-btn" data-toggle="collapse" onclick="toggleVisibility('demo3');" >View Events Statistics</button>
			</div>

			<div class= "list-group-item">
				<button class = "btn btn-default navbar-btn" data-toggle="collapse" onclick="toggleVisibility('demo4');" >Analytics Review</button>
			</div>
		</div><!--/.sidebar-offcanvas-->
	</div>
</div>
<!-- role3 -->
@endif

@include('footer')
@stop