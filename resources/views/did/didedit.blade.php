@extends('layouts.mainLayout.main')
@section('title', 'Did Edit')
@section('content')


<div class="row">

    <div class="col-lg-9 col-xl-9">
        <div class="card">
            <div class="card-body">
                <!-- <ul class="nav nav-pills nav-fill navtab-bg">
                    <li class="nav-item">
                        <a href="#personal" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                            Information
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#cred" data-bs-toggle="tab" aria-expanded="false" class="nav-link ">
                            Credential
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#bill" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                            Billing
                        </a>
                    </li>
                </ul> -->
                <div class="tab-content">
                    <div class="tab-pane show active" id="personal">

                        <form class="needs-validation1 was-validated1" novalidate>
                            <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle me-1"></i> Did Info</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">

                                        <label for="forvendor_id" class="form-label">Vendor</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class=" fab fa-odnoklassniki"></i></span>
                                            <select class="form-control" name="vendor" id="vendor" required>
                                                <option value="">Select</option>

                                                @isset($vendor)
                                                @foreach($vendor as $data)
                                                <option value="{{$data->id}}" @if($did['vendor_id'] == $data->id) selected="selected" @endif >{{$data->vendor_name}}</option>
                                                @endforeach
                                                @endisset

                                            </select>
                                            <div class="invalid-tooltip vendor">
                                                Please select valid Vendor.
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="fornumber" class="form-label">Number</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                                            <input type="text" class="form-control" id="number" placeholder="Number" value="{{$did['number']}}" required>
                                            <div class="invalid-tooltip number">
                                                Please select valid Number.
                                            </div>
                                        </div>

                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->




                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="forrate_center" class="form-label">Rate Center</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-percentage"></i></span>
                                            <input type="text" class="form-control" id="rate_center" placeholder="Rate center" value="{{$did['rate_center']}}" required>
                                            <div class="invalid-tooltip rate_center">
                                                Please select Rate Center.
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div> <!-- end row -->




                            <div class="text-end">
                                <span class="btn btn-success waves-effect waves-light mt-2 diddatasubmit"><i class="mdi mdi-content-save"></i> Update</span>
                            </div>
                        </form>

                    </div> <!-- end tab-pane -->
                    <!-- end Information section content -->

                </div> <!-- end tab-content -->
            </div>
        </div> <!-- end card-->

    </div> <!-- end col -->
</div>
<!-- end row-->








