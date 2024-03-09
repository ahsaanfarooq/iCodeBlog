@extends('layouts.main')
@section('main-section')
    <script src="https://cdn.tiny.cloud/1/229rd6v917jmvgnnu405xkqcndu4s3wgseel5dir4kll8pzx/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.tiny.cloud/1/229rd6v917jmvgnnu405xkqcndu4s3wgseel5dir4kll8pzx/tinymce/5/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            plugins: [
                'accordion advlist anchor autolink autoresize charmap code codesample directionality emoticons fullscreen help image importcss insertdatetime link lists media nonbreaking pagebreak preview quickbars searchreplace table template visualblocks visualchars wordcount',
                'mousewheel'
            ],
            content_style: 'body { overflow-y: auto !important }',

            toolbar: 'accordion | advlist anchor autolink autoresize charmap code codesample directionality emoticons fullscreen help image importcss insertdatetime link lists media nonbreaking pagebreak preview quickbars searchreplace table template visualblocks visualchars wordcount',
            setup: function(editor) {
                editor.on('beforeunload', function(e) {

                    e.preventDefault();
                });
            }
        });

        function getHtmlContent() {
            var htmlContent = tinymce.get('mytextarea').getContent();
            document.getElementById('data').innerHTML = htmlContent;

            $('#uploadPostBtn').click();
        }
    </script>
    <div class="flex" style="align-items:unset !important;">

        <textarea id="mytextarea">{!! $post->desc !!}</textarea>
        <form action="/update_post/{{ $post->post_id }}" method="post" class="createPostForm">
            @csrf
            <label for="post_title">Title</label>
            <input required type="text" name="post_title" id="post_title" placeholder="Title" value="{{ $post->title }}">
            <label for="post_category">Post Category</label>
            <select name="post_category" id="post_category">
                @php
                    use App\Models\CategoriesModel;
                    $categories = CategoriesModel::all();
                @endphp
                @foreach ($categories as $category)
                    <option @if ($category->category == $post->category_name) {{ 'selected' }}
                @else @endif
                        value="{{ $category->category }}">{{ $category->category }}</option>
                @endforeach
            </select>
            <textarea required name="post_description" class="post_description" id="data"></textarea>
            <button id="postBtn" onclick="getHtmlContent()">Update Post</button>
            <button type="submit" id="uploadPostBtn" style="visibility: hidden">a</button>
        </form>
    </div>
@endsection
