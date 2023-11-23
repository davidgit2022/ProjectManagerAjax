<script type="text/javascript">
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#table-project').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('projects.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'budget',
                    name: 'budget'
                },
                {
                    data: 'execution_date',
                    name: 'execution_date'
                },
                {
                    data: 'is_active',
                    name: 'is_active'
                },
                {
                    data: 'city_id',
                    name: 'city_id'
                },
                {
                    data: 'company_id',
                    name: 'company_id'
                },
                {
                    data: 'user_id',
                    name: 'user_id'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },
            ],
            order: [
                [0, 'desc']
            ]
        });
    })
</script>
