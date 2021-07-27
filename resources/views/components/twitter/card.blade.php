@props([
    'type' => 'summary_large_image',
    'title',
    'description' => NULL,
    'image' => NULL
])

<meta name="twitter:card" content="{{ $type }}"/>
<meta name="twitter:site" content="{{ config('social.twitter:site') }}"/>
<meta name="twitter:creator" content="{{ config('social.twitter:creator') }}">
<meta name="twitter:title" content="{{ $title }}"/>

@if (!empty($description))
    <meta name="twitter:description" content="{{ $description }}"/>
@endif

@if(!empty($image))
    <meta name="twitter:image" content="{{ $image }}"/>
    <meta name="twitter:image:alt" content="{{ $image_alt ?? $title }}"/>
@endif
