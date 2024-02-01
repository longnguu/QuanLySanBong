<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('message_type', 'info') }}";
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
    @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
    @endif
{{--    @php--}}
{{--        Session::forget('message');--}}
{{--        Session::forget('message_type');--}}
{{--    @endphp--}}
</script>
