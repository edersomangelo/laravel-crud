<table class="table table-bordered text-center" id="service-table">
    <thead>
    <tr>
        <th>Logo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Website</th>
        <th>Created at</th>
        <th width="50">View</th>
        <th width="50">Edit</th>
        <th width="50">Delete</th>
    </tr>
    </thead>
</table>
@section('scripts-footer')
<script>
    $(document).ready(function() {
        $('#service-table').DataTable({
            serverSide: true,
            dom: 'Bfrtip',
            ajax: {
                "url": '{!! route('companies.table') !!}',
                "type": "POST",
                "headers": {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            columns: [
                { data: 'logo', name: 'logo', orderable: false},
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email', orderable: false},
                { data: 'website', name: 'website' },
                { data: 'created_at', name: 'created_at' },
                { data: 'view', name: 'view', orderable: false},
                { data: 'edit', name: 'edit', orderable: false},
                { data: 'delete', name: 'delete', orderable: false}
            ]
        });
    } );

    function delete_company(id) {
        if (confirm('Really delete?')) {
            $.ajax({
                type: "DELETE",
                url: '/companies/'+id,
                "headers": {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    $('#service-table').DataTable().ajax.reload( null, false);
                }
            });
        }
    }

</script>
@endsection