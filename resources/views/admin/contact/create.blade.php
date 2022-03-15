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
                            <div class="d-flex justify-content-between mt-3">
                                <button class="btn btn-primary btn-sm" type="button" id="addEmail">
                                    Add another email
                                </button>
                                <button class="btn btn-danger btn-sm" type="button" id="removeEmail" disabled>
                                    Remove email
                                </button>
                            </div>
                            <x-input name="phones[]" type="number" label="Phone"/>
                            <div id="phoneParent"></div>
                            <div class="d-flex justify-content-between mt-3">
                                <button class="btn btn-primary btn-sm mt-3" type="button" id="addPhone">Add another phone </button>
                                <button class="btn btn-danger btn-sm mt-3" type="button" id="removePhone" disabled>Remove phone </button>
                            </div>
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
        document.addEventListener('DOMContentLoaded', function () {
            let emailParent = document.getElementById('emailParent');
            let phoneParent = document.getElementById('phoneParent');
            let emailBtn = document.getElementById('addEmail');
            let phoneBtn = document.getElementById('addPhone');
            let removeEmailBtn = document.getElementById('removeEmail');
            let removePhoneBtn = document.getElementById('removePhone');
            // console.log(emailParent.children.length);
            emailBtn.addEventListener('click', function () {
                let email = document.createElement('div');
                email.innerHTML = `<x-input name="emails[]" label="Email"/>`;
                emailParent.appendChild(email);
                // console.log(email.children.length);
                removeBtn();
            });
            phoneBtn.addEventListener('click', function () {
                let phone = document.createElement('div');
                phone.innerHTML = `<x-input name="phones[]" type="number" label="Phone"/>`;
                phoneParent.appendChild(phone);
                // console.log(phone);
                removeBtn();
            });
            removeEmailBtn.addEventListener('click', function () {
                if (emailParent.children.length === 1 || emailParent.children.length > 1) {
                    emailParent.removeChild(emailParent.lastChild);
                }
                removeBtn();
            });
            removePhoneBtn.addEventListener('click', function () {
                if (phoneParent.children.length === 1 || phoneParent.children.length > 1) {
                    phoneParent.removeChild(phoneParent.lastChild);
                }
                removeBtn();
            });

            function removeBtn() {
                // console.log(emailParent.children.length);
                removeEmailBtn.disabled = emailParent.children.length <= 0;
                removePhoneBtn.disabled = phoneParent.children.length <= 0;
            }
        })
    </script>
@stop
