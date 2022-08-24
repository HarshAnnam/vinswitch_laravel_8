@if($response = session('response'))
<div class="offset-md-6 col-md-6 alert-absolute1">
    <div>
    <div class="alert alert-{{ $response['class'] }} alert-dismissible fade show alert-absolute" role="alert" id="list-msg">
        <strong>{{ $response['msg'] }}</strong>
    </div>
    </div>
</div>
<script>        
    setTimeout(function() {
        $('#list-msg').fadeOut('fast');
    }, 4000);
</script>
@endif

<div class="offset-md-6 col-md-6 alert-absolute">
    <div class="messages" id="ajax-msg"></div>
</div>
