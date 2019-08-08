<script src="../js/toastr.min.js"></script>

{{--<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>--}}
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

<script>
    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;

            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
    @endif
</script>