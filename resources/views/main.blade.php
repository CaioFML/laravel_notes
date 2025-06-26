@extends('layouts/main')

@section('content')
  <h1>Welcome View and Blade!</h1>
  <hr>
  <h3>Value: {{ $value }} or <?= $value ?></h3>
@endsection