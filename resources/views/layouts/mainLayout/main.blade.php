<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style>
        .ct-bar {

            stroke-width: 10px;
        }
    </style>
    <!-- App favicon -->
</head>
@include('layouts.mainLayout.css')

<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
    <div id="wrapper">
        @include('layouts.mainLayout.navbar')

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    @if(request()->segment(count(request()->segments())) != 'dashboard')
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">@yield('title')</li>
                                    </ol>
                                    @endif
                                </div>
                                <h4 class="page-title">@yield('title')</h4>
                                <input type="hidden" name="base_url" class="base_url" id="base_url" value="{{url('')}}">

                                <input type="hidden" name="id" class="id" id="id" value="{{(\Request::segment(2)) ? (\Request::segment(2)) : '' }}" />


                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">


                        <!-- <div class="col-12">
                                <div class="card">
                                    <div class="card-body min-vh-100"> -->

                        <!-- start Content here -->
                        @include('layouts.alertmessage')

                        @yield('content')




                        <!-- end Content here -->

                        <!-- </div>  -->
                        <!-- end card-body -->
                        <!-- </div>  -->
                        <!-- end card-->
                        <!-- </div>  -->
                        <!-- end col-->


                    </div>
                    <!-- end row-->

                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            @include('layouts.mainLayout.footer')
            <!-- end Footer -->

        </div>



    </div>
    <script>
        function toster(type = "success", feild = "", action = "Updated", custom_message = "") {
            // console.log("toster call ");
            // alert("toster call");

            if (feild.length > 0) {
                feild = feild.charAt(0).toUpperCase() + feild.slice(1);
                if (feild == 'Firstname') {
                    feild = 'First Name';
                } else if (feild == 'Lastname') {
                    feild = 'Last Name';
                } else if (feild == 'Company_name') {
                    feild = 'Company Name';
                }
            }
            // var str = 'flexiple';
            // var str2 = str.charAt(0).toUpperCase() + str.slice(1);
            var messages = $('.messages');
            var successHtml;
            messages.show();


            var alert = (action == "delete" || action == "deleted" || action == "danger" || alert == "danger") ? "danger" : "success";
            //action = (action == "delete" || action == "deleted") ? "Deleted" : action;

            if (custom_message && custom_message != "") {
                successHtml = '<div class="alert alert-' + type + '">' +
                    '<strong>' + custom_message + '.</strong></div>';

            } else if (type == "success") {

                successHtml = '<div class="alert alert-' + alert + '">' +
                    '<strong>' + feild + ' ' + action + ' Successfully.</strong></div>';

            } else if (type == "danger") {
                if (feild.length > 0) {
                    feild = 'in ' + feild;
                }
                successHtml = '<div class="alert alert-' + type + '">' +
                    '<strong>Something went Wrong! ' + feild + '</strong></div>';
            } else {
                successHtml = '<div class="alert alert-' + alert + '">' +
                    '<strong>' + feild + ' ' + action + ' Successfully.</strong></div>';
            }
            // $('#user-table').DataTable().ajax.reload();
            $(messages).html(successHtml);
            //$( messages ).focus();
            setTimeout(function() {
                $('#ajax-msg').fadeOut('fast');
                // $('#ajax-msg')
            }, 4000); // <-- time in milliseconds        
        }
    </script>
    @include('layouts.mainLayout.js')

</body>

</html>