@extends('job_board_layout.app')
@section('content')
@foreach ($items as $job_offer)
{{$job_offer->Name}}
@endforeach

@endsection


