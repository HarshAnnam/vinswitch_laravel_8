@extends('layouts.mainLayout.main')
@section('title', 'Customers')
@section('content')
<style>
    .modal-dialog {
    max-width: 80%;
   
}
</style>
<input type="hidden" name="current_page" class="current_page" id="current_page" value="1">             

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
                        <a type="button" class="waves-effect waves-light add-new-agent" data-bs-toggle="modal" data-bs-target="#add-new-agent"><i class="mdi mdi-plus-circle h3 text-primary"></i></a>                        
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
                    <p class="mb-0 text-muted">Detail</p>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="text-center my-3 my-sm-01">
                        <p class="mb-0 text-muted">Balance</p>
                    </div>
                </div>
                <div class="col-sm-4">     
                    
                    <div class="text-center my-3 my-sm-01">
                        <p class="mb-0 text-muted">Status</p>
                    </div>
                </div>
                
                <div class="col-sm-2">
                    <div class="text-sm-end text-center mt-2 mt-sm-0">
                        <p class="mb-0 text-muted">Action</p>
                    </div>
                </div> 
            </div> 
        </div>
    </div> 
    <!-- title table header end -->
    <span id="customerrow">
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
                        <div class="w-100">
                            <h4 class="mt-0 mb-2 font-16"><span class="edit-inline-ajex" data-index="firstname" data-id="{{$id}}">{{$record['first_name']}} </span><span class="edit-inline-ajex" data-index="lastname" data-id="{{$id}}"> {{$record['last_name']}}</span></h4>
                            <p class="mb-1"><b>Company :</b> <span class="edit-inline-ajex" data-index="company_name" data-id="{{$id}}">{{$record['company_name']}}</span></p>
                            <p class="mb-0 w-100"><!-- <b>Email :</b> --> {{$record['email']}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="text-center my-3 my-sm-01">
                        <p class="mb-0 text-muted">{{$record['balance']}}</p>
                    </div>
                </div>
                <div class="col-sm-4">     
                    
                    <div class="text-center button-list">
                        <span data-index="status" data-id="{{$id}}" data-value="{{$record['status']}}" class="btn btn-xs waves-effect1 waves-light1 status edit-inline-ajex status{{$id}}@if($record['status'] == 'ACTIVE') btn-success @else btn-danger @endif" style="cursor: text;pointer-events:none;">Status : {{$record['status']}}</span>
                        <a data-id="{{$id}}" data-index="suspended" data-value="{{$record['suspended']}}" class="btn btn-xs waves-effect waves-light suspended edit-inline-ajex suspended{{$id}}@if($record['suspended'] == 'NO') btn-success @else btn-danger @endif">Suspended : {{$record['suspended']}}</a>                        
                    </div>
                </div>
                
                <div class="col-sm-2">
                    <div class="text-sm-end text-center mt-2 mt-sm-0">
                        <a href="{{url('tenanat/edit').'/'.$id}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>                        
                        <a class="action-icon"> <i class="fas fa-link fa-sm"></i></a>
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
                        <h3 data-plugin="counterup" class="activetenant" data-value="{{$activetenant}}">{{$activetenant}}</h3>
                        <p class="text-muted font-13 mb-0 text-truncate">Active</p>
                    </div>
                    <div class="col-6">
                        <h3 data-plugin="counterup" class="suspendedtenant" data-value="{{$suspendedtenant}}">{{$suspendedtenant}}</h3>
                        <p class="text-muted font-13 mb-0 text-truncate">Suspended</p>
                    </div>
                    
                </div><br><br>
                
                
                <div id="distributed-series1" class="ct-chart ct-golden-section"  style="height: 280px;"></div>
                <p class="text-muted font-15 font-family-secondary mb-0 mt-1 d-flex">
                    <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-blue"></i> T - Total</span>
                    <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-success"></i> A - Active</span>
                </p>
                <p class="text-muted font-15 font-family-secondary mb-0 mt-1 d-flex">
                   
                    <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-warning"></i> S - Suspended</span>
                    <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-danger"></i> I - Inactive</span>
                </p>
                <p class="text-muted font-15 font-family-secondary mb-0 mt-1 d-flex">
                    <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-info float-left"></i> N - Non-Suspended</span>
                </p>
            </div>

        </div>
    </div> <!-- end card-->
</div> <!-- end col -->

<!-- Modal -->
<div class="modal fade" id="add-new-agent" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">Add New Customer</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
            <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills nav-fill navtab-bg">
                    <li class="nav-item">
                        <a href="#personal" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                            Information
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#cred" aria-expanded="false" class="nav-link ">
                            Credential
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#bill"  aria-expanded="false" class="nav-link">
                            Billing
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="personal">

                        <form class="needs-validation1 was-validated1" id="agentaddform" novalidate>
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="agentaddid" id="agentaddid" value="0" />
                            <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle me-1"></i> Personal Info</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">

                                        <label for="forfirstname" class="form-label">First Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                            <input type="text" class="form-control" id="firstname" placeholder="First Name" value="" minlength="3" required>
                                            <div class="invalid-tooltip firstname">
                                                Please Enter valid First Name.
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="forlastname" class="form-label">Last Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                            <input type="text" class="form-control" id="lastname" placeholder="Last Name" value="" minlength="3" required>
                                            <div class="invalid-tooltip lastname">
                                                Please Enter valid Last Name.
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="foremail" class="form-label">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input type="text" class="form-control" id="email" placeholder="Email" value="">
                                            <div class="invalid-tooltip email">
                                                Please Enter valid Last Name.
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="forcontact_no" class="form-label">Phone</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                            <input type="text" class="form-control" id="contact_no" placeholder="Phone" value="" minlength="10" required>
                                            <div class="invalid-tooltip contact_no">
                                                Please Enter valid Phone Number.
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->

                           
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="foraddress" class="form-label">Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                                            <textarea class="form-control" id="address" placeholder="Address"></textarea minlength="5" required>
                                            <div class="invalid-tooltip address">
                                                Please Enter valid Address.
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div> <!-- end row -->

                            

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="forCountry" class="form-label">Country</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-city"></i></span>
                                            <input type="text" class="form-control" id="country" placeholder="Country" value="">
                                            <div class="invalid-tooltip country">
                                                Please Enter valid Country.
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="forstate" class="form-label">State</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                            <input type="text" class="form-control" id="state" placeholder="State" value="" minlength="2" required>
                                            <div class="invalid-tooltip state">
                                                Please Enter valid State.
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div> <!-- end row -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="forcity" class="form-label">City</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-map-signs"></i></span>
                                            <input type="text" class="form-control" id="city" placeholder="City" value="" minlength="2" required>
                                            <div class="invalid-tooltip city">
                                                Please Enter valid City.
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="forzipcode" class="form-label">Zipcode</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-qrcode"></i></span>
                                            <input type="text" class="form-control" id="postal_code" placeholder="Zipcode" value="" minlength="6" required>
                                            <div class="invalid-tooltip postal_code">
                                                Please Enter valid Zipcode.
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div> <!-- end row -->                    
                            
                            <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building me-1"></i> Company Info</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="forcompany_name" class="form-label">Company Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class=" far fa-building"></i></span>
                                            <input type="text" class="form-control" id="company_name" placeholder="Company Name" value="">
                                            <div class="invalid-tooltip company_name">
                                                Please Enter valid Company Name.
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                            </div> <!-- end row -->

                            
                            <div class="text-end">
                                <span class="btn btn-success waves-effect waves-light mt-2 tenantaddsubmit"><i class="mdi mdi-content-save"></i> Save</span>
                            </div>
                        </form>

                    </div> <!-- end tab-pane -->
                    <!-- end Information section content -->

                    <div class="tab-pane" id="cred">

                        <!-- cred box -->
                        <form>
                            <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle me-1"></i> Personal Info</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">

                                        <label for="forfirstname_user" class="form-label">First Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                            <input type="text" class="form-control" id="firstname_user" placeholder="First Name" value="">
                                            <div class="invalid-tooltip firstname_user">
                                                Please Enter valid First Name.
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="forlastname_user" class="form-label">Last Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                            <input type="text" class="form-control" id="lastname_user" placeholder="Last Name" value="">
                                            <div class="invalid-tooltip lastname_user">
                                                Please Enter valid Last Name.
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="foremail_user" class="form-label">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input type="text" class="form-control" id="email_user" placeholder="Email" value="">
                                            <div class="invalid-tooltip email_user">
                                                Please Enter valid email.
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="forcontact_no_user" class="form-label">Phone</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                            <input type="text" class="form-control" id="contact_no_user" placeholder="Phone" value="">
                                            <div class="invalid-tooltip contact_no_user">
                                                Please Enter Phone Number.
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="forusername" class="form-label">Username</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input type="text" class="form-control" id="username" placeholder="Username" value="">
                                            <div class="invalid-tooltip username">
                                                Please Enter valid email.
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="forpassword" class="form-label">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                            <input type="password" class="form-control" id="hori-pass1" placeholder="password" value="">
                                            <div class="invalid-tooltip contact_no_user">
                                                Please Enter Phone Number.
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                           
                           

                            
                  
                            
                            <div class="text-end">
                                <span class="btn btn-success waves-effect waves-light mt-2 credaddsubmit"><i class="mdi mdi-content-save"></i> Save</span>
                            </div>
                        </form>
                        <!-- end cred box -->
                       
                    </div>
                    <!-- end Credential content-->
                    
                    <div class="tab-pane" id="bill">
                        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle"></i> Plan Detail  </h5>

                        <div class="row align-items-start mb-3 add-more-div">                           
                            <div class="col">
                                <div class="input-group">
                                    <span class="input-group-text bg-primary add-more" ><i class="fe-plus text-white"></i></span>
                                    <span class="input-group-text"><i class="fas fa-clipboard-list"></i></span>
                                    <select class="form-control billplan_id" name="billplan_id[]" required>
                                        <option value="">Select Bill Plan</option>
                                        @foreach($billplan_list as $plan)
                                            <option value="{{$plan->id}}">{{$plan->name}}</option>
                                        @endforeach                                        
                                    </select>
                                    <div class="invalid-tooltip billplan_id-error offset-2">
                                        Please choose a plan.
                                    </div>
                                </div>
                            </div>                            
                            <div class="col">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-percentage"></i></span>
                                    <input type="text" class="form-control commission_enter commission" name="commission_enter[]"  placeholder="Commission" aria-describedby="inputGroupPrepend" required="">
                                    <div class="invalid-tooltip commission-error offset-1">
                                    Please enter commission.
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="add-more-html"style="display:none">

                            <div class="row align-items-start mb-3 add-more-div-count">                           
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text bg-danger add-more-remove" ><i class="fe-minus text-white"></i></span>
                                        <span class="input-group-text"><i class="fas fa-clipboard-list"></i></span>
                                        <select class="form-control billplan_id" name="billplan_id[]" required>
                                            <option value="">Select Bill Plan</option>
                                            @foreach($billplan_list as $plan)
                                                <option value="{{$plan->id}}">{{$plan->name}}</option>
                                            @endforeach                                        
                                        </select>
                                        <div class="invalid-tooltip billplan_id-error offset-2">
                                            Please choose a plan.
                                        </div>
                                    </div>
                                </div>                            
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-percentage"></i></span>
                                        <input type="text" class="form-control commission_enter commission" name="commission_enter[]"  placeholder="Commission" aria-describedby="inputGroupPrepend" required="">
                                        <div class="invalid-tooltip commission-error offset-1">
                                        Please enter commission.
                                        </div>
                                    </div>
                                </div>
                            </div>                         

                        </div>
                        




                        <div class="text-end">
                                <span class="btn btn-success waves-effect waves-light mt-2 billplanaddsubmit"><i class="mdi mdi-content-save"></i> Save</span>
                            </div>
                      


                        @if(isset($billplan))                       
                        <input type="hidden" name="bill_plan" id="bill_plan" class="bill_plan" value="agent_billplan" />
                        <div class="table-responsive border-0">
                            <table class="table table-borderless mb-0 table-centered dt-responsive nowrap w-100">
                                
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Commission(%)</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="planlistrow">
                                    <?php
                                        // echo "<pre>";
                                        // print_r(count($billplan));
                                        // echo "</pre>";
                                        $i=0;
                                    ?>
                                   
                                    @foreach($billplan as $record)
                                    @php
                                        $id = App\Providers\EncreptDecrept::encrept($record['agent_billplan_id']);
                                    @endphp                                
                                        <tr id="billplanrow{{$id}}">
                                            <td>{{++$i}} </td>
                                            <td>{{$record['name']}}</td>
                                            <td>{{$record['type']}}</td>                                            
                                            <td> <span class="edit-inline-ajex" data-index="commission" data-id="{{$id}}">{{$record['commission']}}</span></td>
                                            <td><a class="float-end text-danger delete" data-id="{{$id}}" title="Delete BillPlan" ><i class="fa fa-trash"></i></a></td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            <div class="text-center my-4">
                                <a href="javascript:void(0);" class="text-danger loding" style="display:none"><i class="mdi mdi-spin mdi-loading me-1"></i> Load more </a>
                            </div>
                        </div>                        
                        @endif
                    </div>
                    <!-- end Bill plan content-->

                </div> <!-- end tab-content -->
            </div>
        </div> <!-- end card-->

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




                                                   
<script>    
$(document).ready( function () {
    var base_url = $('#base_url').val();
    var url;
    // update status, suspended fild value
    // convert editabel feild firstname, lastname, company_name
    // $('body').on('click', '.edit-inline-ajex', function() { 
    //     var colIndex = $(this).data("index");
    //     var txt = $(this).text();
    //     var id = $(this).data("id");
    //     var value = $(this).text();
    //     if(txt.length > 1 && colIndex != 'status' && colIndex != 'suspended'){
    //         $.each($(".edit-column"), function(i, el) {
    //             orignaltxt = $(this).val();
    //             if(orignaltxt.length > 0){
    //                 $(this).replaceWith(orignaltxt);                
    //             }                
    //         });
       
    //         $(this).html("").append("<input type='text' class='edit-column' data-id="+id+" data-index="+colIndex+" value=\""+txt+"\">");
    //     }else if(colIndex == 'status' || colIndex == 'suspended'){
    //         var id = $(this).data("id");
    //         var columnindex = $(this).data("index");

    //         Swal.fire({
    //             title: "Are you sure?",
    //             text: "You want to change "+columnindex,
    //             icon: "warning",
    //             showCancelButton: !0,
    //             confirmButtonText: "Yes",
    //             cancelButtonText: "No, cancel!",
    //             confirmButtonClass: "btn btn-success mt-2",
    //             cancelButtonClass: "btn btn-danger ms-2 mt-2",
    //             buttonsStyling: !1
    //         }).then(function(e) {
    //             if(e.isConfirmed){
    //                 if(columnindex == "status"){
    //                     value = value.replace('Status : ','');
    //                 }else{
    //                     value = value.replace('Suspended : ','');
    //                 }           
    //                 $.ajax({
    //                     headers: {
    //                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                     },
    //                     url: base_url+'/agentlist_update_ajex',
    //                     method: "POST",
    //                     data:{id:id,columnindex:columnindex,value:value,"_token":"{{ csrf_token() }}"},
    //                     success: function(result){
    //                         var feild;
    //                         if(result.status){
    //                             if(columnindex == "status"){
    //                                 if(value == "INACTIVE" ){
    //                                     $("."+columnindex+id).removeClass("btn-danger").addClass("btn-success").html("Status : ACTIVE").attr("data-value","ACTIVE");
    //                                 }else if(value == "ACTIVE"){
    //                                     $("."+columnindex+id).removeClass("btn-success").addClass("btn-danger").html("Status : INACTIVE").attr("data-value","INACTIVE");
    //                                 }
    //                                 feild = "Status";     
    //                             }else if(columnindex == "suspended"){
    //                                 if(value == "NO"){
    //                                     $("."+columnindex+id).removeClass("btn-success").addClass("btn-danger").html("Suspended : YES").attr("data-value","YES");
    //                                 }else if(value == "YES"){
    //                                    $("."+columnindex+id).removeClass("btn-danger").addClass("btn-success").html("Suspended : NO").attr("data-value","NO");

    //                                 }  
    //                                 feild = "Suspended";                                   
    //                             }
    //                             if(result.status == 'danger' || result.status == 'fail'){
    //                                 if(result.data == "Record not exist"){
    //                                     toster("danger", "", "","Record not found");
    //                                     setTimeout( function(){ 
    //                                         location.reload();
    //                                     }  , 3000 );
    //                                 }else{
    //                                     toster("danger", "", "","Something Wrong!");
    //                                 }
    //                             }else{
    //                                 toster("success", feild, "updated");
    //                             } 
                                                              
    //                         }
    //                         loadMoreData(1,'update');
    //                     },         
    //                 });                    
    //             }                
    //         });
    //     }
    // });
    // update editabel textbox value ajex
    // $('body').on('change', '.edit-column', function() {         
    //     var id = $(this).data("id");
    //     var columnindex = $(this).data("index");
    //     var value = $(this).val();
    //     //console.log("change event call id, columnindex, value  :",id, columnindex, value);
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         url: base_url+'/agentlist_update_ajex',
    //         method: "POST",
    //         data:{id:id,columnindex:columnindex,value:value,"_token":"{{ csrf_token() }}"},
    //         success: function(result){
    //             //console.log("ajex result :",result);
    //             $.each($(".edit-column"), function(i, el) {
    //                 orignaltxt = $(this).val();
    //                 if(orignaltxt.length > 0){
    //                     $(this).replaceWith(orignaltxt);                
    //                 }                
    //             });
    //             if(result.status == 'danger' || result.status == 'fail'){
    //                 if(result.data == "Record not exist"){
    //                     toster("danger", "", "","Record not found");
    //                     setTimeout( function(){ 
    //                         location.reload();
    //                     }  , 3000 );
                        
    //                 }else{
    //                     toster("danger", "", "","Something Wrong!");
    //                 } 

    //             }else{
    //                 toster("success", columnindex, "Updated");
    //             }
                
                 
    //         },           
    //     });
    // });
    // load data function     
    function loadMoreData(page,update='')
    {
        search = $('#search').val();
        url = base_url+'/customers?page=' + page + '&search=' + search;
        $.ajax({
            url:url,
            type:'get',
            beforeSend: function()
            {
                $(".loding").show();               
            }
        })
        .done(function(data){
            if(data.html == ""){
                $('.loding').html("No more Record Found!");
                return;
            }
            $('.totalrecords').text(data.totalrecords);
            $('.activetenant').text(data.activetenant);
            $('.suspendedtenant').text(data.suspendedtenant);

            $('.totalrecords').data("value", data.totalrecords);
            $('.activetenant').data("value", data.activetenant);
            $('.suspendedtenant').data("value", data.suspendedtenant);
            
            chart();
            $('.loding').hide();
            //console.log("update = ",update);
            if(!update){
                $("#customerrow").append(data.html);
            }
            
        })
        .fail(function(jqXHR,ajaxOptions,thrownError){
            
        });
 
    }
    var page = 1;
    // page scroll function
    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() >= $(document).height()){
         page++;
         console.log("scroll page :"+page);
         loadMoreData(page);
         
      }
    });
    // search function 
    $("#search").on("keyup", function() {
        page = 1;
       
        if(($(this).val()).length > 2 || ($(this).val()).length == 0){
        // if(($(this).val()).length > 2){
            $("#customerrow").text("");
            console.log("search call page :"+page);
            loadMoreData(page);

        }
    });
    
    function chart(){
        // alert("chart");
        var data, option, total_tenant, suspended_tenant, active_tenant;
        total_tenant =  $(".totalrecords").data("value");
        suspended_tenant = $(".suspendedtenant").data("value");
        active_tenant = $(".activetenant").data("value");
        
        // alert("total_tenant = "+total_tenant+", suspended_tenant = "+suspended_tenant+", active_tenant"+active_tenant);

        data = {
            // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            labels: ["T", "A", "S", "I", "N"],
            series: [total_tenant, active_tenant, suspended_tenant, (total_tenant-active_tenant), (total_tenant-suspended_tenant)]
        }
        option = { 
            distributeSeries: !0,            
            axisY: {
                onlyInteger: true
            }                            
        };
        
        new Chartist.Bar("#distributed-series1",data,option);
        
    }
    chart(); 
    
    // add new agent model
    $("body").on("click", ".tenantaddsubmit", function(){        
    //   console.log("id = "+id);
        var formData = {
            id: $(this).data('id') ? $(this).data('id') : 0,
            firstname: $("#firstname").val(),
            lastname: $("#lastname").val(),
            email: $("#email").val(),
            contact_no: $("#contact_no").val(),                
            address: $("#address").val(),
            country: $("#country").val(),
            state: $("#state").val(),
            city: $("#city").val(),
            postal_code: $("#postal_code").val(),
            company_name: $("#company_name").val(),
            table: "tenant",
            "_token":$("#token").val()
        };            
        $.ajax({            
            url: base_url+'/customers/add_ajex',
            method: "POST",
            data:formData,
            success: function(result){
                var selector;
                $(".border-danger").removeClass("border-danger");
                $(".invalid-tooltip").hide();
                if(result.error !=0){                        
                        $.each(result.error, function(index, value){         
                                                       
                            $('#'+index).addClass("border-danger").show();
                            $('.'+index).html(value).show();
                        });

                }else{
                    $(".border-danger").removeClass("border-danger");
                    $(".invalid-tooltip").hide();
                                        
                    if(result.status == 'danger' || result.status == 'fail'){
                        // toster("danger", "Record", "Failed");
                    }else{
                        // alert(result.data);
                        if(result.data > 0 || result.data != 'Update Sucessfully'){
                            $(".tenantaddsubmit").attr("data-id",result.data);
                        }
                        

                        $(".nav-link").removeClass("active").attr("aria-expanded", "false");
                        $(".tab-pane").removeClass("show").removeClass("active");
                        $("#cred").addClass("show active");
                        $(".nav-link[href='#cred']").addClass("active").attr("aria-expanded", "true").attr("data-bs-toggle", "tab");
                        // toster("success", "Record", "Added"); href="#cred"
                    }

                }              
            },           
        });      
        
    });
    // // new credential add ajex code
    // $("body").on("click", ".credaddsubmit", function(){
    //     // alert("cred submit");
    //     var formData = {
    //         id: $(this).data('id') ? $(this).data('id') : 0,
    //         firstname_user: $("#firstname_user").val(),
    //         password: $("#hori-pass1").val(),
    //         lastname_user: $("#lastname_user").val(),
    //         email_user: $("#email_user").val(),
    //         contact_no_user: $("#contact_no_user").val(), 
    //         agent_id: $(".tenantaddsubmit").attr("data-id"),              
    //         table: "user",
    //         "_token":$("#token").val()
    //     };            
    //     $.ajax({            
    //         url: base_url+'/agent_cred_add_ajex',
    //         method: "POST",
    //         data:formData,
    //         success: function(result){
    //             var selector;
    //             $(".border-danger").removeClass("border-danger");
    //             $(".invalid-tooltip").hide();
    //             if(result.error !=0){                        
    //                     $.each(result.error, function(index, value){         
                                                       
    //                         $('#'+index).addClass("border-danger").show();
    //                         $('.'+index).html(value).show();
    //                     });

    //             }else{
    //                 $(".border-danger").removeClass("border-danger");
    //                 $(".invalid-tooltip").hide();
                                        
    //                 if(result.status == 'danger' || result.status == 'fail'){
                        
    //                 }else{
                        
    //                     if(result.data > 0 || result.data != 'Update Sucessfully'){
                            
    //                         $(".credaddsubmit").attr("data-id",result.data);
    //                     }
                        

    //                     $(".nav-link").removeClass("active").attr("aria-expanded", "false");
    //                     $(".tab-pane").removeClass("show").removeClass("active");
    //                     $("#bill").addClass("show active");
    //                     $(".nav-link[href='#bill']").addClass("active").attr("aria-expanded", "true").attr("data-bs-toggle", "tab");
                        
    //                 }

    //             }              
    //         },           
    //     });
        
    // }); 

    // // when cloase model - set default tab, remove data
    // $("#add-new-agent").on("hidden.bs.modal", function() {        
    //     $(".tenantaddsubmit").removeAttr("data-id");
    //     $(".credaddsubmit").removeAttr("data-id");
    //     $(".nav-link").removeClass("active").attr("aria-expanded", "false");
    //     $(".tab-pane").removeClass("show").removeClass("active");
    //     $("#personal").addClass("show active");
    //     $(".nav-link[href='#personal']").addClass("active").attr("aria-expanded", "true"); 
    //     $(this).find("input,textarea,select").val('').find("input[type=checkbox], input[type=radio]").prop("checked", "");       
    // });
    // $('#add-new-agent').modal({backdrop: 'static', keyboard: false}) 
    // $('body').on('click', '.add-more', function() {
    //     let addmorediv = $('.add-more-html').html();
    //     $('.add-more-div').after(addmorediv);
    // });
    // $('body').on('click', '.add-more-remove', function() {
    //     $(this).closest(".add-more-div-count").remove();
       
    // });
    
    // $('body').on('click', '.billplanaddsubmit', function() {
    //     let billplan_id = [];
    //     let commission = [];
    //     $('.billplan_id').each(function(){
    //         billplan_id.push($(this).val());
    //     });
    //     $('.commission_enter').each(function(){
    //         commission.push($(this).val());
    //     });
    //     billplan_id.pop();
    //     commission.pop();
    //     // console.log(billplan_id);
    //     // console.log(commission);
    //     // console.log($(".tenantaddsubmit").data('id'));
    //     var formData = {
    //         agent_id: $(".tenantaddsubmit").data('id') ? $(".tenantaddsubmit").data('id') : 0,
    //         billplan_id: billplan_id,
    //         commission: commission,                         
    //         table: "agent_billplan",
    //         "_token":$("#token").val()
    //     };            
    //     $.ajax({            
    //         url: base_url+'/agent_bill_plan_add_ajex',
    //         method: "POST",
    //         data:formData,
    //         success: function(result){
    //             $(".border-danger").removeClass("border-danger");
    //             $(".invalid-tooltip").hide();
    //             let i = 0;
    //             var myString, index, indexid, indexvalue,feild1,feild2,message;
    //             if(result.error !=0){                        
    //                     $.each(result.error, function(index, value){ 
    //                         myString = index.split(".");
    //                         indexvalue = myString[0];
    //                         indexid = parseInt(myString[1]);
    //                         feild1 = "."+indexvalue;
    //                         feild2 = "."+indexvalue+"-error";
    //                         message = value[0].replace(/\d+/g, '').replace('_id', '').replace('.', '');
                            
    //                         $("."+indexvalue).eq(indexid).addClass("border-danger");
    //                         $("."+indexvalue+"-error").eq(indexid).show().html(message);

                            
    //                     });

    //             }else{               
                                        
    //                 if(result.status == 'danger' || result.status == 'fail'){
    //                     //setTimeout(function() { toster("success", "Agent", "Added"); }, 4000);
    //                 }else{
                        
    //                     $('#add-new-agent').modal('hide');
    //                     setTimeout(function() { toster("success", "Agent", "Added"); }, 4000);               
                        
    //                 }
                    
                    
    //             }              
    //         },           
    //     });
       
    // });





});
</script>              
@endsection