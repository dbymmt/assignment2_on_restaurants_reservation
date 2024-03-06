@extends('layouts.app-staff')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    <h1>{{Auth::guard('admin')->check() ? 'admin' : 'no-admin'}}</h1>
@endsection