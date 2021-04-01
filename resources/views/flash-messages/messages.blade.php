@if ($msg = session('success'))
    <div class="alert alert-success alert-block text-center">
        <strong>{{ $msg }}</strong>
        <button type="button" class="close float-right" data-dismiss="alert">×</button>    
    </div>
@endif