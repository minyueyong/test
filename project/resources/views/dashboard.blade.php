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
		color: #FF7171; 
	}

	#communitystats
	{
		margin-left: 220px;
	}

	#participatedactivities
	{
		margin-left: 1px;
	}

	#upcomingactiviteis
	{
		margin-left: 2cm;
	}

	#showupcomingactivities
	{
		margin-left: 1.8cm;
	}

	#vieweventlink:hover
	{
		color: black !important;
	}

	#vieweventlink:link, #vieweventlink:active, #vieweventlink:visited
	{
		color: red;
	}

	/* Smartphones (portrait) ----------- */
	@media only screen and (max-width : 480px)
	{
  		#communitystats
  		{
  			margin-left: 15px;
  		}

  		#activitiesreview
  		{
  			font-size: 3.5vw;
  		}
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
<div class = "containerfluid1">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3">
			<div class="table-responsive col-sm-10" id = "demo1">
				<table class="table table-condensed table-bordered">
						<div class="row"  class = "collapse" >
							<h2 style="font-size:2vw;" id="communitystats"><u>Community Stats</u></h2>
							<div class="col-sm-6">
								<div style = "margin-top:20px;">
									<div style="font-size:1.5vw;"><b>Status:</b> {!!$results[0]->status!!}</div>
									<div style="font-size:1.5vw;"><b>Experience:</b> {!!$results[0]->experience!!}</div>
									<div style="font-size:1.5vw;"><b>Campus:</b> {!!$results[0]->campus!!} University </div>
									<div style="font-size:1.5vw;"><b>Education:</b> Bachelor of {!!$results[0]->education!!} </div>
								</div>
							</div>

							<div class="col-sm-6">
								<div style = "margin-top:20px;">
									<div style="font-size:1.5vw;"><b>Area of Interest:</b> {!!$results[0]->interest!!} </div>
									<div style="font-size:1.5vw;"><b>Birthday:</b> {!!$results[0]->dob!!} </div>
									<div style="font-size:1.5vw;"><b>Gender:</b> {!!$results[0]->gender!!} </div>
								</div>
							</div>
						</div>

						<div class ="row" class= "collapse">
							<div class="col-sm-6" >
								<div style="font-size:18px" >
									<h2 style="font-size:2vw;"><u>Contact Information</u></h2>
									<div style="font-size:1.5vw;"><b>Email:</b> {!!$results[0]->email!!} </div>
									<div style="font-size:1.5vw;"><b>Phone:</b> +60{!!$results[0]->phone!!} </div>
								</div>
							</div>

							<div class="col-sm-6">
								<div style="font-size:18px">
									<h2 style="font-size:2vw;"><u>About Me</u></h2>
									<div style="font-size:1.5vw;"><b> @php echo nl2br($results[0]->aboutme); @endphp</b> </div>
								</div>
							</div>
						</div>

						<div class ="row" align="right">
							<a href="/editprofile" class="btn btn-default login-btn">Edit Profile</a>
						</div>
				</table>
			</div>

			<div class="table-responsive col-sm-10" >
				<table class="table table-condensed table-bordered">
					<div class="row" id = "demo2" class = "collapse" hidden>
						<div class="col-sm-6">
							<div style="font-size:18px">
								<h2 style="font-size:2vw;" id="participatedactivities"><u>Participated Activities</u></h2>
								<div style="font-size:1.5vw;"><b>
									@php 
										$events = DB::table('studentsnevents')->where('studentid', $results[0]->studentid)->pluck('eventid');
									@endphp

									<ul>
										@foreach($events as $event)
											@php 
												$currentDate = date('Y-m-d');
												$eventDate = DB::table('events')->where('eventid', $event)->value('eventDate');
												$eventName = DB::table('events')->where('eventid', $event)->value('eventName');
												$studentParticipate = DB::table('studentsnevents')->where('studentid',$results[0]->studentid)->where(DB::raw('eventid'), $event)->value('participate');
											@endphp
											<div style="font-size:1.2vw;">
												@if($eventDate < $currentDate && $studentParticipate == 1)
												<li>
													{!!$eventDate!!}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!!$eventName!!}
												</li>
												@endif
											</div>
										@endforeach</b>
									</ul>
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div style="font-size:18px" >
								<h2 style="font-size:2vw;" id ="upcomingactivities"><u>Upcoming Activities</u></h2>
									<div style="font-size:1.2vw;" id="showupcomingactivites"><b>
										@php 
											$events = DB::table('studentsnevents')->where('studentid', $results[0]->studentid)->pluck('eventid');
										@endphp

										<ul>
										@foreach($events as $event)
											@php 
												$currentDate = date('Y-m-d');
												$eventDate = DB::table('events')->where('eventid', $event)->value('eventDate');
												$eventName = DB::table('events')->where('eventid', $event)->value('eventName');
											@endphp
										<div style="font-size:1.2vw;">
											@if($eventDate >= $currentDate)
												<li>
													<a href="{{ url('viewevent/'.$event) }}" id="thumbnail">{!!$eventName!!}</a>
												</li>
											@endif
										</div>
										@endforeach</b>
										</ul>
									</div>
							</div>
						</div>
					</div>
				</table>
		  	</div>
		</div>

		<div class="col-sm-3 col-sm-pull-10 id="sidebar">
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
			<div class= "list-group-item">
				<button class = "btn btn-default navbar-btn" data-toggle="collapse" onclick="toggleVisibility('demo1');">Profile</button>
			</div>

			<div class= "list-group-item">
				<button class = "btn btn-default navbar-btn" data-toggle="collapse" onclick="toggleVisibility('demo2');" id="activitiesreview">Activities Review</button>
			</div>
	  </div>
	</div>
