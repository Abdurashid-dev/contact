@extends('layouts.app')
@section('content')
    <div class="container">@if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
    @endif

    <!-- Create Post Form -->
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Create Contact</h3>
                    </div>
                    <div class="card-body">
                        <form id="form" action="{{route('admin.contact.store')}}" method="POST">
                            @csrf
                            <x-input name="name" label="Name"/>
                            <x-input name="emails[]" label="Email" type="email"/>
                            <div id="emailParent"></div>
                            <button class="btn btn-primary btn-sm mt-3" type="button" id="addEmail">Add another email</button>
                            <x-input name="phones[]" type="number" label="Phone"/>
                            <div id="phoneParent"></div>
                            <button class="btn btn-primary btn-sm mt-3" type="button" id="addPhone">Add another phone</button>
                            <input type="submit" value="Save" class="btn btn-primary float-end mt-3">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            let emailBtn = document.getElementById('addEmail');
            let phoneBtn = document.getElementById('addPhone');
            emailBtn.addEventListener('click', function (){
                let email = document.createElement('div');
                email.innerHTML = `<x-input name="emails[]" label="Email"/>`;
                document.querySelector('#emailParent').appendChild(email);
                console.log(email);
            });
            phoneBtn.addEventListener('click', function (){
                let phone = document.createElement('div');
                phone.innerHTML = `<x-input name="phones[]" type="number" label="Phone"/>`;
                document.querySelector('#phoneParent').appendChild(phone);
                console.log(phone);
            });
        })
    </script>
@stop
