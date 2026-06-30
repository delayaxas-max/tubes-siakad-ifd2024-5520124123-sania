@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Dashboard Admin</h2>

    <hr>

    <h5>Selamat Datang {{ Auth::user()->name }}</h5>

</div>

@endsection