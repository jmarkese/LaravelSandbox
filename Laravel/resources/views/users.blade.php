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
            "ajax": "usergroups2",
            columns : [
                { "data": "id", "title": "Id", "name": "id" },
                { "data": "name", "title": "Name", "name": "name" },
                { "data": "groups[].id", "title": "group", "name": "groups.*.id"},
                { "data": "groups[].subsets[].id", "title": "subsets", "name": "groups.*.subsets.*.id"},
                { "data": "groups[].subsets[].whites[].id", "title": "whites", "name": "groups.*.subsets.*.whites.*.id"},
                //{ "data": "groups[].whites[].id", "title": "whites", "name": "groups.*.whites.*.id"},
                //{ "data": "groups[].parent", "title": "sub", "name": "groups.*.parent.*"},
                //{ "data": "groups[].subtree[]", "title": "whites", "name": "groups.*.subtree.*"},
            ]
        } );
    } );
</script>
@endsection
