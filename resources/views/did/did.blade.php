@extends('layouts.mainLayout.main')
@section('title', ' Phone Numbers')
@section('content')
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

                        <a type="button" class="waves-effect waves-light add-new-phone-import" data-bs-toggle="modal" data-bs-target="#add-new-phone-import"><i class="mdi mdi-import h3 text-primary"></i></a>
                        <a type="button" class="waves-effect waves-light add-new-phone" data-bs-toggle="modal" data-bs-target="#add-new-phone"><i class="mdi mdi-plus-circle h3 text-primary"></i></a>
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
    <div class="card mb-2">
        <div class="card-body mt-0 mb-0 pt-0 pb-0">
            <div class="row align-items-center">
                <div class="col-sm-4">
                    <div class="d-flex align-items-start">
                        <p class="mb-0 text-muted">Number</p>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="text-center my-3 my-sm-01">
                        <p class="mb-0 text-muted">Vendor</p>
                    </div>
                </div>
                <div class="col-sm-4">

                    <div class="text-center my-3 my-sm-01">
                        <p class="mb-0 text-muted">Company</p>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="text-sm-end text-center mt-2 mt-sm-0">
                        <p class="mb-0 text-muted">Status</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- title table header end -->
    <span id="phonelistrow">
        @foreach($records as $record)
        <!-- fist element of list start-->
        <?php
        $id = App\Providers\EncreptDecrept::encrept($record['id']);
        ?>

        <div class="card mb-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-sm-4">
                        <div class="d-flex align-items-start">
                            <!-- <img class="d-flex align-self-center me-3 rounded-circle" src="../assets/images/companies/amazon.png" alt="Generic placeholder image" height="64"> -->
                            <div class="w-100">
                                <h4 class="mt-01 mb-2 font-16"><span class="edit-inline-ajex" data-index="firstname" data-id="{{$id}}">{{$record['number']}} </span></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="text-center my-31 my-sm-0">
                            <p class="mb-0 text-muted">{{$record['vendor_name']}}</p>
                        </div>
                    </div>
                    <div class="col-sm-4">

                        <div class="text-center button-list">

                            <p class="mb-0 text-muted">{{$record['company_name']}} - {{$record['account_number']}}</p>
                            <!-- <a data-index="status" data-id="{{$id}}" data-value="{{$record['status']}}" class="btn btn-xs waves-effect waves-light status edit-inline-ajex status{{$id}}@if($record['status'] == 'ACTIVE') btn-success @else btn-danger @endif">Status : {{$record['status']}}</a>
                            <a data-id="{{$id}}" data-index="suspended" data-value="{{$record['suspended']}}" class="btn btn-xs waves-effect waves-light suspended edit-inline-ajex suspended{{$id}}@if($record['suspended'] == 'NO') btn-success @else btn-danger @endif">Suspended : {{$record['suspended']}}</a> -->
                            <!-- <a href="javascript: void(0);" class="btn btn-xs btn-primary waves-effect waves-light">Email</a> -->
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="text-sm-end text-center mt-2 mt-sm-0">
                            <!-- <span class="btn1 btn-xs waves-effect waves-light status{{$id}}@if($record['status'] == 'RESERVED') btn-success @else btn-danger @endif"> {{$record['status']}}</span> -->

                            <div class="text-center mt-3 mt-sm-0">
                                <div class="badge font1-14 bg-soft-info1 text-info1 @if($record['status'] == 'RESERVED') bg-soft-info text-info @elseif($record['status'] == 'AVAILABLE') bg-soft-success text-success @else bg-soft-danger text-danger @endif">{{$record['status']}}</div>
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
            <h4 class="header-title mb-3">Customers Statics</h4>

            <div class="text-center" dir="ltr">
                <div class="row mt-2">
                    <div class="col-6">
                        <h3 data-plugin="counterup" data-value="{{$totalrecords}}" class="totalrecords">{{$totalrecords}}</h3>
                        <p class="text-muted font-13 mb-0 text-truncate">Total</p>
                    </div>
                    <div class="col-6">
                        <h3 data-plugin="counterup" class="allocatednumber" data-value="{{$allocatednumber}}">{{$allocatednumber}}</h3>
                        <p class="text-muted font-13 mb-0 text-truncate">Allocated</p>
                    </div>
                    <div class="col-6">
                        <h3 data-plugin="counterup" class="reservednumber" data-value="{{$reservednumber}}">{{$reservednumber}}</h3>
                        <p class="text-muted font-13 mb-0 text-truncate">Reserved</p>
                    </div>
                    <div class="col-6">
                        <h3 data-plugin="counterup" class="availablenumber" data-value="{{$availablenumber}}">{{$availablenumber}}</h3>
                        <p class="text-muted font-13 mb-0 text-truncate">Available</p>
                    </div>
                    
                </div><br><br>
                
                
                <div id="distributed-series-d" class="ct-chart ct-golden-section"  style="height: 280px;"></div>
                <p class="text-muted font-15 font-family-secondary mb-0 mt-1 d-flex">
                    <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-blue"></i> T - Total</span>
                    <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-success"></i> A - Available</span>
                </p>
                <p class="text-muted font-15 font-family-secondary mb-0 mt-1 d-flex">
                   
                    <!-- <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-warning"></i> S - Suspended</span> -->
                    <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-danger"></i> AL - Allocated</span>
                    <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-info float-left"></i> R - Reserved</span>
                </p>
                
            </div>

        </div>
    </div> <!-- end card-->
