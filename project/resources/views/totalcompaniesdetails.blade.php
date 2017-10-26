@php
	$companies = DB::table('companies')->pluck('companyid');
@endphp

<title>Total Companies Details</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 

<div class = "container">
    <div class = "page-header">
    	<h3 class = "text-uppercase">Total Companies Details</h3>
    </div>

    <div>
    	<table class = "table table-responsive table-condensed">
    		<thead>
    			<tr>
    				<th>Company Name</th>
    				<th>Email</th>
    				<th>Phone</th>
    			</tr>
    		</thead>

    		<tbody>
		    	@foreach($companies as $company)
		    		@php
		    			$companyName = DB::table('companies')->where('companyid', $company)->value('companyName');
		    			$companyUserId = DB::table('companies')->where('companyid', $company)->value('userid');
		    			$companyEmail = DB::table('users')->where('id',$companyUserId)->value('email');
		    			$companyPhone = DB::table('companies')->where('companyid',$company)->value('phone');
		    		@endphp
			    	<tr>
				    	<td>{!!$companyName!!}</td>
				    	<td>{!!$companyEmail!!}</td>
				    	<td>0{!!$companyPhone!!}</td>
			    	</tr>
		    	@endforeach
		    </tbody>
		</table>
    </div>
</div>
@include('footer')
@stop