@extends('layouts.app-staff')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    <h1>{{Auth::guard('owner')->check() ? 'owner' : 'no-owner'}}</h1>
@endsection