@extends('layouts.mainLayout.main')
@section('title', 'Gateways')
@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-body min-vh-100">
            <div class="row mb-2">
                <div class="col-auto">
                    <form class="mb-2 mb-sm-0">
                        <label for="inputPassword2" class="visually-hidden">Search</label>
                        <input type="search" class="form-control" id="search" placeholder="Search...">
                    </form>
                </div>
                <div class="col-sm-9">
                    <div class="text-sm-end">
                        <a type="button" class="waves-effect waves-light add-new-gateway" data-bs-toggle="modal" data-bs-target="#add-new-gateway"><i class="mdi mdi-plus-circle h3 text-primary"></i></a>
                    </div>
                </div>
            </div>
            <input type="hidden" id="gateways" value="gateways">
            <div class="table-responsive border-0">
                <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100">
                    <thead>
                        <tr align="center">
                            <th>Gateway Name</th>
                            <th>Expire Seconds</th>
                            <th>Retry Seconds</th>
                            <th>Register</th>
                            <th>Hostname</th>
                            <th>Default Outbound Gateway</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @isset($records)
                        @foreach($records as $data)
                        <?php
                        $id = App\Providers\EncreptDecrept::encrept($data['id']);
                        ?>
                        <tr class="record{{$id}}">
                            <td class="text-center">{{$data->gateway_name}}</td>
                            <td class="text-center">{{$data->expire_seconds}}</td>
                            <td class="text-center">{{$data->retry_seconds}}</td>
                            <td class="text-center">
                                <span data-index="register" data-id="{{$id}}" data-value="{{$data['register']}}" class="badge update-register font1-14 register{{$id}} @if($data['register'] == 'TRUE') bg-soft-success text-success @elseif($data['register'] == 'FALSE') bg-soft-danger text-danger @else bg-soft-success text-success @endif">{{$data->register}}
                                </span>
                            </td>
                            <td class="text-center"> {{$data->hostname?$data->hostname:'-'}} </td>
                            <td class="text-center">
                                <span class="badge font1-14 bg-soft-info1 text-info1 @if($data['outbound_default'] == 'YES') bg-soft-success text-success @elseif($data['outbound_default'] == 'NO') bg-soft-danger text-danger @else bg-soft-success text-success @endif">{{$data->outbound_default}}
                                </span>
                            </td>
                            <td class="text-center">
                                <a class="action-icon delete" data-id="{{$id}}" title="Delete Gateways"><i class="fa fa-trash text-danger h6"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @endisset
                    </tbody>
                </table>
                <div class="text-center my-4">
                    <a href="javascript:void(0);" class="text-danger loding" style="display:none"><i class="mdi mdi-spin mdi-loading me-1"></i> Load more </a>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .modal-dialog {
        max-width: 80%;

    }
