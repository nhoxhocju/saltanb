<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    {{-- <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'> --}}
    <link href="https://unpkg.com/grapesjs/dist/css/grapes.min.css" rel="stylesheet" />
    {{-- <link href="{{ asset('vendor/grapesjs/src/styles/scss/main.scss') }}" rel="stylesheet" /> --}}
    <link href="{{ asset('vendor/grapesjs-preset-webpage/dist/grapesjs-preset-webpage.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/grapesjs-preset-newsletter/dist/grapesjs-preset-newsletter.css">
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'>
    <link rel='stylesheet' href="{{ asset('css/grapesjs.css') }} ">
    {{-- <link rel='stylesheet' href='{{ asset("storage/css/$page->name.css") }}'> --}}

    <script src="https://unpkg.com/grapesjs"></script>
    <script src="https://unpkg.com/grapesjs-tooltip"></script>
    <script src="https://unpkg.com/grapesjs-custom-code"></script>
    <script src="https://unpkg.com/grapesjs-preset-newsletter"></script>
    <script src="{{ asset('vendor/grapesjs-preset-webpage/dist/grapesjs-preset-webpage.min.js') }}"></script>
    <script src="https://unpkg.com/grapesjs-parser-postcss"></script>


    <style>
        .gjs-one-bg {
            background-color: #4a4a4a;
        }

        .gjs-two-color {
            color: #fff;
        }

    </style>
</head>

<body>

    <div class="oldCss" id="oldCss" style="display:none">
        @include("backend.pages.$page->url_page.css")
    </div>
    <div id="notification" class=""></div>
    <div id="gjs">
        <div class="oldHtml" id="oldHtml">
            @include("backend.pages.$page->url_page.html")
        </div>
    </div>

    <div class="modal fade" id="modal-restore">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        var html, css;

        var editor = grapesjs.init({
            container: '#gjs',
            styleManager: {
                clearProperties: 1,
            },
            showOffsets: 1,
            storageManager: {
                autoload: 0,
            },
            fromElement: 1,
            height: '100vh',
            plugins: ['grapesjs-tooltip', 'grapesjs-custom-code', 'gjs-preset-webpage',
                'grapesjs-parser-postcss'
            ],
            pluginsOpts: {
                'gjs-preset-webpage': {
                    // options
                    blocksBasicOpts: {}
                },
                'grapesjs-tooltip': {
                    /* options */
                },
                'grapesjs-custom-code': {},
            },
            canvas: {
                styles: [
                    'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css',
                    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
                    "{{ asset('css/grapesjs.css') }}",
                ],
                scripts: [
                    'https://code.jquery.com/jquery-3.3.1.slim.min.js',
                    'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js',
                    'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'
                ],
            }
        });

        const head = editor.Canvas.getDocument().head;
        head.insertAdjacentHTML('beforeend', `<style>.row { margin-left: auto !important;
            margin-right: auto !important; }</style>`);

        var blockManager = editor.BlockManager;
        blockManager.add('h1-block', {
            label: 'H1 tag',
            content: '<h1>This is heading 1</h1>',
            category: 'Basic',
            attributes: {
                title: 'Insert h1 block',
                class: 'fa fa-header'
            }
        })
        blockManager.add('h2-block', {
            label: 'H2 tag',
            content: '<h2>This is heading 2</h2>',
            category: 'Basic',
            attributes: {
                title: 'Insert h2 block',
                class: 'fa fa-header'
            }
        })

        blockManager.add('navigation', {
            label: 'Navigation Header',
            content: `
         <div data-gjs="navbar-items" class="navbar-items-c">
            <nav data-gjs="navbar-menu" class="navbar-menu">
              <a href="#" class="navbar-menu-link">Home</a>
              <a href="#" class="navbar-menu-link">Contact</a>
              <a href="#" class="navbar-menu-link">Language</a>
              <a href="#" class="navbar-menu-link">Sitemap</a>
              <a href="#" class="navbar-menu-link">Admin</a>
            </nav>
          </div>
         `
        })
        blockManager.add('menu', {
            label: 'Left Menu',
            content: `
         <div class="sidenav">
      <a href="#" >Service</a>
      <a href="construction.html">Smart Farm Construction</a>
      <a href="monitoring.html">Smart Farm Monitoring</a>
      <a href="consulting.html">Smart Farm Consulting</a>
      <a href="operation.html">Smart Farm Operation</a>
    </div>
         `
        })
        blockManager.add('header-menu', {
            label: 'Header Menu',
            content: `
         <div class="navbar1">
            <div class="subnav1">
              <button class="subnavbtn1">About Us  <i class="fa fa-caret-down">
                </i></button>
              <div class="subnav-content1">
                <a href="{{ route('pages.our_mission') }}" class="clicker">Our Mission</a>
                <a href="{{ route('pages.our_story') }}" onclick="myFunction1()">Our Story</a>
                <a href="{{ route('pages.our_client') }}">Our Client</a>
                <a href="{{ route('pages.job_opportunities') }}">Job Opportunities</a>
                <a href="{{ route('pages.contact') }}">Contact</a>
              </div>
            </div>
            <div class="subnav1">
              <button class="subnavbtn1">Product <i class="fa fa-caret-down">
                </i></button>
              <div class="subnav-content1">
                <a href="{{ route('pages.smart_seeding_machine') }}">Smart Seeding Machine</a>
                <a href="{{ route('pages.smart_green_house') }}">Smart Green House</a>
                <a href="{{ route('pages.growth_measurement_device') }}">Growth Measurement Device</a>
                <a href="{{ route('pages.smart_iot_platform') }}">Smart IoT Platform</a>
                <a href="{{ route('pages.smart_decision_support_system') }}">Smart Decision Support System</a>
              </div>
            </div>
            <div class="subnav1">
              <button class="subnavbtn1">Service <i class="fa fa-caret-down">
                </i></button>
              <div class="subnav-content1">
                <a href="{{ route('pages.smart_farm_construction') }}">Smart Farm Construction</a>
                <a href="{{ route('pages.smart_farm_monitoring') }}">Smart Farm Monitoring</a>
                <a href="{{ route('pages.smart_farm_consulting') }}">Smart Farm Consulting</a>
                <a href="{{ route('pages.smart_farm_operation') }}">Smart Farm Operation</a>
              </div>
            </div>
            <div class="subnav1">
              <button class="subnavbtn1">Community <i class="fa fa-caret-down">
                </i></button>
              <div class="subnav-content1">
                <a href="../community/public-notice.html">Public Notice</a>
                <a href="../community/farm-new.html">Smart Farm News</a>
                <a href="../community/Q-A.html">Q&A</a>
              </div>
            </div>
          </div>
         `
        })
        blockManager.add('footer-menu', {
            label: 'Footer-Menu',
            content: `
         <div class="row">
        <div class="cell">
          <div data-gjs="navbar" class="navbar">
            <div class="navbar-container">
              <a href="/" class="navbar-brand"></a>
              <div data-gjs="navbar-items" class="navbar-items-c01">
                <nav data-gjs="navbar-menu" id="iants" class="navbar-menu">
                  <a href="#" class="navbar-menu-link">About</a>
                  <a href="#" class="navbar-menu-link">Newsroom</a>
                  <a href="#" class="navbar-menu-link">Related Sites</a>
                </nav>
              </div>
              <div class="navbar-burger">
                <div class="navbar-burger-line">
                </div>
                <div class="navbar-burger-line">
                </div>
                <div class="navbar-burger-line">
                </div>
              </div>
            </div>
          </div>
   
        </div>
      </div>
         `
        })
        const blocks = blockManager.getAll();
        blockManager.add('grid-item-row', {
            label: 'Grid Items',
            content: '<table data-gjs-type="table" draggable="true" data-highlightable="1" class="list-item" id="ig0fj5"><tbody data-gjs-type="tbody" draggable="true" data-highlightable="1" id="it45rl"><tr data-gjs-type="row" draggable="true" data-highlightable="1" id="iobr8s"><td data-gjs-type="cell" draggable="true" data-highlightable="1" class="list-item-cell" id="iv0oha"><table data-gjs-type="table" draggable="true" data-highlightable="1" class="list-item-content" id="iym0df"><tbody data-gjs-type="tbody" draggable="true" data-highlightable="1" id="iyh2q7"><tr data-gjs-type="row" draggable="true" data-highlightable="1" class="list-item-row" id="iysfsv"><td data-gjs-type="cell" draggable="true" data-highlightable="1" class="list-cell-left" id="if7wx5"><img data-gjs-type="image" draggable="true" src="http://placehold.it/150x150/78c5d6/fff/" alt="Image" class="list-item-image" id="iw8oz9"></td><td data-gjs-type="cell" draggable="true" data-highlightable="1" class="list-cell-right" id="ii3s4h"><h1 data-gjs-type="text" draggable="true" data-highlightable="1" class="card-title" id="iqm3jn">Title here</h1><p data-gjs-type="text" draggable="true" data-highlightable="1" class="card-text" id="if64vn">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt</p></td></tr></tbody></table></td></tr></tbody></table>' +
                '<table data-gjs-type="table" draggable="true" data-highlightable="1" class="list-item" id="ig0fj5"><tbody data-gjs-type="tbody" draggable="true" data-highlightable="1" id="it45rl"><tr data-gjs-type="row" draggable="true" data-highlightable="1" id="iobr8s"><td data-gjs-type="cell" draggable="true" data-highlightable="1" class="list-item-cell" id="iv0oha"><table data-gjs-type="table" draggable="true" data-highlightable="1" class="list-item-content" id="iym0df"><tbody data-gjs-type="tbody" draggable="true" data-highlightable="1" id="iyh2q7"><tr data-gjs-type="row" draggable="true" data-highlightable="1" class="list-item-row" id="iysfsv"><td data-gjs-type="cell" draggable="true" data-highlightable="1" class="list-cell-left" id="if7wx5"><img data-gjs-type="image" draggable="true" src="http://placehold.it/150x150/78c5d6/fff/" alt="Image" class="list-item-image" id="iw8oz9"></td><td data-gjs-type="cell" draggable="true" data-highlightable="1" class="list-cell-right" id="ii3s4h"><h1 data-gjs-type="text" draggable="true" data-highlightable="1" class="card-title" id="iqm3jn">Title here</h1><p data-gjs-type="text" draggable="true" data-highlightable="1" class="card-text" id="if64vn">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt</p></td></tr></tbody></table></td></tr></tbody></table>',
            category: 'Extra',
        })
        editor.Panels.addButton('options', [{
            id: 'save',
            className: 'fa fa-floppy-o icon-blank',
            attributes: {
                title: 'Save Template',
                "id": 'save'
            }
        }]);
        editor.Panels.addButton('options', [{
            id: 'back',
            className: 'fa fa-times-circle',
            attributes: {
                title: 'Back to list pages',
                "id": 'back'
            }
        }]);

        editor.Panels.addButton('options', [{
            // id: 'restore',
            className: 'fa fa-window-restore',
            attributes: {
                title: 'Restore page default',
                id: 'restore-default',
                "data-toggle": "modal",
                "data-target": "#modal-restore",
                'data-content': '<p class="modalBody">Are you sure you want restore default page???</p>',
                'data-title': '<h4 class="modalTitle">Restore default page</h4>',
                'data-submit': '<button type="submit" id="submit-restore-default" class="btn btn-primary btn-submit-modal">Restore</button>'
            },
            command: function () {
                // $('#modal-restore').modal('toggle');
            },
        }]);

        editor.Panels.addButton('options', [{
            // id: 'restore_previous',
            className: 'fa fa-backward',
            attributes: {
                title: 'Restore Previous Times',
                id: 'restore_previous',
                "data-toggle": "modal",
                "data-target": "#modal-restore",
                'data-content': '<p class="modalBody">Are you sure you want restore previous page???</p>',
                'data-title': '<h4 class="modalTitle">Restore previous page</h4>',
                'data-submit': '<button type="submit" id="submit-restore-previous" class="btn btn-primary btn-submit-modal pull-right">Restore</button>'
            },
            command: function () {
                //   $('#modal-restore').modal('toggle');
            },
        }]);

        $('#back').on('click', function (event) {
            window.location.href = "{{ route('backend.pages.index') }}";
        });

        $('#save').on('click', function (event) {
            // event.preventDefault();
            var html = editor.getHtml();
            var css = editor.getCss();
            $.ajax({
                type: "PUT",
                url: "{{ route('backend.grapesjs.update', $page->id) }}",
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'html': html,
                    'css': css
                },
                success: function (data) {
                    console.log(data);
                    $('#notification').removeClass();
                    $('#notification').addClass(data['class'] + ' mt-3');
                    $('#notification').html(data['content']);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });


    </script>

    {{-- Nhận css --}}
    <script>
        var oldCss = $(".oldCss").text();
        editor.addComponents("<style>" + oldCss + "</style>");

        $(document).ready(function () {
            $('#modal-restore').on('hidden.bs.modal', function (e) {

                $('#modal-restore .modalBody').remove();
                $('#modal-restore .modalTitle').remove();
                $('#modal-restore .btn-submit-modal').remove();
            });

            $('#modal-restore').on('show.bs.modal', function (event) {
                // $('#restore_previous').click(function() {
                var button = $(event.relatedTarget);
                var content = button.data('content');
                var title = button.data('title');
                var buttonSubmit = button.data('submit');

                $('#modal-restore .modal-body').append(content);
                $('#modal-restore .modal-header').prepend(title);
                $('#modal-restore .modal-footer').append(buttonSubmit);

                $('#submit-restore-default').on('click', function (event) {

                    $('#modal-restore').modal('hide');
                    $.ajax({
                        type: "PUT",
                        url: "{{ route('backend.grapesjs.restore_default', $page->id) }}",
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {},
                        success: function (data) {
                            window.location.href =
                                "{{ route('backend.grapesjs.edit', $page->id) }}";
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                });

                $('#submit-restore-previous').on('click', function (event) {
                    // event.preventDefault();
                    $('#modal-restore').modal('hide');
                    $.ajax({
                        type: "PUT",
                        url: "{{ route('backend.grapesjs.restore_previous_times', $page->id) }}",
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {},
                        success: function (data) {
                            window.location.href =
                                "{{ route('backend.grapesjs.edit', $page->id) }}";
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>
