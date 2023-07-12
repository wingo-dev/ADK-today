<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name"
        value="{{ isset($town) ? $town->name : old('name') }}"
        placeholder="Please enter name" />
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="name">Counties</label>
    <select class="form-control" name="county_id" id="county_id">
        @foreach ($counties as $county)

        <option value="{{$county->id}}" {{isset($town) && $town->county_id == $county->id ? "selected" : ""}}>{{$county->name}}</option>

        @endforeach

    </select>
</div>

<div class="col-12 mb-1">
    <input class="form-check-input" type="checkbox" name="is_more_country" value="1" id="isMoreThan" {{isset($town) && $town->is_more_country == 1 ? "checked" : ""}}>
    <label class="form-check-label" for="isMoreThan">Is in more than one county</label>
</div>
