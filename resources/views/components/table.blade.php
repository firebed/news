<table class="table">
    <thead>
    <tr>
        {{ $head }}
    </tr>
    </thead>

    <tbody>
    {{ $slot }}
    </tbody>

    {{ $foot ?? '' }}
</table>
