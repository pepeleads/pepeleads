@if(session('status'))
<script>

alert("{{ session('status')}}");

</script>

@endif