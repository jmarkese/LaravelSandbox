@extends('welcome')
@section('body')
<div class="flex-center position-ref full-height">

    <table id="example" class="display" cellspacing="0" width="100%">
    </table>

</div>

<script>
    $(document).ready(function() {
        $('#example').DataTable( {
            "serverSide": true,
            "processing": true,
            "ajax": "usergroups",
            columns : [
                { "data": "id", "title": "Id", "name": "id" },
                { "data": "name", "title": "Name", "name": "name" },
                { "data": "email", "title": "Email"},
                { "data": "groups[].descendants[].whites[].name", "title": "Whites", "name": "groups.*.descendants.*.whites.*.name"}
            ]
        } );
    } );
</script>
@endsection
