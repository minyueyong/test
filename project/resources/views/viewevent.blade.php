<title>Event Page</title>
@extends('header')
@section('content')
<link href="{{ asset('/css/default.css') }}" rel="stylesheet"/> 

<div class = "container">
        <div class = "page-header">
                <h3 class = "text-uppercase">Event Page</h3>
        </div>

        @php echo $id; @endphp
</div>

@include('footer')
@stop