</div>
<!-- role1 -->

@elseif (Auth::user()->role === 2)
	@if ($results[0]->companyApproval === 1)
		<div class="containerfluid2">
			<div class="row">
				<div class="col-sm-9 col-sm-push-3">
					<div class="row" class = "collapse">
						<div class="col-sm-9">
							<table class="table-responsive table-condensed table-bordered">
								<thead>
									<tr>
										@php
											$totalEvent = DB::table('events')->where('companyid',$results[0]->companyid)->count('eventid');
										@endphp
										@if ($results[0]->status == "Basic")
											@if ($totalEvent < 1)
												<th><button type = "button" class = "btn btn-default navbar-btn login-btn" onclick="window.location ='{{ url("/postevent")}}'" style="font-size:1vw;"><b>Create New Activity</b></button></th>
											@endif
										@elseif ($results[0]->status == "Popular")
											@if ($totalEvent < 5)
												<th><button type = "button" class = "btn btn-default navbar-btn login-btn" onclick="window.location ='{{ url("/postevent")}}'" style="font-size:1vw;"><b>Create New Activity</b></button></th>
											@endif
										@elseif ($results[0]->status == "Epic")
											<th><button type = "button" class = "btn btn-default navbar-btn login-btn" onclick="window.location ='{{ url("/postevent")}}'" style="font-size:1vw;"><b>Create New Activity</b></button></th>
										@endif

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
												<th>Status: {!!$results[0]->status!!} </th>
											</tr>
											<tr>
												<th>Expired: {!!$results[0]->membershipDate!!} </th>
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
								<h2 style="font-size:2vw;"><u>Contact Information</u></h2>
								<div style="font-size:1.5vw;">Email: {!!$results[0]->email!!} </div>
								<div style="font-size:1.5vw;">Phone: +60{!!$results[0]->phone!!} </div>
								<div style="font-size:1.5vw;">Area of Interest: {!!$results[0]->interest!!} </div>
							</div>
						</div><!--/.col-xs-6.col-sm-6-->

						<div class="col-sm-6">
							<div style="font-size:18px">
								<h2 style="font-size:2vw;"><u>About Company</u></h2>
								<div style="font-size:1.5vw;"> @php echo nl2br($results[0]->aboutcompany); @endphp </div>
							</div>
						</div><!--/.col-xs-6.col-sm-6-->

					</div>

					<div class="row"  class = "collapse">
						<div class="col-sm-12">
							<div style="font-size:18px" id = "demo3" hidden>
								<h2 style="font-size:2vw;"><u>Upcoming Activities</u></h2><br>
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
						</div><!--/.col-xs-6.col-sm-6-->

						<div class="col-sm-7" >
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
				</div> <!--xs-12 -->
					
				<div class="col-sm-3 col-sm-pull-9 sidebar-offcanvas" id="sidebar">
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
						<button class = "btn btn-default navbar-btn" data-toggle="collapse" onclick="toggleVisibility('demo1');">Edit Profile</button>
					</div>

					<div class= "list-group-item" style="font-size:1.5vw;">
						<button class = "btn btn-default navbar-btn" data-toggle="collapse" onclick="toggleVisibility('demo1');">Upgrade Membership</button>
					</div>
				</div><!--/.sidebar-offcanvas-->
			</div>
		</div>