</div> <!-- end col -->

<!-- class="modal fade" id="add-new-agent"  -->
<!-- Modal -->
<div class="modal fade" id="add-new-phone" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">Add New Opportunities</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form class="needs-validation1 was-validated1">
                    <div class="mb-3">

                        <label for="forvendor_id" class="form-label">Vendor</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class=" fab fa-odnoklassniki"></i></span>
                            <select class="form-control" name="vendor" id="vendor" required>
                                <option value="">Select</option>

                                @isset($vendor)
                                @foreach($vendor as $data)
                                <option value="{{$data->id}}">{{$data->vendor_name}}</option>
                                @endforeach
                                @endisset

                            </select>
                            <div class="invalid-tooltip vendor">
                                Please select valid Vendor.
                            </div>

                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="fornumber" class="form-label">Number</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                            <input type="text" class="form-control" id="number" placeholder="Number" value="" required>
                            <div class="invalid-tooltip number">
                                Please select valid Number.
                            </div>
                        </div>

                    </div>




                    <div class="mb-3">
                        <label for="forrate_center" class="form-label">Rate Center</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-percentage"></i></span>
                            <input type="text" class="form-control" id="rate_center" placeholder="Rate center" value="" required>
                            <div class="invalid-tooltip rate_center">
                                Please select Rate Center.
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="button" class="btn btn-success waves-effect waves-light" data-bs-dismiss="modal">cancel</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light phoneaddsubmit">submit</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal -->
<div class="modal fade" id="add-new-phone-import" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabelimport"> Import Phone Numbers</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form class="needs-validation1 was-validated1" name="phoneimportaddform" enctype="multipart/form-data" method="POST">
                    <div class="mb-3">

                        <label for="forvendor_id" class="form-label">Vendor</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class=" fab fa-odnoklassniki"></i></span>
                            <select class="form-control" name="vendor_import" id="vendor_import" required>
                                <option value="">Select</option>

                                @isset($vendor)
                                @foreach($vendor as $data)
                                <option value="{{$data->id}}">{{$data->vendor_name}}</option>
                                @endforeach
                                @endisset

                            </select>
                            <div class="invalid-tooltip vendor_import">
                                Please select valid Vendor.
                            </div>

                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="fornumber" class="form-label">Import Numbers</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class=" fas fa-cloud-upload-alt"></i></span>
                            <input type="file" class="form-control" id="file_import" placeholder="csv file" value="" accept=".csv" pattern="^.+\.(xlsx|xls|csv)$" required>
                            <div class="invalid-tooltip file_import">
                                Please select valid Number.
                            </div>
                        </div>

                    </div>
                    <div class="md-3">
                        <label for="fornumber" class="form-label">Sample file Download</label>
                        <div class="input-group">
                            <a class="btn btn-block btn-primary btn-sm" title="Download" href="/en/did/download"><i class="fa fa-download"></i> </a>
                        </div>

                    </div>
                    <br>

                    <div class="text-end">
                        <button type="button" class="btn btn-success waves-effect waves-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light phoneimportaddsubmit">Submit</button>
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

        // load data function     
        function loadMoreData(page, update = '') {
            search = $('#search').val();
            url = base_url + '/dids?page=' + page + '&search=' + search;
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
                    $('.allocatednumber').text(data.allocatednumber);
                    $('.reservednumber').text(data.reservednumber);
                    $('.availablenumber').text(data.availablenumber);

                    $('.totalrecords').data("value", data.totalrecords);
                    $('.allocatednumber').data("value", data.allocatednumber);
                    $('.reservednumber').data("value", data.reservednumber);
                    $('.availablenumber').data("value",data.availablenumber);

                    chart();
                    $('.loding').hide();
                    console.log("update = ", update);
                    if (!update) {
                        $("#phonelistrow").append(data.html);
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
        $("#search").on("keyup", function() {
            page = 1;

            if (($(this).val()).length > 2 || ($(this).val()).length == 0) {
            // if (($(this).val()).length > 2 ) {
                $("#phonelistrow").text("");
                console.log("search call page :" + page);
                loadMoreData(page);

            }
        });

        // add new phone number (dids) model
        $("body").on("click", ".phoneaddsubmit", function() {
            //   console.log("id = "+id);
            var formData = {
                vendor: $("#vendor").val(),
                number: $("#number").val(),
                rate_center: $("#rate_center").val(),

                table: "did",
                "_token": "{{ csrf_token() }}"
            };
            $.ajax({
                url: base_url + '/phone_add_ajex',
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
                            // alert(result.data);
                            if (result.data > 0 || result.data != 'Update Sucessfully') {
                                $('#add-new-phone').modal('hide');
                                setTimeout(function() { 
                                    toster("success", "Phone Number", "Added"); 
                                }, 4000);
                            }                           
                        }

                    }
                },
            });

        });
        $("#add-new-phone,#add-new-phone-import").on("hidden.bs.modal", function() {
            $(".border-danger").removeClass("border-danger");
            $(".invalid-tooltip").hide();
            $(this).find("input,textarea,select").val('').find("input[type=checkbox], input[type=radio]").prop("checked", "");
        });       

        // new phone number import csv add ajex code       
        $("body").on("click", ".phoneimportaddsubmit", function() {
            $(".border-danger").removeClass("border-danger");
            $(".invalid-tooltip").hide();
            var fd = new FormData();
            var files = $('#file_import')[0].files;
            var vendor_import = $("#vendor_import").val();
            // Check file selected or not
            if (files.length > 0) {
                fd.append('file', files[0]);
                fd.append('_token', "{{ csrf_token() }}");
                fd.append("vendor_import", vendor_import);
                $.ajax({
                    url: base_url + '/importinsert',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        $(".border-danger").removeClass("border-danger");
                        $(".invalid-tooltip").hide();
                        if (result.error != 0) {
                            $.each(result.error, function(index, value) {
                                
                                $('#'+index+'_import').addClass("border-danger").show();
                                $('.'+index+'_import').html(value).show();
                            });

                        } else {                    

                            if (result.status == 'danger' || result.status == 'fail') {
                                toster("danger", "Record", "Failed");
                            } else {

                                if (result.data > 0 || result.data != 'Update Sucessfully') {

                                    $('#add-new-phone-import').modal('hide');
                                    setTimeout(function() { 
                                        toster("success", "Phone Number", "Added");
                                    }, 4000);
                                    setTimeout( function(){ 
                                        location.reload();
                                    }  , 7000 );
                                }                                
                            }

                        }
                    },
                });
            } else {
                $('#file_import').addClass("border-danger").show();
                $('.file_import').html("Please select a file.").show();
                if(vendor_import.length < 1){
                    $('#vendor_import').addClass("border-danger").show();
                    $('.vendor_import').html("Please select vendor.").show();
                }
               
            }
        });

        // chart
        function chart(){
            // alert("chart");
            var data, option, total, allocatednumber, reservednumber, availablenumber;
            total =  $(".totalrecords").data("value");
            allocatednumber = $(".allocatednumber").data("value");
            reservednumber = $(".reservednumber").data("value");
            availablenumber = $(".availablenumber").data("value");
            
            // alert("total_agents = "+total_agents+", suspended_agents = "+suspended_agents+", active_agents"+active_agents);

            data = {
                // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                labels: ["T", "A", "", "AL", "R"],
                series: [total, availablenumber, '', allocatednumber, reservednumber]
            }
            option = { 
                distributeSeries: !0,            
                axisY: {
                    onlyInteger: true
                }                            
            };
            
            new Chartist.Bar("#distributed-series-d",data,option);
            
        }
        chart();

    });
</script>
@endsection