@props(['color'])

<div class="heading-tag" style="--tag-color: {{ $color }};">
    {{ $slot }}
</div>
