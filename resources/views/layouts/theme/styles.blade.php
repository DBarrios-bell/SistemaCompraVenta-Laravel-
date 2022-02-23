<script src="{{asset ('assets/js/loader.js') }}"></script>
<link href="{{asset ('assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<link href="{{asset ('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset ('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset ('assets/css/structure.css') }}" rel="stylesheet" type="text/css" class="structure" />
<link href="{{asset ('plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />

{{-- <link ref="stylesheet" type="text/css" href="dist/snackbar.min.css" /> --}}

<link href="{{asset ('plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
<link href="{{asset ('assets/css/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" class="dashboard-sales" />

<link href="{{asset ('assets/css/apps/scrumboard.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset ('assets/css/apps/notes.css') }}" rel="stylesheet" type="text/css" />
<style>
    aside {
        display: none !important;
    }

    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #3b3f5c;
        border-color: #3b3f5c;
    }

    @media (max-width: 480px) {
        .mtmobile {
            margin-bottom: 20px !important;
        }

        .mbmobile {
            margin-bottom: 10px !important;
        }

        .hideonsm {
            display: none !important;
        }
        .navbar{
            background: #0f0c29;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #24243e, #302b63, #0f0c29);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #24243e, #302b63, #0f0c29); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }

        .inblock {
            display: block;
        }
    }

    .sidebar-theme #compactSidebar {
        /* background: #191e3a !important; */
        background: #0f0c29;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #24243e, #302b63, #0f0c29);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #24243e, #302b63, #0f0c29); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

    }

    .header-container .sidebarCollapse {
        color: #3b3f5c !important;
    }

    .navbar .navbar-item .navbar-item form.form-inline input.search-form-control {
        font-size: 15px;
        background-color: #3b3f5c;
        padding-right: 40px;
        padding-top: 12px;
        border: none;
        color: #fff;
        box-shadow: none;
        border-radius: 30px;
    }
    .bg-image {
        background: url();
    }
</style>

<link href="{{asset ('plugins/flatpickr/flatpickr.dark.css') }}" rel="stylesheet" type="text/css" />

@livewireStyles
