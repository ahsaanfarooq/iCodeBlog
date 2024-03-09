@extends('layouts.main')
@section('main-section')
    <div class="full_post">
        <title>{{ str_replace('_', ' ', basename(url()->current())) }}</title>
        <script>

            function showComments() {
                const baseUrl = window.location.pathname;
                const baseUrl2 = baseUrl.substring(baseUrl.lastIndexOf('/') + 1);

                $.ajax({
                    type: "get",
                    url: window.location.origin + "/posts/" + baseUrl2,
                    dataType: "json",
                    success: function(comments) {
                        comments.forEach(comment => {

                            const dateObject = new Date(comment.created_at);

                            // Format the date
                            const formattedDate =
                                `${padZero(dateObject.getDate())}-${dateObject.toLocaleString('default', { month: 'long' })}-${dateObject.getUTCFullYear()}`;

                            // Output the formatted date

                            function padZero(number) {
                                return number < 10 ? `0${number}` : number;
                            }

                            function formatTime(hours, minutes) {
                                const formattedHours = hours % 12 === 0 ? 12 : hours %
                                    12; // Convert to 12-hour format
                                const period = hours < 12 ? 'AM' : 'PM';
                                const formattedMinutes = minutes < 10 ? `0${minutes}` : minutes;

                                return `${formattedHours}:${formattedMinutes} ${period}`;
                            }

                            const dateObject2 = new Date(comment.created_at);

                            // Format the time
                            const formattedTime2 = formatTime(dateObject2.getHours(), dateObject2
                                .getMinutes());

                            // Output the formatted time
                            var Time = formattedTime2;



                            var securedComment =  escapeHTML(comment.comment);
                            let content = `<div class="comment">
                  <div class="user_img">
                      <img src="${comment.profile_image}" alt="">
                  </div>
                  <div>
                      <div class="username">${comment.username} <span class="comment_time">${formattedDate}</span><span class="comment_time2"> at ${Time}</span></div>
                      <div class="user_comment">${securedComment}</div>
                  </div>
              </div>`;
                            $('#comments').append(content);
                        });
                    },
                    error: function(error) {
                        console.log('Error:', error);
                    }
                });
            }
            document.addEventListener('DOMContentLoaded', function() {

                showComments();
            });
        </script>
        <div class="post_content">
            @php
                function padZero($number)
                {
                    return $number < 10 ? "0$number" : $number;
                }
                $dateObject = new DateTime($post->created_at);

                $formattedDate = $dateObject->format('d-F-Y');

                use App\Models\UserModel;
                $another_user = UserModel::find(session('user_id') ?? 1);

            @endphp

            <h6><span class="category_name">{{ $post->category_name }}</span><span
                    class="post_time">{{ $formattedDate }}</span>
                @if ($another_user->is_author == 1)
                    <a href="{{ url()->current() . '/edit' }}" class="edit_post_btn">Edit Post</a>
                @endif
            </h6>
            <h1>{{ $post->title }}</h1>
            <small class="author_container">By <b id="author">{{ $post->author_name }}</b></small>
            <p class="post_p">
                {!! $post->desc !!}

            </p>

            <hr class="read_post_hr" style="margin: 50px 0;">
            <h2 style="text-align: center; margin-bottom: 30px;" class="see">See more on {{ $post->category_name }}</b>
            </h2>
            @php
                use App\Models\PostsModel;
                $category_posts = PostsModel::where('category_name', $post->category_name)->get();
                foreach ($category_posts as $key => $title) {
                    echo "<div  style='margin: 3px 0; padding: 5px;'><a class='more_on' style='color: rgb(95 114 255); text-decoration: none;' href=" . url('/post') . '/' . str_replace(' ', '_', $post->title) . "><li style='color:rgb(0, 0, 184);text-decoration: underline; cursor: pointer;'>" . $title->title . '</li></a></div>';
                }
            @endphp
            <hr class="read_post_hr" style="margin: 50px 0;">
            <div class="comments">
                <h1 class="comment_heading" style="text-align: center; margin-top: 50px;">Comments</h1>
                @if (session()->has('username'))
                    <div class="post_comment">
                        <form action="{{ url()->current() }}" method="post" id="commentForm">
                            @csrf
                            <label for="comment">Comment as <b id="author">{{ session('username') }}</b></label>
                            <input type="text" name="comment" id="comment" placeholder="Your comment...">
                            <button type="submit">Comment</button>
                        </form>
                    </div>
                @else
                    <div class="post_comment">
                        <form id="commentForm">
                            @csrf
                            <label for="comment">Comment as <b id="author">John</b></label>
                            <input disabled type="text" name="comment" id="comment"
                                value="Please Login to leave a comment">
                            <button disabled>Comment</button>
                        </form>
                    </div>
                @endif

                <div id="comments">

                </div>
            </div>
        </div>
        <div class="second_container">
            <div class="post_questions">
                @foreach ($questions as $question)
                    <a class="question" href="#q-1">{{ $question->question }}</a>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        const csrfToken = "{{ csrf_token() }}";
        const currentUrl = "{{ url()->current() }}";
        $(document).ready(function() {
            setInterval(() => {

                // Remove width and height attributes from images and iframes
                $('.post_content img').removeAttr('width').removeAttr('height');
            });
        }, 1000);
    </script>
    <style>
        .post_content img {
            width: 100% !important;
            margin: 10px 0;
        }
    </style>
@endsection
