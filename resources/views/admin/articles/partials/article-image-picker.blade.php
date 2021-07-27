<html lang="tr">
<head>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <title></title>
</head>
<body>
<div class="container-fluid py-3">
    <div class="row row-cols-5 g-2">
        @foreach($images as $image)
            <div class="col">
                <div class="ratio ratio-16x9 rounded border">
                    <img src="{{ $image->url() }}" alt="" class="rounded img-middle">
                </div>
            </div>
        @endforeach
    </div>
</div>
<script>
    let prev;
    document.addEventListener('click', e => {
        if (e.target.matches('img')) {
            if (prev) {
                prev.parentElement.classList.remove('border', 'border-4', 'border-success');
            }

            window.parent.postMessage({
                mceAction: 'selectImage',
                img: e.target.src
            }, '*');

            e.target.parentElement.classList.add('border', 'border-4', 'border-success');
            prev = e.target;
        }
    });
</script>
</body>
</html>
