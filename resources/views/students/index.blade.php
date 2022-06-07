@extends('layouts.app')
@section('title', 'Student Home')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
            <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Student List
                        <a href="{{ route('student.add') }}" class="btn btn-primary float-end">Add Student</a>
                    </h4>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
