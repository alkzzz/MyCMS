@extends('_layouts.dashboard')

@section('title', $title)

@section('content')
<textarea id="edittext"></textarea>
@stop

@section('js')
@parent
@include('includes.tinymce')
@endsection
