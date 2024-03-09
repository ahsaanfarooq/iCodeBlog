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

        .tablee {
            width: 100%;
            display: flex;
            justify-content: center;
            margin: 30px;
        }
        h2{
            margin-top: 30px;
        }

        body {
            background-color: #111827 !important;
        }
        .tablee2{
            margin: 0;
        }
        #example_wrapper {
            width: 90%;
        }
    </style>

<div class="adminbtn"><a href="{{ url('/admin/users') }}">View Users</a></div>
        <h2 style="text-align: center; color: white; ">Posts</h2>
    <div class="tablee tablee2" style="width:100%">
        <table id="example" class="table table-dark table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    @php
                        $dateTime = new DateTime($post->created_at);
                        $formattedDateTime = $dateTime->format('d/m/Y , g:i a');
                        $title = str_replace(' ', '_', $post->title);
                    @endphp
                   <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->author_name }}</td>
                        <td>{{ $post->category_name }}</td>
                        <td>{{ str_replace(',', ' at ', $formattedDateTime) }}</td>
                        <form action="/delete/{{ $post->post_id }}" method="post">
                        <td><span data-id="{{ $post->post_id }}" class="delete_post">@csrf<button type="submit" class="delete_post">Delete</button></span><span  class="edit_post_btn2"><button class="edit_post_btn2"><a target="_blank" href="{{ url('/post').'/'. $title . '/edit'}}">Edit</a></button></span></td></form>
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
