@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1>Contact</h1>
            <a href="{{route('admin.contact.create')}}" class="btn btn-primary">Add new</a>
        </div>
        <div class="card-header table-responsive p-3">
            <table class="table table-hover table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </table>
        </div>
    </div>
@stop
