<script src="{{asset ('assets/js/loader.js') }}"></script>
<link href="{{asset ('assets/css/loader.') }}" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<link href="{{asset ('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset ('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset ('assets/css/structure.css') }}" rel="stylesheet" type="text/css" class="structure" />
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<link href="{{asset ('plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
<link href="{{asset ('assets/css/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" class="dashboard-sales" />

<style>
    aside{
        display: none!important;
    }
    .page-item.active .page-link{
        z-index: 3;
        color: #fff;
        background-color: #3b3f5c;
        border-color: #3b3f5c;
    }
    @media (max-width: 480px)
    {
        .mtmobile {
            margin-bottom: 20px!important;
        }
        .mbmobile {
            margin-bottom: 10px!important;
        }
        .hideonsm {
            display: none!important;
        }
        .inblock {
            display: block;
        }
    }
</style>

@livewireStyles