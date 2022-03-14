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
                @forelse($contacts as $contact)
                    <tr>
                        <td>{{$contact->id}}</td>
                        <td>{{$contact->name}}</td>
                        <td>
                            @foreach($contact->emails as $email)
                                {{$email->email}}<br>
                            @endforeach
                        </td>
                        <td>
                            @foreach($contact->phones as $phone)
                                {{$phone->phone}}<br>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{route('admin.contact.edit', $contact->id)}}" class="btn btn-primary">Edit</a>
                            <form action="{{route('admin.contact.destroy', $contact->id)}}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No data</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
@stop