</style>
<!-- Modal -->
<input type="hidden" id="gateways" value="gateways">
<div class="modal fade" id="add-new-gateway" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">Add New Gateway</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body" style="padding: 0 30px;">

                        <div class="tab-content">
                            <div class="tab-pane show active" id="personal">

                                <form class="needs-validation1 was-validated1" id="gatewayaddform" novalidate>
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
                                    <!-- <input type="hidden" name="gatewayaddid" id="gatewayaddid" value="0" /> -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="Gateways_gateway_name" class="form-label">Gateway Name</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-dot-circle"></i></span>
                                                    <input type="text" name="gateway_name" class="form-control" id="gateway_name" placeholder="Gateway Name" maxlength="100" value="" required>
                                                    <div class="invalid-tooltip gateway_name">
                                                        Gateway Name cannot be blank.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="Gateways_prefix" class="form-label">Prefix</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                    <input type="text" name="prefix" class="form-control" id="prefix" placeholder="Prefix" value="" required>
                                                    <div class="invalid-tooltip prefix">
                                                        Prefix cannot be blank.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="Gateways_username" class="form-label">Username</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                    <input type="text" name="username" class="form-control" id="username" placeholder="Username" maxlength="50" value="" required>
                                                    <div class="invalid-tooltip username">
                                                        Please Enter valid Username.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="Gateways_password" class="form-label">Password</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-unlock"></i></span>
                                                    <input type="text" name="password" class="form-control" id="password" placeholder="Password" value="" maxlength="50" required>
                                                    <div class="invalid-tooltip password">
                                                        Please Enter Password.
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="Gateways_auth_username" class="form-label">Auth Username</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                    <input type="text" name="auth_username" class="form-control" id="auth_username" placeholder="Auth Username" maxlength="50" value="" required>
                                                    <div class="invalid-tooltip auth_username">
                                                        Auth Username cannot be blank.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="Gateways_realm" class="form-label">Realm</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-cog"></i></span>
                                                    <input type="text" name="realm" class="form-control" id="realm" placeholder="Realm" maxlength="100" value="" required>
                                                    <div class="invalid-tooltip realm">
                                                        Realm cannot be blank.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="Gateways_from_user" class="form-label">From User</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                    <input type="text" name="from_user" class="form-control" id="from_user" placeholder="From User" maxlength="100" value="" required>
                                                    <div class="invalid-tooltip from_user">
                                                        From User cannot be blank.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="Gateways_from_domain" class="form-label">From Domain</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-globe"></i></span>
                                                    <input type="text" class="form-control" id="from_domain" placeholder="From Domain" name="from_domain" value="" maxlength="100" required>
                                                    <div class="invalid-tooltip from_domain">
                                                        From Domain cannot be blank.
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="Gateways_proxy" class="form-label">Proxy</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-crosshairs"></i></span>
                                                    <input type="text" class="form-control" id="proxy" placeholder="Proxy" name="proxy" maxlength="100" value="" required>
                                                    <div class="invalid-tooltip proxy">
                                                        Proxy cannot be blank.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="Gateways_register_proxy" class="form-label">Register Proxy</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-user-plus"></i></span>
                                                    <input type="text" name="register_proxy" class="form-control" id="register_proxy" placeholder="Register Proxy" maxlength="100" value="" required>
                                                    <div class="invalid-tooltip register_proxy">
                                                        Register Proxy
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="Gateways_outbound_proxy" class="form-label">Outbound Proxy</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-arrow-circle-up"></i></span>
                                                    <input type="text" name="outbound_proxy" class="form-control" id="outbound_proxy" placeholder="Outbound Proxy" maxlength="100" value="" required>
                                                    <div class="invalid-tooltip from_user">
                                                        From User cannot be blank.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="Gateways_expire_seconds" class="form-label">Expire Seconds</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-clock" aria-hidden="true"></i></span>
                                                    <input type="text" name="expire_seconds" class="form-control" id="expire_seconds" placeholder="Expire Seconds" value="" maxlength="50" required>
                                                    <div class="invalid-tooltip expire_seconds">
                                                        Expire Seconds cannot be blank.
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="Gateways_register" class="form-label">Register</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-user-plus"></i></span>
                                                    <select class="form-control" name="register" id="register" required>
                                                        <option value="">Select</option>
                                                        <option value="TRUE">TRUE</option>
                                                        <option value="FALSE">FALSE</option>
                                                    </select>
                                                    <div class="invalid-tooltip register">
                                                        Register cannot be blank.
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="Gateways_retry_seconds" class="form-label">Retry Seconds</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                                    <input type="text" class="form-control" id="retry_seconds" placeholder="Retry Seconds" name="retry_seconds" maxlength="100" value="" required>
                                                    <div class="invalid-tooltip retry_seconds">
                                                        Retry Seconds cannot be blank.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="Gateways_ping" class="form-label">Ping</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-puzzle-piece"></i></span>
                                                    <input type="text" name="ping" class="form-control" id="ping" placeholder="Ping" maxlength="100" value="" required>
                                                    <div class="invalid-tooltip ping">
                                                        Ping cannot be blank.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="Gateways_caller_id_in_from" class="form-label">Caller ID In From</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                                    <input type="text" name="caller_id_in_from" class="form-control" id="caller_id_in_from" placeholder="Caller ID In From" value="" maxlength="50" required>
                                                    <div class="invalid-tooltip caller_id_in_from">
                                                        Caller ID In From cannot be blank.
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="Gateways_channels" class="form-label">Channels</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-cubes"></i></span>
                                                    <input type="text" name="channels" class="form-control" id="channels" placeholder="Channels" maxlength="100" value="" required>
                                                    <div class="invalid-tooltip channels">
                                                        channels cannot be blank.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="Gateways_hostname" class="form-label">Hostname</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-globe"></i></span>
                                                    <input type="text" class="form-control" id="hostname" placeholder="Hostname" name="hostname" maxlength="100" value="" required>
                                                    <div class="invalid-tooltip hostname">
                                                        Hostname cannot be blank.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="Gateways_outbound_default" class="form-label">Default Outbound Gateway</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-check"></i></span>
                                                    <select class="form-control" name="outbound_default" id="outbound_default" required>
                                                        <option value="">Select</option>
                                                        <option value="YES">YES</option>
                                                        <option value="NO">NO</option>
                                                    </select>
                                                    <div class="invalid-tooltip outbound_default">
                                                        Default Outbound Gateway cannot be blank.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div> <!-- end row -->
                            </div>
                        </div> <!-- end row -->
                        <div class="text-end">
                            <span class="btn btn-success waves-effect waves-light mt-2 gatewayaddsubmit"><i class="mdi mdi-content-save"></i> Save</span>
                        </div>
                        </form>
                    </div> <!-- end tab-pane -->
                </div> <!-- end tab-content -->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    var base_url = $('#base_url').val();
    var url;
    $(document).ready(function() {

        $(document).on('click', '.update-register', function() {
            var id = $(this).data("id");
            var columnindex = $(this).data("index");
            var value = $(this).attr("data-value");
            Swal.fire({
                title: "Are you sure?",
                text: "You want to change " + columnindex,
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ms-2 mt-2",
                buttonsStyling: !1
            }).then(function(e) {
                if (e.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: base_url + '/gateways_update_ajex',
                        method: "POST",
                        data: {
                            id: id,
                            columnindex: columnindex,
                            value: value,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(result) {
                            var feild;
                            console.log("." + columnindex + id);
                            console.log("value= " + value);
                            if (result.status) {
                                if (value == "TRUE") {
                                    console.log(value);
                                    $("." + columnindex + id).removeClass("bg-soft-succes").removeClass("text-success").addClass("bg-soft-danger").addClass("text-danger").html("FALSE").attr("data-value", "FALSE");
                                } else if (value == "FALSE") {
                                    console.log(value);
                                    $("." + columnindex + id).removeClass("bg-soft-danger").removeClass("text-danger").addClass("bg-soft-success").addClass("text-success").html("TRUE").attr("data-value", "TRUE");
                                }
                                feild = "register";
                                if (result.status == 'danger' || result.status == 'fail') {
                                    if (result.data == "Record not exist") {
                                        toster("danger", "", "", "Record not found");
                                        // setTimeout( function(){ 
                                        // location.reload();
                                        // }  , 3000 );
                                    } else {
                                        toster("danger", "", "", "Something Wrong!");
                                    }
                                } else {
                                    toster("success", feild, "updated");
                                }
                            }
                            loadMoreData(1, 'update');
                        },
                    }).fail(function(jqXHR, ajaxOptions, thrownError) {
                        authCheck(thrownError);
                    });
                }
            });
        });
    });

    function loadMoreData(page, update = '') {
        search = $('#search').val();
        url = base_url + '/gateways?page=' + page + '&search=' + search;
        $.ajax({
                url: url,
                type: 'get',
                beforeSend: function() {
                    $(".loding").show();
                }
            })
            .done(function(data) {
                if (data.html == "") {
                    $('.loding').html("No more Record Found!");
                    return;
                }

                // chart();
                $('.loding').hide();
                //console.log("update = ",update);
                if (!update) {
                    $("#tbody").append(data.html);
                }

            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {

            });
    }

    var page = 1;
    // page scroll function
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            console.log("scroll page :" + page);
            loadMoreData(page);

        }
    });

    //Add New Gateway
    $("body").on("click", ".gatewayaddsubmit", function() {
        //    console.log("id = "+id);

        var formData = {
            gateway_name: $("#gateway_name").val(),
            prefix: $("#prefix").val(),
            username: $("#username").val(),
            password: $("#password").val(),
            auth_username: $("#auth_username").val(),
            realm: $("#realm").val(),
            from_user: $("#from_user").val(),
            from_domain: $("#from_domain").val(),
            proxy: $("#proxy").val(),
            register_proxy: $("#register_proxy").val(),
            outbound_proxy: $("#outbound_proxy").val(),
            expire_seconds: $("#expire_seconds").val(),
            register: $("#register").val(),
            retry_seconds: $("#retry_seconds").val(),
            ping: $("#ping").val(),
            caller_id_in_from: $("#caller_id_in_from").val(),
            channels: $("#channels").val(),
            hostname: $("#hostname").val(),
            outbound_default: $("#outbound_default").val(),
            table: "gateways",
            "_token": "{{ csrf_token() }}"
        };
        $.ajax({
            url: base_url + '/gateways_add_ajex',
            method: "POST",
            data: formData,
            success: function(result) {
                
                $(".border-danger").removeClass("border-danger");
                $(".invalid-tooltip").hide();
                if (result.error != 0) {
                    // $(".form-control").removeClass("border-danger").addClass("border-success");

                    // console.log(result.error != 0);
                    $.each(result.error, function(index, value) {
                        // $('#' + index).removeClass("border-sucess");
                        $('#' + index).addClass("border-danger").show();
                        $('.' + index).html(value).show();
                    });

                } else {

                    $(".border-danger").removeClass("border-danger");
                    $(".invalid-tooltip").hide();

                    if (result.status == 'danger' || result.status == 'fail') {
                        toster("danger", "Record", "Failed");
                    } else {
                        //  alert(result.data);
                        if (result.data > 0 || result.data != 'Update Sucessfully') {
                            $('#add-new-gateway').modal('hide').append('body');
                            $("#tbody").text("");
                            var page = 1;
                            loadMoreData(page);
                            setTimeout(function() {
                                toster("success", "Gateway", "Added");
                            }, 2000);
                        }
                    }
                }
            },
        });
    });

    $("body").on("click", ".delete", function() {
        // alert("hi");
        id = $(this).data('id');
        console.log("delete id = " + id);
        Swal.fire({
            title: "Are you sure?",
            text: "you want to delete this gateway?",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes",
            cancelButtonText: "No, cancel!",
            confirmButtonClass: "btn btn-success mt-2",
            cancelButtonClass: "btn btn-danger ms-2 mt-2",
            buttonsStyling: !1
        }).then(function(e) {
            if (e.isConfirmed) {

                var base_url = $('#base_url').val();

                var table = $('#gateways').val();
                var url = base_url + '/delete/' + id + '/' + table;

                $.ajax({
                    url: url,
                    method: "GET"
                }).done(function(data) {
                    // alert("hi");
                    if (data.status == 'danger' || data.status == 'fail') {
                        alert("data " + data.data);
                        if (data.data == "Record not exist") {
                            // alert("here");
                            toster("danger", "", "", "Record not found");
                            setTimeout(function() {
                                location.reload();
                            }, 3000);
                        } else {
                            toster("danger", '', "Fail");
                        }
                    } else {
                        $(".record" + id).remove();
                        toster("success", 'Gateway', "Deleted");
                    }
                });
            }
        });
    });

    $("#search").on("keyup search", function() {
        page = 1;

        if (($(this).val()).length > 2 || ($(this).val()).length == 0) {
            // if (($(this).val()).length > 2) {
            $("#tbody").text("");
            // console.log("search call page :" + page);
            loadMoreData(page);
        }
    });
</script>
@endsection