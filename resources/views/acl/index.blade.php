@extends('layouts.mainLayout.main')
@section('title', 'ACL')
@section('content')
<style>
    .ct-series-c {

        stroke: red !important;
    }
</style>

<div class="col-lg-8 order-lg-1 order-2">
    <div class="card mb-2">
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <form class="mb-2 mb-sm-0">
                        <label for="inputPassword2" class="visually-hidden">Search</label>
                        <input type="search" class="form-control" id="search" placeholder="Search...">
                    </form>
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end">
                        <!-- <button type="button" class="btn btn-success waves-effect waves-light me-1"><i class="mdi mdi-cog"></i></button> -->

                        <!-- <a type="button" class="waves-effect waves-light add-new-phone-import" data-bs-toggle="modal" data-bs-target="#add-new-phone-import"><i class="mdi mdi-import h3 text-primary"></i></a> -->
                        <a type="button" class="waves-effect waves-light add-new-acl" data-bs-toggle="modal" data-bs-target="#add-new-acl"><i class="mdi mdi-plus-circle h3 text-primary"></i></a>
                        <!-- <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#custom-modal"><i class="mdi mdi-plus-circle me-1"></i> Add Agent</button> -->
                    </div>
                    <div class="text-sm-end">
                        <!-- <button type="button" class="btn btn-success waves-effect waves-light me-1"><i class="mdi mdi-cog"></i></button> -->


                        <!-- <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#custom-modal"><i class="mdi mdi-plus-circle me-1"></i> Add Agent</button> -->
                    </div>
                </div><!-- end col-->
            </div>
        </div> <!-- end card-body-->
    </div> <!-- end card-->
    <!-- title table header start -->
    <input type="hidden" id="acl_nodes" value="acl_nodes">
    <div class="card mb-2">
        <div class="card-body mt-0 mb-0 pt-0 pb-0">
            <div class="row align-items-center">
                <div class="col-sm-4">
                    <div class="d-flex align-items-start">
                        <p class="mb-0 text-muted">CIDR</p>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="text-center my-3 my-sm-01">
                        <p class="mb-0 text-muted">Type</p>
                    </div>
                </div>
                <div class="col-sm-4">

                    <div class="text-center my-3 my-sm-01">
                        <p class="mb-0 text-muted">List</p>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="text-sm-end text-center mt-2 mt-sm-0">
                        <p class="mb-0 text-muted text-center">Action</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- title table header end -->
    <span id="acllist">
        @foreach($records as $record)
        <!-- fist element of list start-->
        <?php
        $id = App\Providers\EncreptDecrept::encrept($record['id']);
        ?>

        <div class="card mb-2" id="acl_nodes{{$id}}">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-sm-4">
                        <div class="d-flex align-items-start">
                            <!-- <img class="d-flex align-self-center me-3 rounded-circle" src="../assets/images/companies/amazon.png" alt="Generic placeholder image" height="64"> -->
                            <div class="w-100">
                                <h4 class="mt-01 mb-2 font-16"><span class="edit-inline-ajex" data-index="cidr" data-id="{{$id}}">{{$record['cidr']}} </span></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="text-center my-31 my-sm-0">
                            <!-- <p class="mb-0 text-muted"><span class="edit-inline-ajex" data-index="type" data-id="{{$id}}">{{$record['type']}} </span></p> -->
                            <a data-index="type" data-id="{{$id}}" data-value="{{$record['type']}}" class="btn btn-xs edit-inline-ajex waves-effect waves-light status  type{{$id}}@if($record['type'] == 'allow') btn-success @else btn-danger @endif">{{$record['type']}}</a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="text-center button-list">
                            <!-- <a type="button" class="waves-effect waves-light add-new-acl" data-bs-toggle="modal" data-bs-target="#add-new-acl"><i class="mdi mdi-plus-circle h3 text-primary"></i></a> -->
                            <p class="mb-0 text-muted"> <span class="change-acl-list list{{$id}}" data-bs-target="#change-acl-list" data-bs-toggle="modal" data-index="list" data-value="{{$record['list_id']}}" data-id="{{$id}}">{{$record['acl_name']}} </span> </p>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="text-sm-end text-center mt-2 mt-sm-0">
                            <!-- <span class="btn1 btn-xs waves-effect waves-light status{{$id}}@if($record['status'] == 'RESERVED') btn-success @else btn-danger @endif"> {{$record['status']}}</span> -->

                            <div class="text-center mt-3 mt-sm-0">
                                <a class="action-icon delete" data-id="{{$id}}" title="Delete Aclnodes"><i class="fa fa-trash text-danger h5"></i></a>

                            </div>
                        </div>
                    </div> <!-- end col-->
                </div> <!-- end row -->
            </div>
        </div> <!-- end card-->

        <!-- fist element of list end-->
        @endforeach
    </span>
    <div class="text-center my-4">
        <a href="javascript:void(0);" class="text-danger loding" style="display:none"><i class="mdi mdi-spin mdi-loading me-1"></i> Load more </a>
    </div>


