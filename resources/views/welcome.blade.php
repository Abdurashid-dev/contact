<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container p-3">
    <span class="p-4 text-danger">
    * if you want to enter admin panel, you need to write /admin before url
    </span>

    <div class="card mt-3">
        <div class="card-header">
            Contacts
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Name</th>
                    <th>Email(s)</th>
                    <th>Phone(s)</th>
                    <th>Created at</th>
                </tr>
                @forelse($contacts as $contact)
                    <tr>
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
                        <td>{{$contact->created_at}}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No contacts</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
</body>
</html>
