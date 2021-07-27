<script>
    function tinyMCE() {
        return {
            init($dispatch) {
                // editor.ScriptLoader.load('/js/twitter.js');

                tinymce.init({
                    selector: '#content',
                    plugins: ['template advlist autolink link image lists charmap print preview hr anchor pagebreak',
                        'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                        'table emoticons template paste help'],
                    entity_encoding: 'raw',
                    paste_as_text: true,
                    relative_urls : false,
                    remove_script_host : false,
                    document_base_url : 'https://www.milletgazetesi.gr',
                    templates: [
                        {
                            title: '1 - 16x9 images',
                            description: 'Adds a row with 2 images.',
                            content: createRatioBoxes()
                        },
                        {
                            title: '2 - 16x9 images',
                            description: 'Adds a row with 2 images.',
                            content: createRatioBoxes(2)
                        },
                        {
                            title: '3 - 16x9 images',
                            description: 'Adds a row with 3 images.',
                            content: createRatioBoxes(3)
                        },
                        {
                            title: '4 - 16x9 images',
                            description: 'Adds a row with 4 images.',
                            content: createRatioBoxes(4)
                        },
                    ],
                    menu: {
                        file: {title: 'File', items: 'newdocument restoredraft | preview | print '},
                        edit: {title: 'Edit', items: 'undo redo | cut copy paste | selectall | searchreplace'},
                        view: {title: 'View', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen'},
                        insert: {title: 'Insert', items: 'image link media template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor toc | insertdatetime'},
                        format: {title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align lineheight | forecolor backcolor | removeformat'},
                        tools: {title: 'Tools', items: 'spellchecker spellcheckerlanguage | code wordcount'},
                        table: {title: 'Table', items: 'inserttable | cell row column | tableprops deletetable'},
                        help: {title: 'Help', items: 'help'}
                    },
                    image_advtab: true,
                    image_class_list: [
                        {title: "Fluid", value: 'img-fluid rounded'}
                    ],
                    file_picker_types: 'image',
                    file_picker_callback: function (cb) {
                        let img;
                        tinymce.activeEditor.windowManager.openUrl({
                            "title": "Choose image",
                            "url": "/admin/articles/" + {{ $article->id }} +"/photos",
                            buttons: [
                                {
                                    type: 'cancel',
                                    text: 'Cancel'
                                },
                                {
                                    type: 'custom',
                                    text: 'OK',
                                    name: 'Select',
                                    primary: true
                                }
                            ],
                            onMessage: function (api, details) {
                                img = details.img;
                            },
                            onAction: function (api, details) {
                                if (img == null) {
                                    tinymce.activeEditor.windowManager.alert("Please select image");
                                    return;
                                }
                                if (details.name === 'Select') {
                                    api.close();
                                    cb(img, {title: '{{ $article->title }}'});
                                }
                            },
                        });
                    },
                    content_css: "https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css",
                    content_css_cors: true,
                    content_style: "body { padding: .75rem } .twitter-tweet { border: 1px solid #EBEBEB; border-radius: 5px; padding: 15px; width: 50%; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAaCAYAAACkVDyJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAYdEVYdFNvZnR3YXJlAHBhaW50Lm5ldCA0LjAuOWwzfk4AAAE7SURBVEhLvdQ/SwNBEIfhfElBBEEEwcZGEMRSEIKllQiWgoKiiRGCqIWohaAWkkI/RP6apJzsCBv35t47kmIsHpL8bnf2du8mFRH5Vxh6wtAThp4w9IShJww9YegJw3kcf4yk+jyQxvc4/OQxKQyj/Zef8MHX1PJVRxbO21MbzZ6sXnfCJR6vMIy0yOJFO3zNX9t7GmQWi9YaXTn5HIUh+TkKw2jztjctZHe7ftPNLBTpjaTjLAxTusO0oB7j9n1fli6zxxmdtsqfJYaRPo+VGhcuYmtYGEZH70MsWsbWsDBMHb4NC4/P0qO28y0MU/rGzXqsdi7B0Nq6+3tbixy8lvdshCGpf41/e5IW230sb4UUhin9y9IepIX0Bs5axU1OMEztPPRzO9NenPUILQw9YegJQ08YesLQj1QmjSeCiw+Rk/MAAAAASUVORK5CYII=); background-repeat: no-repeat; background-position: top right; } .twitter-tweet a { color: #4099FF; text-decoration: none; } .twitter-tweet[data-theme='dark'] { background-color: #666666; color: #FFFFFF; }",
                    media_dimensions: false,
                    media_url_resolver: function (data, resolve) {
                        if (data.url.indexOf('youtube') !== -1) {
                            let html = '<div class="ratio ratio-16x9 mb-3"><iframe src="' + data.url + '?autoplay=1&mute=1"></iframe></div><p></p>';
                            resolve({ html });
                        } else if (data.url.indexOf('youtu.be') !== -1) {
                            const url = data.url.substring(data.url.lastIndexOf('/') + 1);
                            let html = '<div class="ratio ratio-16x9 mb-3"><iframe src="https://www.youtube.com/embed/' + url + '?autoplay=1&mute=1"></iframe></div><p></p>';
                            resolve({ html });
                        } else {
                            resolve({ html: '<p></p>' });
                        }
                    },
                    image_dimensions: false,

                    toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify ' +
                        'bullist numlist outdent indent | template addImage | link image media | forecolor backcolor',

                    setup: function (editor) {
                        editor.ui.registry.addButton('addImage', {
                            icon: 'gallery',
                            onAction: function (_) {
                                let img;
                                tinymce.activeEditor.windowManager.openUrl({
                                    "title": "Choose image",
                                    "url": "/admin/articles/" + {{ $article->id }} +"/photos",
                                    buttons: [
                                        {
                                            type: 'cancel',
                                            text: 'Cancel'
                                        },
                                        {
                                            type: 'custom',
                                            text: 'OK',
                                            name: 'Select',
                                            primary: true
                                        }
                                    ],
                                    onMessage: function (api, details) {
                                        img = details.img;
                                    },
                                    onAction: function (api, details) {
                                        if (img == null) {
                                            tinymce.activeEditor.windowManager.alert("Please select image");
                                            return;
                                        }
                                        if (details.name === 'Select') {
                                            api.close();
                                            tinymce.activeEditor.execCommand('mceInsertContent', true, createImage(img, '{{ $article->title }}'));
                                        }
                                    },
                                });
                            }
                        });

                        editor.on('change', function () {
                            $dispatch('input', editor.getContent());
                        });
                    }
                });
            }
        }
    }

    function createImage(path = "{{ asset('storage/images/image-placeholder.png') }}", alt = '') {
        return '<img class="rounded" src="' + path + '" alt="' + alt + '">';
    }

    function createRatioBoxes(count = 1) {
        if (count === 1) {
            return '<div class="ratio ratio-16x9 mb-3">' + createImage() + '</div>';
        }

        let box = '<div class="row row-cols-1 row-cols-sm-' + count + ' g-2">';
        for (let i = 0; i < count; i++) {
            box += '<div class="col">' + createRatioBoxes() + '</div>';
        }
        box += '</div><p></p>';
        return box;
    }
</script>
