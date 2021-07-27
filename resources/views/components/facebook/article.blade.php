@props([
    'url',
    'title',
    'description' => NULL,
    'image' => NULL
])

<meta property="fb:app_id" content="{{ config('social.fb:app_id') }}"/>
<meta property="og:url" content="{{ $url }}"/>
<meta property="og:type" content="article"/>
<meta property="og:title" content="{{ $title }}"/>

@if(!empty($description))
    <meta property="og:description" content="{{ $description }}"/>
@endif

@if(!empty($image))
    <meta property="og:image" content="{{ $image }}"/>
@endif
