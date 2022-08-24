@if($page == 'agentlist')
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
                        <h4 class="mt-0 mb-2 font-16"><span class="edit-inline-ajex" data-index="firstname" data-id="{{$id}}">{{$record['firstname']}} </span><span class="edit-inline-ajex" data-index="lastname" data-id="{{$id}}"> {{$record['lastname']}}</span></h4>
                        <p class="mb-1"><b>Company :</b> <span class="edit-inline-ajex" data-index="company_name" data-id="{{$id}}">{{$record['company_name']}}</span></p>
                        <p class="mb-0 w-100">
                            <!-- <b>Email :</b> --> {{$record['email']}}
                        </p>
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
                    <a data-index="status" data-id="{{$id}}" data-value="{{$record['status']}}" class="btn btn-xs waves-effect waves-light status edit-inline-ajex status{{$id}}@if($record['status'] == 'ACTIVE') btn-success @else btn-danger @endif">Status : {{$record['status']}}</a>
                    <a data-id="{{$id}}" data-index="suspended" data-value="{{$record['suspended']}}" class="btn btn-xs waves-effect waves-light suspended edit-inline-ajex suspended{{$id}}@if($record['suspended'] == 'NO') btn-success @else btn-danger @endif">Suspended : {{$record['suspended']}}</a>
                    <!-- <a href="javascript: void(0);" class="btn btn-xs btn-primary waves-effect waves-light">Email</a> -->
                </div>
            </div>

            <div class="col-sm-2">
                <div class="text-sm-end text-center mt-2 mt-sm-0">
                    <a title="Tenant" class="action-icon" href="{{url('tenant').'/'.$id}}"><i class=" fas fa-user-friends"></i></a>
                    <a title="Agent Commission" class="action-icon" href="{{url('agentcomission').'/'.$id}}"><i class="far fa-money-bill-alt"></i></a>
                    <a href="{{url('agentedit').'/'.$id}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                    <!-- <a href="{{url('agentdelete').'/'.$id}}" class="action-icon"> <i class="mdi mdi-delete"></i></a> -->
                    <a class="action-icon"> <i class="mdi mdi-delete"></i></a>
                </div>
            </div> <!-- end col-->
        </div> <!-- end row -->
    </div>
</div> <!-- end card-->

<!-- fist element of list end-->
@endforeach
@endif
@if($page == 'agentedit_billing')
@foreach($billplan as $record)
@php
$id = App\Providers\EncreptDecrept::encrept($record['agent_billplan_id']);
@endphp
<tr id="billplanrow{{$id}}">

    <td>{{++$i}} </td>
    <td>{{$record['name']}}</td>
    <td>{{$record['type']}}</td>
    <td> <span class="edit-inline-ajex" data-index="commission" data-id="{{$id}}">{{$record['commission']}}</span></td>
    <td><a class="float-end text-danger delete" data-id="{{$id}}" title="Delete BillPlan"><i class="fa fa-trash"></i></a></td>
</tr>
@endforeach
@endif

@if($page == 'dids')
@foreach($records as $record)
<!-- fist element of list start-->
@php
$id = App\Providers\EncreptDecrept::encrept($record['id']);
@endphp

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
                </div>
            </div>

            <div class="col-sm-2">
                <div class="text-sm-end text-center mt-2 mt-sm-0">
                    <div class="text-center mt-3 mt-sm-0">
                        <div class="badge font1-14 bg-soft-info1 text-info1 @if($record['status'] == 'RESERVED') bg-soft-info text-info @elseif($record['status'] == 'AVAILABLE') bg-soft-success text-success @else bg-soft-danger text-danger @endif">{{$record['status']}}</div>
                        @if($record['status'] == 'AVAILABLE')
                        <div class="text-center mt-3 mt-sm-0">

                            <!-- <a href="{{url('agentedit').'/'.$id}}" class="action-icon" title="Edit Aclnodes" data-id="{{$id}}"> 
                                        <i class="mdi mdi-square-edit-outline"></i>
                                    </a> -->
                            <a href="#" class="action-icon" title="Edit Aclnodes" data-id="{{$id}}">
                                <i class="mdi mdi-square-edit-outline"></i>
                            </a>

                            <a class="action-icon delete" data-id="{{$id}}" title="Delete Aclnodes">
                                <i class="fa fa-trash text-danger h5"></i>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div> <!-- end col-->
        </div> <!-- end row -->
    </div>
</div> <!-- end card-->

<!-- fist element of list end-->
@endforeach
@endif
@if($page == 'tenant')
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
                        <p class="mb-0 w-100">
                            <!-- <b>Email :</b> --> {{$record['email']}}
                        </p>
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
@endif
@if($page == 'acl')
@foreach($records as $record)
<!-- fist element of list start-->
@php
$id = App\Providers\EncreptDecrept::encrept($record['id']);
@endphp

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
@endif

@if($page == 'comissions')
@foreach($records as $record)
<!-- fist element of list start-->
@php
$id = App\Providers\EncreptDecrept::encrept($record['id']);
@endphp

<tr>
    <td>{{$record->summary}}</td>
    <td>{{$record->amount}}</td>
    <td>{{$record->commission_percentage}}</td>
    <td>{{$record->debit}}</td>
    <td>{{$record->credit}}</td>
    <td>{{$record->balance}}</td>
    <td>{{$record->created_date}}</td>
    <td>{{$record->tenant_account_number?$record->tenant_account_number:'-'}}</td>
</tr>
@endforeach
@endif