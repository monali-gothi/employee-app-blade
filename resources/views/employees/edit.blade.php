@extends('layouts.app')
@section('title', 'Edit Employee')
@section('page-title', 'Edit Employee')

@section('content')
<div class="card" style="max-width:700px">
    <div class="card-header">Edit Employee</div>
    <div class="card-body">
        <form method="POST" action="{{ route('employees.update', $employee->id) }}">
        @csrf @method('PUT')
        @include('employees._form')
        </form>
    </div>
</div>
@endsection