@props([
    'placeholder' => NULL,
    'error'       => NULL
])

<select {{ $attributes->merge(['class' => 'form-select form-select-sm' . ($error && $errors->has($error) ? ' is-invalid' : '')]) }} {{ $attributes }}>
    @if ($placeholder)
        <option disabled value="">{{ $placeholder }}</option>
    @endif

    {{ $slot }}
</select>

@if($error)
    @error($error)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
@endif