</div> <!-- end col -->


<div class="col-lg-4 order-lg-2 order-1 right-sidebar">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-3">Acl Statics</h4>

            <div class="text-center" dir="ltr">
                <div class="row mt-2">
                    <div class="col-6">
                        <h3 data-plugin="counterup" data-value="{{$totalrecords}}" class="totalrecords">{{$totalrecords}}</h3>
                        <p class="text-muted font-13 mb-0 text-truncate">Total</p>
                    </div>
                    <div class="col-6">
                        <h3 data-plugin="counterup" data-value="{{$acltypeallow}}" class="acltypeallow">{{$acltypeallow}}</h3>
                        <p class="text-muted font-13 mb-0 text-truncate">Allow</p>
                    </div>
                    <div class="col-6">
                        <h3 data-plugin="counterup" data-value="{{$acltypedeny}}" class="acltypedeny">{{$acltypedeny}}</h3>
                        <p class="text-muted font-13 mb-0 text-truncate">Deny</p>
                    </div>
                </div><br><br>


                <div id="distributed-series-acl" class="ct-chart ct-golden-section" style="height: 280px;"></div>
                <p class="text-muted font-15 font-family-secondary mb-0 mt-1 d-flex">
                    <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-blue"></i> T - Total</span>
                    <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-success"></i> A - Allow</span>
                </p>

                <p class="text-muted font-15 font-family-secondary mb-0 mt-1 d-flex">

                    <!-- <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-warning"></i> S - Suspended</span> -->
                    <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-danger"></i> D - Deny</span>

                </p>

            </div>

        </div>
    </div> <!-- end card-->
</div> <!-- end col -->