@else
	<div class = "container">
		<h3 class ="text-uppercase" style="font-weight:bold">Still waiting for approval from admin</h3>
	</div>
@endif

@elseif (Auth::user()->role === 3)
<div class="containerfluid3">
    <div class="row">
        <div class="col-sm-9 col-sm-push-3">
			<div class="row"  class = "collapse" id ="demo1">
				<div class="table-responsive col-sm-10" align = "center">
					<h3 class ="text-uppercase" style="font-weight:bold; font-size:2vw "><u>Waiting for Approval Company</u></h3><br>
					<table class="table-responsive table-condensed table-bordered" style="font-size:1.5vw;">
						@php
							$companies = DB::table('companies')->where('companyApproval',0)->pluck('companyid');
						@endphp
						<thead>
							<tr>
								<th>Check Box</th>
								<th>Company Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Status</th>
								<th>Created at</th>
							</tr>
						</thead>

						<tbody>
							@foreach($companies as $company)
								@php
									$companyName = DB::table('companies')->where('companyid', $company)->value('companyName');
									$companyUserId = DB::table('companies')->where('companyid', $company)->value('userid');
									$companyApproval = DB::table('companies')->where('companyid',$company)->value('companyApproval');
									$companyEmail = DB::table('users')->where('id',$companyUserId)->value('email');
									$companyPhone = DB::table('companies')->where('companyid',$company)->value('phone');
									$companyStatus = DB::table('companies')->where('companyid',$company)->value('status');
									$companyCreatedAt = DB::table('users')->where('id',$companyUserId)->value('created_at');
								@endphp

								@if ($companyApproval === 0)
									<tr>
										<form action="/checkcompanyapproval" method="post" enctype="multipart/form-data">
											<input type = "hidden" name = "_token" value = "<?php echo csrf_token();?>">
											<td><input name="company[]" type="checkbox" value="{!!$company!!}"></td>
											<td>{!!$companyName!!}</td>
											<td>{!!$companyEmail!!}</td>
											<td>{!!$companyPhone!!}</td>
											<td>{!!$companyStatus!!}</td>
											<td>{!!$companyCreatedAt!!}</td>
									</tr>
								@endif
							@endforeach
						</tbody>
					</table>
						<br><input type="submit" name="checkCompany" class = "btn btn-default login-btn" value="Approve">
						<input type="submit" name="checkEvent" class = "btn btn-default login-btn" value="Deny"/>	
						</form>					
				</div>	
			</div><!--row -->

			<div class="row" class = "collapse" id ="demo2" hidden>
				<div class="table-responsive col-sm-10" align = "center">
					<h3 class ="text-uppercase" style="font-weight:bold; font-size:2vw"><u>Waiting for Approval Activities</u></h3><br>
						<table class="table-responsive table-condensed table-bordered" style="font-size:1.5vw;">
							@php
								$events = DB::table('events')->where('eventApproval',0)->pluck('eventid');
							@endphp
								<thead>
									<tr>
										<th>Check Box</th>
										<th>Activity Name</th>
										<th>Organizer</th>
										<th>Date</th>
										<th>Venue</th>
										<th>Seats Available</th>
									</tr>
								</thead>

								<tbody>
									@foreach($events as $event)
										@php
											$eventName = DB::table('events')->where('eventid', $event)->value('eventName');
											$eventDate = DB::table('events')->where('eventid', $event)->value('eventDate');
											$eventVenue = DB::table('events')->where('eventid', $event)->value('eventVenue'); 
											$eventSeats = DB::table('events')->where('eventid', $event)->value('eventSeats'); 
											$companyid = DB::table('events')->where('eventid',$event)->value('companyid');
											$companyName = DB::table('companies')->where('companyid',$companyid)->value('companyName');
										@endphp
				
									<tr>
										<form action="/checkeventapproval" method="post" enctype="multipart/form-data">
										<input type = "hidden" name = "_token" value = "<?php echo csrf_token();?>">
										<td><input name="event[]" type="checkbox" value="{!!$event!!}"></td>
										<td><a id = "vieweventlink" href="{{ url('viewevent/'.$event) }}">{!!$eventName!!}</a></td>
										<td>{!!$companyName!!}</td>
										<td>{!!$eventDate!!}</td>
										<td>{!!$eventVenue!!}</td>
										<td>{!!$eventSeats!!}</td>
									</tr>
									@endforeach
							</tbody>
						</table>
						<br><input type="submit" name="checkEvent" class = "btn btn-default login-btn" value="Approve"/>
						<input type="submit" name="checkEvent" class = "btn btn-default login-btn" value="Deny"/>		
						</form>		
				</div>	
			</div><!--row -->

			<div class="row"  class = "collapse" id ="demo3" hidden>
				<div class="table-responsive col-sm-10" align="center">
					<h3 class ="text-uppercase" style="font-weight:bold; font-size:2vw"><u>All Activities Statistics</u></h3><br>
						<table class="table-responsive table-condensed table-bordered" style="font-size:1.3vw;">
							@php
								$eventsStats = DB::table('events')->where('eventApproval',1)->pluck('eventid');
							@endphp
								<thead>
									<tr>
										<th>Activity Name</th>
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
				<div class="table-responsive col-sm-10" align="center">
					<h3 class ="text-uppercase" style="font-weight:bold;font-size:2vw"><u>Analytics Review</u></h3><br>
						@php
							$totalStudents = DB::table('students')->count('studentid');
							$totalCompanies = DB::table('companies')->count('companyid');
							$totalEvents = DB::table('events')->count('eventid');
						@endphp
						<table class="table-responsive table-condensed table-bordered" style="font-size:1.5vw;">
								<thead>
									<tr>
										<th>Total Students Registered</th>
										<th>Total Companies Registered</th>
										<th>Total Activities Posted</th>
									</tr>
								</thead>

								<tbody>				
									<tr>
										<td><a href="/totalstudentsdetails" id="totalStudentsDetails">{!!$totalStudents!!}</a></td>
										<td><a href="/totalcompaniesdetails" id="totalCompaniesDetails">{!!$totalCompanies!!}</a></td>
										<td><a href="/totaleventsdetails" id="totalEventsDetails">{!!$totalEvents!!}</a></td>
									</tr>
							</tbody>
						</table>	
				</div>	
			</div><!--row -->
		</div><!-- xs12 -->

		<div class="col-sm-3 col-sm-pull-9 sidebar-offcanvas" id="sidebar">
			<div class= "list-group-item">
				<button class = "btn btn-default navbar-btn" data-toggle="collapse" onclick="toggleVisibility('demo1');">Company Approval</button>
			</div>

			<div class= "list-group-item" >
				<button class = "btn btn-default navbar-btn" data-toggle="collapse" onclick="toggleVisibility('demo2');">Activities Approval</button>
			</div>

			<div class= "list-group-item">
				<button class = "btn btn-default navbar-btn" data-toggle="collapse" onclick="toggleVisibility('demo3');">Activities Statistics</button>
			</div>

			<div class= "list-group-item">
				<button class = "btn btn-default navbar-btn" data-toggle="collapse" onclick="toggleVisibility('demo4');">Analytics Review</button>
			</div>
		</div><!--/.sidebar-offcanvas-->
	</div>
</div>
<!-- role3 -->
@endif

@include('footer')
@stop