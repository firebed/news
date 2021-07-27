@props([
    'error'       => NULL
])

<input type="email" {{ $attributes->merge(['class' => 'form-control form-control-sm' . ($error && $errors->has($error) ? ' is-invalid' : '')]) }} {{ $attributes }}>

@if($error)
    @error($error)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
@endif
