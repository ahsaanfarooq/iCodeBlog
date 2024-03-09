@extends('layouts.main')
@section('main-section')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <style>
        .row {
            background-color: #1f2327;
            width: 100% !important;
        }

        .pagination li a {
            background-color: #1f2327;
        }

        #example_filter input {
            background-color: #1f1f1f;
            color: white;
            outline: none;
        }

        #example_length select {
            background-color: #1f1f1f;
            color: white;

        }

        .col-sm-12 {
            flex: 0 0 auto;
            display: flex;
            justify-content: center;
        }

        .tablee {
            width: 95%;
            display: flex;
            justify-content: center;
            margin: 30px;
        }

        h2 {
            margin-top: 30px;
        }

        table {
            width: 90% !important;
        }

        body {
            background-color: #111827 !important;
        }

        #example_wrapper {
            width: 90%;
        }
    </style>
    <div class="adminbtn"><a href="{{ url('/admin/posts') }}">View Posts</a></div>
    <h2 style="text-align: center; color: white; ">Users</h2>
    <div class="tablee">
        <table id="example" class="table table-dark table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Author</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @php
                        $dateTime = new DateTime($user->created_at);
                        $formattedDateTime = $dateTime->format('d/m/Y , g:i a');
                    @endphp
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="author_or_not">
                            @if ($user->is_author == 1)
                                Yes
                            @else
                                No
                            @endif
                        </td>
                        <td>{{ str_replace(',', ' at ', $formattedDateTime) }}</td>
                        <td>
                            @if ($user->is_author == 1)
                                <form action="/demote/{{ $user->user_id }}" method="post">@csrf<button type="submit"
                                        data-id="{{ $user->user_id }}" class="demote" id="demote">Demote</button></form>
                            @else
                                <form action="/promote/{{ $user->user_id }}" method="post">@csrf<button type="submit"
                                        data-id="{{ $user->user_id }}" class="promote" id="promote">Promote</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            new DataTable('#example');
        });
    </script>
@endsection
