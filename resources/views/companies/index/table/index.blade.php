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
    <tbody>
        @foreach($data as $row)
            <tr>
                <td><img class="table-foto" width=100 src="{{asset('storage/'.$row->logo)}}"></td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->website }}</td>
                <td>{{  \Carbon\Carbon::parse($row->created_at)->format('d/m/Y') }}</td>
                <td><a href="{{ url("/companies/{$row->id}") }}" style="font-size: 18px"><i class="fa fa-eye"></i></a></td>
                <td><a href="{{ url("/companies/{$row->id}/edit") }}" style="font-size: 18px"><i class="fa fa-edit"></i></a></td>
                <td><a onclick="delete_company(this.dataset.company_id)" data-company_id="{{ $row->id }}" style="color: red;font-size: 18px; cursor: pointer"><i class="fa fa-close"></i></a></td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $data->links() !!}
@section('scripts-footer')
<script>
    $(document).ready(function() {
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