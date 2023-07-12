<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="name">Name</label>
    <input disabled type="text" class="form-control" id="name" name="name"
        value="{{ isset($county) ? $county->name : old('name') }}"/>
</div>