<script>
    $(document).ready(function() {
        var base_url = $('#base_url').val();
        var id = $('#id').val();

        // update record
        $("body").on("click", ".diddatasubmit", function(){        
        //   console.log("id = "+id);

            var formData = {
                id: id,
                vendor: $("#vendor").val(),
                number: $("#number").val(),
                rate_center: $("#rate_center").val(),                
                table: "did",
                "_token":"{{ csrf_token() }}"
            };            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: base_url+'/didedit_update_ajex',
                method: "POST",
                data:formData,
                success: function(result){
                    var selector;
                    $(".border-danger").removeClass("border-danger");
                    $(".invalid-tooltip").hide();
                    if(result.error !=0){     
                            if(result.data == "Something wrong"){
                                toster("danger", "Record", "Failed",result.data);
                            }                   
                            $.each(result.error, function(index, value){         

                                $('#'+index).addClass("border-danger").show();
                                $('.'+index).html(value).show();
                            });
                            
                            
                    }else{
                        $(".border-danger").removeClass("border-danger");
                        $(".invalid-tooltip").hide();
                        if(result.status == 'danger' || result.status == 'fail'){
                            if(result.data == "Record not exist"){
                                toster("danger", "", "","Record not found");
                            }else{
                                toster("danger", "Record", "Failed");
                            }


                        }else{
                            toster("success", "Record", "Updated");
                        }

                    }              
                },           
            });      

        });

        // // update credential 
        // $("body").on("click", ".agentcredsubmit", function(){       
        //         var formData = {
        //             id:$("#users_id").val(),
        //             firstname_user: $("#firstname_user").val(),
        //             lastname_user: $("#lastname_user").val(),
        //             email_user: $("#email_user").val(),
        //             contact_no_user: $("#contact_no_user").val(),               
        //             table: "users",
        //             "_token":"{{ csrf_token() }}"
        //         }; 

        //         $.ajax({
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             url: base_url+'/agentedit_update_ajex',
        //             method: "POST",
        //             data:formData,
        //             success: function(result){
        //                 $(".border-danger").removeClass("border-danger");
        //                 $(".invalid-tooltip").hide();
        //                 if(result.error !=0){
        //                     $.each(result.error, function(index, value){         
        //                         $('#'+index).addClass("border-danger").show();
        //                         $('.'+index).html(value).show();
        //                     });

        //                 }else{                        
        //                     if(result.status == 'danger' || result.data == "fail" || result.status == 'fail'){
        //                         if(result.data == "Record not exist"){
        //                             toster("danger", "", "","Record not found");
        //                         }else{
        //                             toster("danger", "Record", "Failed");
        //                         }

        //                     }else{
        //                             toster("success", "Record", "Updated");                    
        //                     }

        //                 }                  

        //             },           
        //         });        
        // });

        // // load data function     
        // function loadMoreData(page,update='')
        // {
        //     id = $('#id').val();
        //     search = $('#search').val() ? $('#search').val() : '';
        //     url = base_url+'/agentedit/' + id + '?page=' + page + '&search=' + search;
        //     if(update == 'addnewplan'){
        //         url = base_url+'/agentedit/' + id + '?addnewplan=addnewplan';
        //     }else if(update != ''){
        //         url = base_url+'/agentedit/' + id + '?page=1';
        //     }
        //     $.ajax({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         url:url,
        //         type:'get',
        //         beforeSend: function()
        //         {
        //             $(".loding").show();               
        //         }
        //     })
        //     .done(function(data){
        //         // console.log("done =",url);
        //         if(data.html == ""){
        //             console.log("No more Plan Found!");
        //             $('.loding').html("No more Plan Found!");
        //             return;
        //         }
        //         $('.loding').hide();
        //         if(update == 'addnewplan'){
        //             $(".planlistrow").html("");
        //             $(".planlistrow").append(data.html);
        //         }else if(!update){ 
        //             console.log("no update value");
        //             $(".planlistrow").append(data.html);
        //         }else{
        //             console.log("update value");
        //             $(".planlistrow").html("");
        //         }

        //     })
        //     .fail(function(jqXHR,ajaxOptions,thrownError){

        //     });

        // }

        // var page = 1;
        // // page scroll function
        // $(window).scroll(function(){
        //     if($('#bill').hasClass('active')){
        //         if($(window).scrollTop() + $(window).height() >= $(document).height()){                
        //             // alert(page);                
        //             page++;
        //             // console.log("scroll page :"+page);
        //             loadMoreData(page);

        //         }
        //     }
        // });

        // // convert teble normal fild to editabel feild
        // $('body').on('click', '.edit-inline-ajex', function() { 
        //     var colIndex = $(this).data("index");
        //     var txt = $(this).text();
        //     var id = $(this).data("id");
        //     var value = $(this).text();
        //     if(txt.length >= 1){
        //         $.each($(".edit-column"), function(i, el) {
        //             orignaltxt = $(this).val();
        //             if(orignaltxt.length > 0){
        //                 $(this).replaceWith(orignaltxt);                
        //             }                
        //         });

        //         $(this).html("").append("<input type='text' class='edit-column' data-id="+id+" data-index="+colIndex+" value=\""+txt+"\">");
        //     }
        // });

        //  // update editabel textbox value ajex
        //  $('body').on('change', '.edit-column', function() {  
        //      alert("asdf ads");       
        //     var id = $(this).data("id");
        //     var columnindex = $(this).data("index");
        //     var value = $(this).val();
        //     //console.log("change event call id, columnindex, value  :",id, columnindex, value);
        //     $.ajax({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         url: base_url+'/agenteditbillplan_update_ajex',
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
        //             if(result.error !=0){
        //                 var error_validation = result.error;
        //                 // alert(result.error);
        //                 // $.each(result.error, function(index, value){
        //                 //     alert(index+" = "+value);
        //                 // });

        //             }else{
        //                 if(result.status == 'danger' || result.status == 'fail'){
        //                     toster("danger", columnindex, "Updat Fail");
        //                 }else{
        //                     toster("success", columnindex, "Updated");
        //                 } 

        //             }


        //         },           
        //     });
        // });

        // // add new bill plan ajex
        // $('.add-plan-submit').click(function(){
        //     // console.log(Auth::user());
        //     // id = $('#id').val();
        //     var billplan_id =$('#billplan_id').val();
        //     var commission =$('#commission').val();
        //     // alert(id);
        //     $.ajax({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         url: base_url+'/addbillplan_ajex',
        //         method: "POST",
        //         data:{id:id,billplan_id:billplan_id,commission:commission,"_token":"{{ csrf_token() }}"},
        //         success: function(result){
        //             $(".border-danger").removeClass("border-danger");
        //             $(".invalid-tooltip").hide();
        //             if(result.error !=0){
        //                 $.each(result.error, function(index, value){         
        //                     $(document).find('#'+index).addClass("border-danger").show();
        //                     $(document).find('.'+index).html(value).show();
        //                 });

        //             }else{

        //                 if(result.status == 'danger' || result.status == 'fail'){
        //                     toster("danger", "New Plan", "Added Failed");
        //                 }else{
        //                     toster("success", "New Plan", "Added");
        //                 }             

        //                 $('.btn-close').click();
        //                 loadMoreData("",update='addnewplan');
        //                 page=1;

        //             }




        //         },           
        //     });
        // })
        // // clear model deta
        // $("#add-plan").on("hidden.bs.modal", function() {
        //     $("#billplan_id").val("");
        //     $("#commission").val("");
        // });

        // // delete bill plan ajex
        // $("body").on("click", ".delete", function(){ 
        //     id =$(this).data('id');
        //     console.log("delete id = "+id);
        //     Swal.fire({
        //         title: "Are you sure?",
        //         text: "You want Delete ",
        //         icon: "warning",
        //         showCancelButton: !0,
        //         confirmButtonText: "Yes",
        //         cancelButtonText: "No, cancel!",
        //         confirmButtonClass: "btn btn-success mt-2",
        //         cancelButtonClass: "btn btn-danger ms-2 mt-2",
        //         buttonsStyling: !1
        //     }).then(function(e) {
        //         if(e.isConfirmed){

        //             var table =$('#bill_plan').val();        
        //             var url = base_url+'/delete/'+id+'/'+table;

        //             $.ajax({            
        //                 url: url,
        //                 method: "GET"                       
        //             }).done(function(data){
        //                 if(data.status == 'danger' || data.status == 'fail')
        //                 {
        //                     alert("data "+data.data);
        //                     if(data.data == "Record not exist"){
        //                         alert("here");
        //                         toster("danger", "", "","Record not found");
        //                         setTimeout( function(){ 
        //                             location.reload();
        //                         }  , 3000 );
        //                     }else{
        //                         toster("danger", '', "Fail");
        //                     }                                        
        //                 }else{                
        //                     toster("success", 'Plan', "Deleted");
        //                     $("#billplanrow"+id).remove();                 
        //                 }
        //             });
        //         }
        //     });
        // });

        // Information form validation
        // function information_validation(){

        // }

    });
</script>
@endsection