@if(Session::get('message'))
<script>
    M.toast({html: '{{ Session::get('message') }}' })
</script>
@endif
