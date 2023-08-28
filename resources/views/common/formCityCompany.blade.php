@include('common.headerModal')
<form action="javascript:void(0)" id="CityCompanyForm" method="POST" enctype="application/x-www-form-urlencoded">

    <input type="hidden" name="id" id="id">
    <div class="mb-3">
        <label for="name" class="form-label">Nombre:</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre">
        <span class="error-message text-danger" id="nameError"></span>
    </div>
@include('common.footerModal')


