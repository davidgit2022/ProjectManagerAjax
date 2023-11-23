@include('common.headerModal')
<form action="javascript:void(0)" id="companyForm" name="companyForm" method="POST"
enctype="multipart/form-data">
    <div class="mb-3">
        <input type="hidden" name="id" id="id">
        <label for="name" class="form-label">Nombre:</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre">
        <span class="error-message text-danger" id="nameError"></span>
    </div>
</form>
@include('common.footerModal')