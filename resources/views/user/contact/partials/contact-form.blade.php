<form action="{{ route('user.contact.store') }}" method="POST">
    @csrf
    @if(session()->has('success'))
        <div class="alert alert-success mb-3">
            {{ __("Thank your for contacting us") }}
        </div>
    @endif
    <div class="row mb-3">
        <div class="col">
            <label for="first-name" class="form-label">{{ __("Name") }}</label>
            <x-input.text id="first-name" name="first_name" error="first_name" required />
            @error('first_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col">
            <label for="last-name" class="form-label">{{ __("Surname") }}</label>
            <x-input.text id="last-name" name="last_name" error="is-invalid" required />
            @error('last_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="mb-3">
        <label for="subject" class="form-label">{{ __("Subject") }}</label>
        <x-input.text id="subject" name="subject" error="subject" required />
        @error('subject')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">{{ __("Email") }}</label>
        <x-input.email id="email" name="email" error="email" required />
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">{{ __("Message") }}</label>
        <x-input.textarea id="message" name="message" rows="6" error="message" required />
        @error('message')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="d-grid">
        <button type="submit" class="btn btn-primary">{{ __("Send") }}</button>
    </div>
</form>
