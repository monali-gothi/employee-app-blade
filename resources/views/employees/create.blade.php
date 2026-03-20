@extends('layouts.app')
@section('title', 'Add Employee')
@section('page-title', 'Add Employee')

@section('content')
<div class="card" style="max-width:700px">
    <div class="card-header">Employee Information</div>
    <div class="card-body">
        <form method="POST" action="{{ route('employees.store') }}">
        @csrf
        @include('employees._form')
        </form>
    </div>
</div>
@endsection