<title>Post an Activity</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/>
<script type="text/javascript">
    function CheckFees(fees)
    {
        if (fees == 'paid')
            document.getElementById('div1').innerHTML = '<span class="glyphicon glyphicon-shopping-cart"></span> <input type = "text" name = "feespaid" id = "feespaid" placeholder = "Fees Required"/>'
        else
            document.getElementById('div1').innerHTML='';
    }
</script>
	<div class="container">
        <div class = "page-header">
            <h3 class = "text-uppercase">Post an Activity</h3>
        </div>

		<div class="page-login-form box">
        	<form role="form" class="login-form" method="POST" action="/viewevent" enctype="multipart/form-data">
        		<input type = "hidden" name = "_token" value = "<?php echo csrf_token();?>">
        			<div class = "form-group">
            				<div class="input-icon">
                				<span class="glyphicon glyphicon-pencil"></span> <input type="text" placeholder="Activity Name" name="eventname" id = "eventname" class = "form-control" required/>
            				</div>
       			 	</div>
				
			     <div class = "form-group">
                    <div class="input-icon">
                        <span class="glyphicon glyphicon-time"></span> <input type="text" name="eventdate" id="eventdate" placeholder="Activity Date: YYYY-MM-DD" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" title="Enter a date in this format YYYY-MM-DD" required=""/>
            	   </div>
       	        </div>
				
				<div class = "form-group">
            	   <div class="input-icon">
                	   <span class="glyphicon glyphicon-road"></span> <input type="text" placeholder="Activity Venue" name="eventvenue" id = "eventvenue" class = "form-control" required/>
            	   </div>
                </div>
				
                <div class="form-group">
                <div class="input-icon"> <span class="glyphicon glyphicon-shopping-cart"></span>
                <select name = "fees" id ="fees" onchange='CheckFees(this.options[this.selectedIndex].value);' required>
                    <option value = "" selected disabled>Fees </option>
                    <option value="free">Free </option>
                    <option value="paid">Paid </option>
                </select>
                <div id = "div1"></div>
                </div>
                </div>

				<div class = "form-group">
            	   <div class="input-icon">
                	   <span class="glyphicon glyphicon-camera"></span> <input type="file" placeholder=" Activity Image" name="eventimage" id = "eventimage" required/>
            	   </div>
       	        </div>

				<div class = "form-group">
                    <div class="input-icon">
                	   <span style="vertical-align:top;" class="glyphicon glyphicon-pencil"></span> <textarea rows="3" cols="60" maxlength="100" id="eventdescription" name="eventdescription" placeholder="Activity Description" required></textarea>
                    </div>
                </div>
                
                <button type="submit" class = "btn btn-default login-btn">Create It</button>
		  </form>
        </div>
	</div>
@include('footer')
@stop