<div class="modal fade" id="change-acl-list" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">Selece any one from lists</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form class="needs-validation1 was-validated1">
                    <div class="mb-3">
                        <label for="forlist" class="form-label">List</label>
                        <div class="input-group">
                            <input type="hidden" name="aclnodes_id" id="aclnodes_id" value="">
                            <span class="input-group-text"><i class=" fab fa-odnoklassniki"></i></span>
                            <select class="form-control" name="list" id="list" required>
                                <option value="">Select</option>
                                @isset($acllist)
                                @foreach($acllist as $data)
                                <option value="{{$data->id}}">{{$data->acl_name}}</option>
                                @endforeach
                                @endisset
                            </select>
                            <div class="invalid-tooltip list">
                                Please select valid List.
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-success waves-effect waves-light" data-bs-dismiss="modal">cancel</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light updateacllist">submit</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Modal -->
<div class="modal fade" id="add-new-acl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">Add New Acl</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form class="needs-validation1 was-validated1">
                    <div class="mb-3">
                        <label for="forcidr" class="form-label">CIDR *</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                            <input type="text" class="form-control" id="cidr" placeholder="CIDR" value="" required>
                            <div class="invalid-tooltip cidr">
                                CIDR cannot be blank.
                            </div>
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="fortype" class="form-label">Type *</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                            <!-- <input type="text" class="form-control" id="type" placeholder="Type" value="" required> -->
                            <select class="form-control" name="type" id="type" required>
                                <option value="">Select</option>
                                <option value="allow">allow</option>
                                <option value="deny">deny</option>
                            </select>
                            <div class="invalid-tooltip type">
                                Type cannot be blank.
                            </div>
                        </div>

                    </div>

                    <div class="mb-3">

                        <label for="forlist" class="form-label">List</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class=" fab fa-odnoklassniki"></i></span>
                            <select class="form-control" name="list" id="listacl" required>
                                <option value="">Select</option>

                                @isset($acllist)
                                @foreach($acllist as $data)
                                <option value="{{$data->id}}">{{$data->acl_name}}</option>
                                @endforeach
                                @endisset

                            </select>
                            <div class="invalid-tooltip list">
                                Please select valid List.
                            </div>

                        </div>

                    </div>
                    <div class="mb-3">

                        <label for="foris_endpoint" class="form-label">Endpoint *</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class=" fab fa-odnoklassniki"></i></span>
                            <select class="form-control" name="is_endpoint" id="is_endpoint" required>
                                <option value="">Select</option>
                                <option value="YES">YES</option>
                                <option value="No">No</option>
                            </select>
                            <div class="invalid-tooltip is_endpoint">
                                Please select is_endpoint List.
                            </div>

                        </div>

                    </div>


                    <div class="text-end">
                        <button type="button" class="btn btn-success waves-effect waves-light" data-bs-dismiss="modal">cancel</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light acladdsubmit">submit</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    $(document).ready(function() {
        var base_url = $('#base_url').val();
        var url;
        $('body').on('click', '.edit-inline-ajex', function() {
            var colIndex = $(this).data("index");
            var txt = $(this).text();
            var id = $(this).data("id");
            var value = $(this).text();
            if (txt.length > 1 && colIndex != 'delete' && colIndex != '0' && colIndex != 'type') {
                $.each($(".edit-column"), function(i, el) {
                    orignaltxt = $(this).val();
                    if (orignaltxt.length > 0) {
                        $(this).replaceWith(orignaltxt);
                    }
                });

                $(this).html("").append("<input type='text' class='edit-column' data-id=" + id + " data-index=" + colIndex + " value=\"" + txt + "\">");
            } else if (colIndex == 'type') {
                var id = $(this).data("id");
                var columnindex = $(this).data("index");
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
                            url: base_url + '/acl_update_ajex',
                            method: "POST",
                            data: {
                                id: id,
                                columnindex: columnindex,
                                value: value,
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(result) {
                                var feild;
                                // console.log(result);
                                if (result.status) {
                                    // console.log(value);
                                    if (value == "deny") {
                                        $("." + columnindex + id).removeClass("btn-danger").addClass("btn-success").html("allow").attr("data-value", "allow");
                                    } else if (value == "allow") {
                                        $("." + columnindex + id).removeClass("btn-success").addClass("btn-danger").html("deny").attr("data-value", "deny");
                                    }
                                    console.log("." + columnindex + id);
                                    feild = "Type";

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
                        });
                    }
                });
            }
        });


        // update editabel textbox value ajex
        $('body').on('change', '.edit-column', function() {
            var id = $(this).data("id");
            var columnindex = $(this).data("index");
            var value = $(this).val();
            //console.log("change event call id, columnindex, value  :",id, columnindex, value);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: base_url + '/acl_update_ajex',
                method: "POST",
                data: {
                    id: id,
                    columnindex: columnindex,
                    value: value,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(result) {
                    //console.log("ajex result :",result);
                    $.each($(".edit-column"), function(i, el) {
                        orignaltxt = $(this).val();
                        if (orignaltxt.length > 0) {
                            $(this).replaceWith(orignaltxt);
                        }
                    });
                    if (result.status == 'danger' || result.status == 'fail') {
                        if (result.data == "Record not exist") {
                            toster("danger", "", "", "Record not found");
                            // setTimeout( function(){ 
                            //location.reload();
                            // }  , 3000 );
                        } else {
                            toster("danger", "", "", "Something Wrong!");
                        }
                    } else {
                        toster("success", columnindex, "Updated");
                    }
                }
            });
        });


        // load data function     
        function loadMoreData(page, update = '') {
            search = $('#search').val();
            url = base_url + '/acl?page=' + page + '&search=' + search;
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

                    $('.totalrecords').text(data.totalrecords);
                    $('.acltypeallow').text(data.acltypeallow);
                    $('.acltypedeny').text(data.acltypedeny);


                    $('.totalrecords').data("value", data.totalrecords);
                    $('.acltypeallow').data("value", data.acltypeallow);
                    $('.acltypedeny').data("value", data.acltypedeny);


                    chart();


                    $('.loding').hide();
                    console.log("update = ", update);
                    if (!update) {
                        $("#acllist").append(data.html);
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


        // search function 
        $("#search").on("keyup search", function() {
            page = 1;

            if (($(this).val()).length > 2 || ($(this).val()).length == 0) {
                // if (($(this).val()).length > 2) {
                $("#acllist").text("");
                // console.log("search call page :" + page);
                loadMoreData(page);

            }
        });

        // add new acl
        $("body").on("click", ".acladdsubmit", function() {
            //    console.log("id = "+id);

            var formData = {
                cidr: $("#cidr").val(),
                type: $("#type").val(),
                list: $("#listacl").val(),
                is_endpoint: $("#is_endpoint").val(),

                table: "acl_nodes",
                "_token": "{{ csrf_token() }}"
            };
            $.ajax({
                url: base_url + '/acl_add_ajex',
                method: "POST",
                data: formData,
                success: function(result) {

                    $(".border-danger").removeClass("border-danger");
                    $(".invalid-tooltip").hide();
                    if (result.error != 0) {
                        $.each(result.error, function(index, value) {

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
                                $('#add-new-acl').modal('hide').append('body');
                                $("#acllist").text("");
                                var page = 1;
                                loadMoreData(page);
                                setTimeout(function() {
                                    toster("success", "Acl", "Added");
                                }, 2000);
                            }
                        }

                    }
                },
            });

        });
        $("#add-new-acl").on("hidden.bs.modal", function() {
            $(".border-danger").removeClass("border-danger");
            $(".invalid-tooltip").hide();
            $(this).find("input,textarea,select").val('').find("input[type=checkbox], input[type=radio]").prop("checked", "");
        });

        $("body").on("click", ".delete", function() {
            id = $(this).data('id');
            console.log("delete id = " + id);
            Swal.fire({
                title: "Are you sure?",
                text: "you want to delete this ACL?",
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

                    var table = $('#acl_nodes').val();
                    var url = base_url + '/delete/' + id + '/' + table;

                    $.ajax({
                        url: url,
                        method: "GET"
                    }).done(function(data) {
                        if (data.status == 'danger' || data.status == 'fail') {
                            alert("data " + data.data);
                            if (data.data == "Record not exist") {
                                alert("here");
                                toster("danger", "", "", "Record not found");
                                setTimeout(function() {
                                    location.reload();
                                }, 3000);
                            } else {
                                toster("danger", '', "Fail");
                            }
                        } else {
                            toster("success", 'Acl', "Deleted");


                            $("#acl_nodes" + id).remove();
                        }
                    });
                }
            });
        });

        function chart() {
            // alert("chart");
            var data, option, total, acltypedeny, acltypeallow;
            total = $(".totalrecords").data("value");
            acltypeallow = $(".acltypeallow").data("value");
            acltypedeny = $(".acltypedeny").data("value");

            // alert("total_agents = "+total_agents+", suspended_agents = "+suspended_agents+", active_agents"+active_agents);

            data = {
                // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],

                labels: ["T", "A", "", "D"],
                series: [total, acltypeallow, , acltypedeny]
            }
            option = {
                distributeSeries: !0,
                axisY: {
                    onlyInteger: true
                }
            };

            new Chartist.Bar("#distributed-series-acl", data, option);

        }
        chart();

        // open modal for List
        $('body').on('click', '.change-acl-list', function() {
            // alert("hi");
            let value = $(this).data("value");
            let id = $(this).data("id");
            console.log(id);
            $('#list').val(value);
            $('#aclnodes_id').val(id);

        });

        $('body').on('click', '.updateacllist', function() {
            // alert("hello");
            var base_url = $('#base_url').val();
            var id = $('#aclnodes_id').val();
            var value = $('#list').val();
            var text = $('#list').find(":selected").text();
            // alert(text);
            var columnindex = "list_id";

            var formData = {
                id: $('#aclnodes_id').val(),
                value: $('#list').val(),
                columnindex: "list_id",
                "_token": $("#token").val()
            };

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: base_url + '/acl_update_ajex',
                method: "POST",
                data: formData
            }).done(function(result) {
                // console.log(res);
                //"Updated data successfully\n";
                //IF ALL IS OK!!
                if (result.status == 'danger' || result.status == 'fail') {
                    if (result.data == "Record not exist") {
                        toster("danger", "", "", "Record not found");
                        // setTimeout( function(){ 
                        //location.reload();
                        // }  , 3000 );
                    } else {
                        toster("danger", "", "", "Something Wrong!");
                    }
                } else {
                    $('#change-acl-list').modal('hide');
                    $('.list' + id).text(text);
                    // console.log('selector = list'+id);
                    toster("success", "List", "Updated");
                }
            });

        });
    });
</script>

@endsection