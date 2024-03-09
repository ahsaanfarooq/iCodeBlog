{{-- resources/views/sitemap.blade.php --}}

{{-- XML declaration --}}

{{-- Sitemap XML structure --}}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    {{-- Add your static pages --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ \Carbon\Carbon::now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <url>
        <loc>{{ url('/blog') }}</loc>
        <lastmod>{{ \Carbon\Carbon::now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>

    {{-- Add dynamic pages from your database --}}
    @foreach($posts as $post)
    @php
    $title = str_replace(' ', '_', $post->title);
    $url = url('') . '/post/' . $title;
    @endphp
        <url>
            <loc>{{ $url }}</loc>
            <lastmod>{{ $post->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
    @foreach($categories as $category)
    @php
    $url = url('') . '/selected_category/' . $category->category;
    @endphp
        <url>
            <loc>{{ $url }}</loc>
            <changefreq>weekly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach

</urlset>
