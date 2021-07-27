{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
@foreach ($urls as $url)
<url>
    <loc>{{ $url['loc'] }}</loc>
    <lastmod>{{ $url['lastmod'] }}</lastmod>
    <changefreq>{{ $url['changefreq'] }}</changefreq>
    <priority>{{ $url['priority'] }}</priority>
    @isset($url['image'])
    <image:image>
        <image:loc>{{ $url['image'] }}</image:loc>
        <image:title>{{ $url['title'] }}</image:title>
    </image:image>
    @endisset
</url>
@endforeach
</urlset>
