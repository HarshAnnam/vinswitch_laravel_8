@extends('layouts.mainLayout.main')
@section('title', 'Agent List')
@section('content')



<div class="table-responsive border-0">                                                       
<table id="agentlist" class="table table-hover m-0 table-centered dt-responsive nowrap w-100">
    <thead>
    <tr>
        <th >go to</th>
        <th>Agent Code</th>
        <th >Name</th>
        <th >Surname</th>
        <th >Company Name</th>
        <th >Email</th>
        <th>Balance</th>
        <th >Status</th>
        <th >Suspended</th>
        <th >Commission</th>
        <th >Tenant</th>
        <th >Action</th>
    </tr>
    </thead>   
</table>
</div>








                   
                                                   
<script>
    
$(document).ready( function () {
    var base_url = $('#base_url').val();

    // datatabel set data code 
    $('#agentlist').DataTable({
        // "pageLength": 2,
        "language": {
                "paginate": {
                    "previous": "<i class='mdi mdi-chevron-left'>",
                    "next": "<i class='mdi mdi-chevron-right'>"
                }
            },
        "ajax": {
             "url": base_url+'/agentlistajax',             
         },
         
         columns: [
        { data: 'go_to' },
        { data: 'agent_code' },
        { data: 'fname' },
        { data: 'lname' },
        { data: 'company_name' },
        { data: 'email' },
        { data: 'balance' },
        { data: 'status' },
        { data: 'suspended' },
        { data: 'comission' },
        { data: 'tenent' },
        { data: 'action' },
        
     ],
     "drawCallback": function() {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            }
      
    });    


    // ajex update tabel data code
    $('body').on('change', '.edit-column', function() {
       // alert($(this).data("id"));
        var id = $(this).data("id");
        var columnindex = $(this).data("index");
        var value = $(this).val();

        //status_update(id, colIndex, value, this);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: base_url+'/agentlist_update_ajex',
            method: "POST",
            data:{id:id,columnindex:columnindex,value:value,"_token":"{{ csrf_token() }}"},
            success: function(result){
                console.log(result);
                $.each($(".edit-column"), function(i, el) {
                    orignaltxt = $(this).val();
                    if(orignaltxt.length > 0){
                        $(this).replaceWith(orignaltxt);                
                    }                
                });
            },           
        });

    });

    function status_update(id='',columnindex='',value=''){
        if(id != '' && columnindex != '' && value != ''){
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: base_url+'/agentlist_update_ajex',
                method: "POST",
                data:{id:id,columnindex:columnindex,value:value,"_token":"{{ csrf_token() }}"},
                success: function(result){
                    console.log(result);
                    //alert("sucessfull");
                    //return "sucessfull";
                   
                },           
            });
            //return "sucessfull";

        }else{
            //return "fail";
        }
        //return "another";
    }
    
    // inline edit functionality code 
    $('#agentlist').on('click', 'td', function () {    
        
        var id='',orignaltxt='';
        var table = $('#agentlist').DataTable();
        var data = table.cell( this ).data();
        var colIndex = (data && table.cell(this) && table.cell(this).index().column) ? table.cell(this).index().column : '';
        var txt = $(this).text();    
        
        var $row = $(this).closest("tr").off("mousedown");
        var $tds = $row.find("td");
        var i =1;
        $.each($tds, function(i, el) {
           // console.log("each col deta :"+i+" ",    $(this).text());
            if(i==1){
                id = $(this).text();            
            }
            i++;       
        });

        if(txt.length > 1 && colIndex < 6  && colIndex > 1){
            //console.log("index = ");
            $.each($(".edit-column"), function(i, el) {
                orignaltxt = $(this).val();
                if(orignaltxt.length > 0){
                    $(this).replaceWith(orignaltxt);                
                }                
            });

            $(this).html("").append("<input type='text' class='edit-column' data-id="+id+" data-index="+colIndex+" value=\""+txt+"\">");
        }
    });
   

    $('#agentlist').on( 'click', '.status', function (e) {       
        var colIndex = "status";
        var responce = status_update($(this).attr("id").replace('status',''), colIndex, $(this).text());
        //console.log("return status = ",responce);
        if($(this).text() == 'ACTIVE'){
            $(this).html('INACTIVE').removeClass("bg-soft-success text-success").addClass("bg-soft-danger text-danger");           
            
        }else{
            $(this).removeClass("bg-soft-danger text-danger").addClass("bg-soft-success text-success").html('ACTIVE');            
        }
        
    });
    $('#agentlist').on( 'click', '.suspended', function (e) {       
        var colIndex = "suspended";
        var responce = status_update($(this).attr("id").replace('suspended',''), colIndex, $(this).text());
        //console.log("return suspended = ",responce);
        if($(this).text() == 'NO'){
            $(this).html('YES').removeClass("bg-soft-success text-success").addClass("bg-soft-danger text-danger");                      
        }else{
            $(this).removeClass("bg-soft-danger text-danger").addClass("bg-soft-success text-success").html('NO');            
        }
    });
    

        






});
</script>


               
@endsection