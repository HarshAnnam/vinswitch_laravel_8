@if($response = session('response'))
<div class="offset-md-6 col-md-6">
    <div class="alert alert-{{ $response['class'] }} alert-dismissible fade show" role="alert" id="list-msg">
        <strong>{{ $response['msg'] }}</strong>
    </div>
</div>
<script>        
    setTimeout(function() {
        $('#list-msg').fadeOut('fast');
    }, 4000); 
</script>
@endif

<div class="offset-md-6 col-md-6">
    <div class="messages" id="ajax-msg"></div>
</div>
