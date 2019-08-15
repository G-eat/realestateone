{{--<script src="../js/jquery-3.3.1.min.js"></script>--}}
{{--<script src="../js/jquery-migrate-3.0.1.min.js"></script>--}}
{{--<script src="../js/jquery-ui.js"></script>--}}
{{--<script src="../js/popper.min.js"></script>--}}
{{--<script src="../js/bootstrap.min.js"></script>--}}
{{--<script src="../js/owl.carousel.min.js"></script>--}}
{{--<script src="../js/mediaelement-and-player.min.js"></script>--}}
{{--<script src="../js/jquery.stellar.min.js"></script>--}}
{{--<script src="../js/jquery.countdown.min.js"></script>--}}
{{--<script src="../js/jquery.magnific-popup.min.js"></script>--}}
{{--<script src="../js/bootstrap-datepicker.min.js"></script>--}}
{{--<script src="../js/aos.js"></script>--}}

{{--<script src="../js/main.js"></script>--}}

<script src="{{ asset('js/all.js') }}"></script>
{{--<script src="{{ asset('js/app.js') }}"></script>--}}



{{--<script src="{{ asset('js/app.js') }}"></script>--}}

<script src="../js/toastr.min.js"></script>
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

