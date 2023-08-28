<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    function showErrors(errors) {
        for (let field in errors) {
            let errorSpan = $('#' + field + 'Error');
            errorSpan.text(errors[field][0]);
            errorSpan.show();
        }
    };

    function add() {
        let id = 0;

        let bottom = document.getElementById('buttonAction');
        let title = document.getElementById('titleModal');

        if (id == 0) {
            let htmlContentBottom =
                '<button type="submit" onClick="store()" class="btn btn-primary" id="save">Guardar</button>';
            bottom.innerHTML = htmlContentBottom;

            let htmlContentTitle = `<h1 class="modal-title fs-5" >{{ $componentName }} | Crear </h1>`;

            title.innerHTML = htmlContentTitle;
        }
        $('#CityCompanyForm').trigger('reset'),
            $('#theModal').modal('show'),
            $('#id').val('')
    }

    function cancel() {
        $('#CityCompanyForm')[0].reset();
        $('#theModal').modal('hide');
        $('.error-message').hide();
        return false;
    }
</script>
@stack('javascript')
