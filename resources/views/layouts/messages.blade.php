<script>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            toastr.error(" {{ $error }}", "Task failed!");
        @endforeach
    @endif

    @if(Session::has('success'))
        toastr.success(" {{ Session::get('success') }}", "Success Here!");
    @endif
    @if(Session::has('info'))
        toastr.info(" {{ Session::get('info') }}", "Information Here!");
    @endif
    @if(Session::has('error'))
        toastr.error(" {{ Session::get('error') }}", "Task failed!");
    @endif

</script>