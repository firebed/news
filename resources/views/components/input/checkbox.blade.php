@props(['disabled' => FALSE])

<div class="form-check">
    <input type="checkbox" {{ $attributes->merge(['class' => 'form-check-input']) }} {{ $attributes }} autocomplete="off" @if($disabled) disabled @endif>
    <label for="{{ $attributes['id'] }}" class="form-check-label">{{ $slot }}</label>
</div>
