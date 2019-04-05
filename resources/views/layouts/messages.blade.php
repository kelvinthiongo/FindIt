<script>
@if(count($errors) > 0)
    @foreach($errors->all() as $error)
            toastr.error('{{$error}}');
    @endforeach
@endif

    @if(session('success'))
         toastr.success('{{session('success')}}');        
    @endif

@if(session('error'))
    <script>
		toastr.error('{{session('error')}}');
    </script>
    {{-- <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        {{ session('error')}}
    </div> --}}
@endif
</script>