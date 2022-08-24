@extends('layouts.mainLayout.main')
@section('title', 'Agent Comission')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body min-vh-100">

            <div class="col-lg-12">
                <div class="text-lg-end col-lg-2" style="float:right;">
                    <!-- <span type="button" class="btn btn waves-effect waves-light mb-2 me-2 pe-none" id="balance_show"><i class="mdi mdi-basket me-1"></i> $ {{$comissions_total_amount}}</span> -->
                    <a type="button" class="waves-effect waves-light make-payment" data-bs-toggle="modal" data-bs-target="#make-payment"><i class="mdi mdi-plus-circle h3 text-primary"></i>Make Payment</a>
                    <!-- <a href="" class="btn btn-block btn-default">Make Payment</a>  -->
                    <!-- <button type="button" class="btn btn-light waves-effect mb-2">+</button> -->
                </div>
            </div><!-- end col-->

            <div class="row mb-2">
                <div class="col-lg-8">
                    <form class="d-flex flex-wrap align-items-center">

                        <label for="fortodate" class="me-2">From : </label>
                        <div class="me-3">
                            <input type="text" data-provide="datepicker" data-date-format="{{Config('const.datepicker-format')}}" data-date-autoclose="true" class="form-control my-1 my-lg-0 fromdate datesearch" id="fromdate" placeholder="From date">
                        </div>
                        <label for="fortodate" class="me-2">To : </label>
                        <div class="me-sm-3">
                            <input type="text" class="form-control my-1 my-lg-0 todate datesearch" data-provide="datepicker" data-date-format="{{Config('const.datepicker-format')}}" data-date-autoclose="true" id="todate" placeholder="To date">
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="text-lg-end">
                        <span type="button" class="btn btn-danger waves-effect waves-light mb-2 me-2 pe-none" id="balance_show"><i class="mdi mdi-basket me-1"></i> $ {{$comissions_total_amount}}</span>
                        <!-- <button type="button" class="btn btn-light waves-effect mb-2">+</button> -->
                    </div>
                </div><!-- end col-->
            </div>





            <div class="table-responsive border-0">
                <table id="agentcomission" class="table table-hover m-0 table-centered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Summary</th>
                            <th>Amount</th>
                            <th>Commission (%)</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Balance</th>
                            <th>Created</th>
                            <th>Tenant</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @isset($records)
                        @foreach($records as $data)
                        <tr>
                            <td>{{$data->summary}}</td>
                            <td>{{$data->amount}}</td>
                            <td>{{$data->commission_percentage}}</td>
                            <td>{{$data->debit}}</td>
                            <td>{{$data->credit}}</td>
                            <td>{{$data->balance}}</td>
                            <td>{{$data->created_date}}</td>
                            <td>{{$data->tenant_account_number?$data->tenant_account_number:'-'}}</td>
                        </tr>

                        @endforeach
                        @endisset

                    </tbody>
                </table>
            </div>
            <div class="text-center my-4">
                <a href="javascript:void(0);" class="text-danger loding" style="display:none"><i class="mdi mdi-spin mdi-loading me-1"></i> Load more </a>
            </div>







        </div> <!-- end card-body -->
    </div> <!-- end card-->
</div> <!-- end col-->

<div class="modal fade" id="make-payment" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">


                <h4 class="modal-title" id="myCenterModalLabel">Make payment to agent </h4>




                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form class="needs-validation1 was-validated1">

                    <div class="mb-3">
                        <label for="forpaymentdate" class="form-label">Payment Date *</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="form-control" id="payment_date" name="payment_date" value="<?php echo date('Y-m-d'); ?>" data-provide="datepicker" required>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="foramount" class="form-label">Amount *</label>
                        <input type="text" class="form-control" id="amount" placeholder="Amount" value="" required>
                        <div class="invalid-tooltip amount">
                            Amount cannot be blank.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="forpaymentmethod" class="form-label">Payment Method *</label>

                        <select class="form-control" name="payment_method" id="payment_method" required>
                            <option value="">Select Payment Method</option>
                            <option value="CASH">CASH</option>
                            <option value="CHEQUE">CHEQUE</option>
                            <option value="WIRE">WIRE</option>
                            <option value="VISA">VISA</option>
                            <option value="MASTERCARD">MASTERCARD</option>
                        </select>
                        <div class="invalid-tooltip paymentmethod">
                            Payment Method cannot be blank.
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="forreference_number" class="form-label">Reference Number *</label>
                        <input type="text" class="form-control" id="reference_number" placeholder="Reference Number" value="" required>
                        <div class="invalid-tooltip reference_number">
                            Reference Number cannot be blank.
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="button" class="btn btn-success waves-effect waves-light" data-bs-dismiss="modal">cancel</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light make-payment">submit</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script>
    var base_url = $('#base_url').val();
    $(document).ready(function() {
        
        var url;
        // load data function     
        function loadMoreData(page, update = '') {
            var fromdate = $("#fromdate").val() ? $("#fromdate").val() : '';
            var todate = $("#todate").val() ? $("#todate").val() : '';
            var search = $('#search').val() ? $('#search').val() : '';
            var id = $('#id').val();
            url = base_url + '/agentcomission/' + id + '?page=' + page + '&search=' + search + '&fromdate=' + fromdate + '&todate=' + todate;
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
                    $('.loding').hide();
                    //console.log("update = ",update);
                    if (!update) {
                        $("#tbody").append(data.html);
                        $("#balance_show").html('<i class="mdi mdi-basket me-1"></i> $' + data.comissions_total_amount)
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
                $("#agentlistrow").text("");
                console.log("search call page :" + page);
                loadMoreData(page);
            }
        });

        $('body').on('change', '.datesearch', function() {
            page = 1;
            $("#tbody").text("");
            console.log("search call page :" + page);
            loadMoreData(page);
        });
    });

    $("body").on("click", ".make-payment", function() {
                console.log("id = "+id);
            var formData = {
                payment_date: $("#payment_date").val(),
                amount: $("#amount").val(),
                payment_method: $("#payment_method").val(),
                reference_number: $("#reference_number").val(),

                table: "agent_commission_payment",
                "_token": "{{ csrf_token() }}"
            };
            $.ajax({
                url: base_url + '/agent_commission_payment_ajex',
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
                             alert(result.data);
                            if (result.data > 0 || result.data != ' Sucessfully') {
                                setTimeout(function() {
                                    toster("success", "payment", "make");
                                }, 4000);
                            }
                        }

                    }
                },
            });

        });

</script>



@endsection