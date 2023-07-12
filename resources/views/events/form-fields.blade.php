<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="title">Title</label>
    <input required type="text" class="form-control" id="title" name="title"
        value="{{ isset($event) ? $event->title : old('title') }}" placeholder="Please enter title" />
</div>
@if (
    \App\Utils\Common\UserRoles::VENDOR != auth()->user()->role &&
        \App\Utils\Common\UserRoles::SUPER_ADMIN != auth()->user()->role &&
        \App\Utils\Common\UserRoles::ADMIN != auth()->user()->role)
    <div class="col-md-4 col-sm-6 mb-1">
        <label class="form-label" for="vendor_id">Vendor</label>
        <select required class="form-select select2" name="vendor_id" id="vendor_id">
            @foreach ($vendors as $vendor)
                <option value="{{ $vendor->id }}"
                    {{ isset($event) && $event->vendor_id == $vendor->id ? 'selected' : '' }}>{{ $vendor->name }}
                </option>
            @endforeach
        </select>
    </div>
@else
    <input required type="hidden" name="vendor_id" value="{{ auth()->id() }}">
@endif

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="category_id">Category</label>
    <select required class="form-select" name="category_id" id="category_id" onchange="getTags()">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                {{ (isset($event) && $event->category_id == $category->id) || $category->id == old('category_id') ? 'selected' : '' }}>
                {{ $category->name }}</option>
        @endforeach
    </select>
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="tags">Tags</label>
    <select required class="form-select select2" name="tags[]" id="tags" multiple>
    </select>
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="short_description">Short Description</label>
    <input required type="text" class="form-control" id="short_description" name="short_description"
        value="{{ isset($event) ? $event->short_description : old('short_description') }}"
        placeholder="Please enter Short Description" />
</div>
<div class="col-md-8 col-sm-6 mb-1">
    <label class="form-label" for="long_description">Long Description</label>
    <textarea required class="form-control" name="long_description" id="long_description" cols="30" rows="10"
        placeholder="Please enter Long Description">{{ isset($event) ? $event->long_description : old('long_description') }}</textarea>
    {{-- <input required type="text" class="form-control" id="long_description" name="long_description"
        value="{{ isset($event) ? $event->long_description : old('long_description') }}"
        placeholder="Please enter Long Description" /> --}}
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="address">Address</label>
    <input required type="text" class="form-control" id="address" name="address"
        value="{{ isset($event) ? $event->address : old('address') }}" />
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="start_date">Start Date</label>
    <input required type="date" class="form-control" id="start_date" name="start_date"
        value="{{ isset($event) ? $event->start_date : old('start_date') }}" />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="start_time">Start Time</label>
    <input required type="time" class="form-control" id="start_time" name="start_time"
        value="{{ isset($event) ? $event->start_time : old('start_time') }}" />
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="event_url">Event Url</label>
    <input type="text" class="form-control" id="event_url" name="event_url"
        value="{{ isset($event) ? $event->event_url : old('event_url') }}" />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="end_date">End Date</label>
    <input required type="date" class="form-control" id="end_date" name="end_date"
        value="{{ isset($event) ? $event->end_date : old('end_date') }}" />
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="end_time">End Time</label>
    <input required type="time" class="form-control" id="end_time" name="end_time"
        value="{{ isset($event) ? $event->end_time : old('end_time') }}" />
</div>


<div class="col-md-4 col-sm-6 mb-1">
    <div class="row">
        <label class="form-label" for="image">Image</label>
        <input type="file" class="form-control" id="image" name="image" onchange="imagePreview(event)"
            value="{{ old('image') }}" />
        <input type="hidden" name="image_name"
            value="{{ isset($event) ? $event->image : (old('image_name') ? old('image_name') : '') }}" />
        <div class="col-md-4 col-sm-6 mb-1">
            <label class="form-label" for="image_preview">Image Preview</label>
            <img id="image_preview"
                src="{{ isset($event) ? asset($event->image) : (old('image_name') ? asset(old('image_name')) : asset('storage/defaults/event.png')) }}"
                alt="" width="200" height="200">
        </div>

    </div>
</div>


<div class="col-md-4 col-sm-6 mb-1">
    <div class="row">
        <label class="form-label" for="thumbnail">Thumbnail</label>
        <input type="file" class="form-control" id="thumbnail" name="thumbnail"
            onchange="thumbnailPreview(event)" />
        <input type="hidden" name="thumbnail_name"
            value="{{ isset($event) ? $event->thumbnail : (old('thumbnail_name') ? old('thumbnail_name') : '') }}" />
        <div class="col-md-4 col-sm-6 mb-1">
            <label class="form-label" for="thumbnail_preview">Thumbnail Preview</label>
            <img id="thumbnail_preview"
                src="{{ isset($event) ? asset($event->thumbnail) : (old('thumbnail_name') ? asset(old('thumbnail_name')) : asset('storage/defaults/event.png')) }}"
                alt="" width="200" height="200">
        </div>
    </div>
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label">Coordinates (Latitude,Longitude):</label>
    <input id='loc' class="form-control" type='text' name="coordinates"
        value="{{ isset($event) ? $event->coordinates : old('coordinates') }}" />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="county_id">County</label>
    <select required class="form-select select2" name="county_id" id="county_id" onchange="getTowns()">
        <option value="">Select County</option>
        @foreach ($counties as $county)
            <option value="{{ $county->id }}"
                {{ (isset($event) && $event->county_id == $county->id) || $county->id == old('county_id') ? 'selected' : '' }}>
                {{ $county->name }}</option>
        @endforeach
    </select>
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="town_id">Town</label>
    <select required class="form-select select2" name="town_id" id="town_id">
        <option value="">Select Town</option>
    </select>
</div>
<div class="col-md-4 col-sm-6 mb-1 mt-2">
    <input type="checkbox" onclick="freeClicked(this)" class="form-check-input" id="is_free" name="is_free"
        value="1" {{ (isset($event) && $event->is_free) || old('is_free') == '1' ? 'checked' : '' }} />
    <label class="form-check-label" for="is_free">Is Free?</label>
</div>

{{-- <div class="mb-1 mt-2">
    <div id="map"></div>
</div> --}}
<script>
    $(document).ready(function() {

        freeClicked($('#is_free'));
    });

    function freeClicked(ele) {
        console.log('here');
        if ($(ele).is(":checked")) {
            $("#cost").hide();
            $('#cost_label').hide();
            $("#cost").val(null);

        } else {
            $('#cost_label').show();
            $("#cost").show();
        }
    }
</script>
