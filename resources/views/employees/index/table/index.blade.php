<table class="table table-bordered text-center" id="service-table">
    <thead>
    <tr>
        <th>@sortablelink('name','Name')</th>
        <th>@sortablelink('lastname','Lastname')</th>
        <th>@sortablelink('email','Email')</th>
        <th>@sortablelink('phone','Phone')</th>
        <th>Company</th>
        <th>@sortablelink('created_at','Created at')</th>
        <th width="50">View</th>
        <th width="50">Edit</th>
        <th width="50">Delete</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $row)
        <tr>
            <td>{{ $row->name }}</td>
            <td>{{ $row->lastname }}</td>
            <td>{{ $row->email }}</td>
            <td>{{ $row->phone }}</td>
            <td>{{ $row->company->name }}</td>
            <td>{{ $row->created_at->format('d/m/Y') }}</td>
            <td><a href="{{ url("/employees/{$row->id}") }}" style="font-size: 18px"><i class="fa fa-eye"></i></a></td>
            <td><a href="{{ url("/employees/{$row->id}/edit") }}" style="font-size: 18px"><i class="fa fa-edit"></i></a></td>
            <td><a onclick="delete_employee(this.dataset.employee_id)" data-employee_id="{{ $row->id }}" style="color: red;font-size: 18px; cursor: pointer"><i class="fa fa-close"></i></a></td>
        </tr>
    @endforeach
    </tbody>
</table>

{!! $data->links() !!}

@section('scripts-footer')
<script>
    function delete_employee(id) {
        if (confirm('Really delete?')) {
            $.ajax({
                type: "DELETE",
                url: '/employees/'+id,
                "headers": {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    location.reload();
                }
            });
        }
    }

</script>
@endsection