@push('footer_scripts')
    <script>window.twttr = (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0],
                t = window.twttr || {};
            if (d.getElementById(id)) return t;
            js = d.createElement(s);
            js.id = id;
            js.src = "https://platform.twitter.com/widgets.js";
            fjs.parentNode.insertBefore(js, fjs);

            t._e = [];
            t.ready = function(f) {
                t._e.push(f);
            };

            return t;
        }(document, "script", "twitter-wjs"));</script>
@endpush

<div>
    @include('news::dashboard.articles.partials.article-header', ['title' => __("Edit article")])

    <div class="row justify-content-center p-4">
        <div class="col-12 col-xxl-10">
            @include('news::dashboard.articles.partials.article-title')
            <div class="row g-4">
                <div class="col-12 col-xl-7 col-xxl-8">
                    @include('news::dashboard.articles.partials.article-content')
                    @include('news::dashboard.articles.partials.article-photos')
                    @include('news::dashboard.articles.partials.article-delete')
                </div>
                <div class="col-12 col-xl-5 col-xxl-4">
                    @include('news::dashboard.articles.partials.article-publishing')
                    @include('news::dashboard.articles.partials.article-image')
                    @include('news::dashboard.articles.partials.article-options')
                    @include('news::dashboard.articles.partials.article-podcast')
                    @include('news::dashboard.articles.partials.article-tags')
                </div>
            </div>
        </div>
    </div>
</div>

@push('footer_scripts')
    <script src="https://cdn.tiny.cloud/1/gxet4f4kiajd8ppsca5dsl1ymcncx4emhut5fer2lnijr2ic/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    @include('news::dashboard.articles.partials.editor')

    <script>
        document.querySelector('input[type=file]').addEventListener('change', function (e) {
            const input = e.target;
            const container = document.getElementById('images-preview');

            for (let i = 0; i < input.files.length; i++) {
                const img = document.createElement('img');
                img.classList.add('rounded-3', 'opacity-50', 'top-50', 'start-50', 'translate-middle', 'w-auto', 'h-auto', 'mw-100', 'mh-100');
                img.setAttribute('src', window.URL.createObjectURL(input.files[i]));

                const options = document.createElement('div');
                options.classList.add('px-2', 'pt-2', 'pb-4', 'w-100', 'h-auto', 'rounded-top', 'd-flex', 'justify-content-between', 'align-items-center');
                options.style.background = "linear-gradient(180deg, rgba(0,0,0,1) 0%, rgba(255,255,255,0) 100%)";

                const status = document.createElement('small');
                status.innerText = "Uploading";
                status.classList.add('text-light', 'fw-bold');
                status.style.fontSize = ".7rem";

                const size = document.createElement('small');
                size.classList.add('text-gray-400');
                size.style.fontSize = ".6rem";
                size.innerText = Math.round((parseInt(input.files[0].size) / 1024)) + " KB";

                const p = document.createElement('div');
                p.classList.add('d-flex', 'flex-column');
                p.appendChild(status);
                p.appendChild(size);

                options.appendChild(p);

                const sc = document.createElement('div');
                sc.classList.add('rounded', 'rounded-circle', 'd-flex', 'justify-content-center', 'align-items-center', 'p-1');
                sc.style.background = "rgba(0,0,0,.5)";
                sc.style.width = "26px";
                sc.style.height = "26px";
                const spinner = document.createElement('em');
                spinner.classList.add('fa', 'fa-circle-notch', 'fa-spin', 'text-light');
                sc.appendChild(spinner);
                options.appendChild(sc);

                const ratio = document.createElement('div');
                ratio.classList.add('ratio', 'ratio-16x9', 'rounded-3', 'border');
                ratio.appendChild(img);
                ratio.appendChild(options);

                const col = document.createElement('div');
                col.classList.add('col');
                col.appendChild(ratio);

                container.appendChild(col);

            @this.upload('photos', input.files[i], filename => {
                img.classList.remove('opacity-50')
                spinner.classList.remove('fa-circle-notch', 'fa-spin');
                spinner.classList.add('fa-times');
                status.innerText = "Uploaded";
                options.style.background = "linear-gradient(180deg, rgba(54,151,99,1) 25%, rgba(155,203,177,.3) 70%, rgba(255,255,255,0) 100%)";

                sc.style.cursor = 'pointer';
                sc.addEventListener('click', click => {
                    click.stopPropagation();
                @this.removeUpload('photos', filename, () => col.remove());
                });
            }, error => {
            }, progress => {
                // console.log(e);
            });
            }
        });
    </script>
@endpush
