@extends('layouts.main')
@section('main-section')



    <title>iC0deBlog | Coding Blog</title>
    <style>
        .active-1 {
            color: #4040bd;
            font-weight: 600;
        }

        .l-p1 {
            margin-left: 10px;
            width: 76%;
        }
    </style>
    <h4 class="website_name">iC0deBlog</h4>
    <h1 class="explore"> <span></span> </h1>
    <div class="latest_posts">
        <h1 class="recent_posts">Recent Posts</h1>
        @php
            function padZero($number)
            {
                return $number < 10 ? "0$number" : $number;
            }
        
        @endphp
       
        
        @foreach ($posts as $post)
     
            @php
                $input_date_string = $post->created_at;
                $input_format = "Y-m-d H:i:s";
                $output_format = "D, F d, Y";
                $input_date = DateTime::createFromFormat($input_format, $input_date_string);
                $formattedDate = $input_date->format($output_format);
                $commentsNo = $count_comments->where('post_id', $post->post_id)->count();
            @endphp
            <div class="post_anchor post" 
                style="text-decoration: none">
            
                    <h6><span class="category_name" style=" cursor:default;">{{ $post->category_name }}</span> <span
                            class="post_time" style=" cursor:default;">{{ $formattedDate }}</span></h6>
                    <a style="text-decoration: none" href="{{ url('/post') . '/' . str_replace(' ', '_', $post->title) }}"><h3 class="title" >{{  $post->title}}</h3></a>
                    <div style=" cursor:default;" class="description">{!! substr($post->desc, 0, 350) . '...' !!}</div>
                    <div style="display: flex !important;justify-content:space-between; width: 100%;">
                    <a style="text-decoration: none;" class="learn_more" href="{{ url('/post') . '/' . str_replace(' ', '_', $post->title) }}">Read More 
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                            viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M869 487.8L491.2 159.9c-2.9-2.5-6.6-3.9-10.5-3.9h-88.5c-7.4 0-10.8 9.2-5.2 14l350.2 304H152c-4.4 0-8 3.6-8 8v60c0 4.4 3.6 8 8 8h585.1L386.9 854c-5.6 4.9-2.2 14 5.2 14h91.5c1.9 0 3.8-.7 5.2-2L869 536.2a32.07 32.07 0 0 0 0-48.4z">
                            </path>
                        </svg>
                    </a>
                    <a href="{{ url('/post') . '/' . str_replace(' ', '_', $post->title) . '#comment' }}" class="comments_count">({{ $commentsNo }}) Comments</a>
                </div>
                    <hr class="post_hr">
               
            </div>
        @endforeach
    </div>
    

@endsection
