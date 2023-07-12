<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="title">Title</label>
    <input disabled type="text" class="form-control" id="title" name="title"
        value="{{ isset($event) ? $event->title : old('title') }}" />
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="vendor_id">Vendor</label>
    <input disabled type="text" class="form-control" id="name" name="name"
    value="{{$event->vendor->name}}"/>
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="category_id">Category</label>
    <select disabled class="form-select" name="category_id" id="category_id" onchange="getTags()">
        @foreach($categories as $category)
        <option value="{{ $category->id }}" {{isset($event) && $event->category_id == $category->id ? "selected" : ""}}>{{
            $category->name }}</option>
        @endforeach
    </select>
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="tags">Tags</label>
    <select disabled class="form-select select2" name="tags[]" id="tags" multiple>
        @foreach($tags as $tag)
        <option value="{{ $tag->id }}" {{isset($event) && in_array($tag->id,$event->tags->pluck('id')->toArray()) ? "selected" : ""}}>{{
            $tag->name }}</option>
        @endforeach
    </select>
</div>

<div class="col-md-8 col-sm-6 mb-1">
    <label class="form-label" for="long_description">Long Description</label>
    <textarea disabled class="form-control" name="long_description" id="long_description" cols="30" rows="10"  placeholder="Please enter Long Description" >{{ isset($event) ? $event->long_description : old('long_description') }}</textarea>

</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="short_description">Short Description</label>
    <input disabled type="text" class="form-control" id="short_description" name="short_description"
        value="{{ isset($event) ? $event->short_description : old('short_description') }}"
        />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="address">Address</label>
    <input disabled type="text" class="form-control" id="address" name="address"
        value="{{ isset($event) ? $event->address : old('address') }}" />
</div>


<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="start_date">Start Date</label>
    <input disabled type="date" class="form-control" id="start_date" name="start_date"
        value="{{ isset($event) ? $event->start_date : old('start_date') }}" />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="start_time">Start Time</label>
    <input disabled type="time" class="form-control" id="start_time" name="start_time"
        value="{{ isset($event) ? $event->start_time : old('start_time') }}" />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="event_url">Event Url</label>
    <input disabled type="text" class="form-control" id="event_url" name="event_url"
        value="{{ isset($event) ? $event->event_url : old('event_url') }}" />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="end_date">End Date</label>
    <input disabled type="date" class="form-control" id="end_date" name="end_date"
        value="{{ isset($event) ? $event->end_date : old('end_date') }}" />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="end_time">End Time</label>
    <input disabled type="time" class="form-control" id="end_time" name="end_time"
        value="{{ isset($event) ? $event->end_time : old('end_time') }}" />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="image">Image</label>
    <img src="{{asset($event->image)}}" width="200" height="200" alt="">
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="thumbnail">Thumbnail</label>
    <img src="{{asset($event->thumbnail)}}" width="200" height="200" alt="">
</div>
<div class="col-md-4 col-sm-6 mb-1">
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="coordinates">Coordinates</label>
    <input disabled type="text" class="form-control" id="coordinates" name="town"
    value="{{ $event->coordinates}}" />
</div>


<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="county_id">County</label>
    <input disabled type="text" class="form-control" id="county" name="county"
    value="{{ $event->county->name}}" />
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="town_id">Town</label>
    <input disabled type="text" class="form-control" id="town" name="town"
    value="{{ $event->town->name}}" />
</div>
<div class="col-md-4 col-sm-6 mb-1 mt-2">
    <input disabled type="checkbox" class="form-check-input disabled" id="is_free" name="is_free" value="1" {{isset($event) && $event->is_free || old('is_free') == "1" ? "checked" : ""}}/>
    <label class="form-check-label" for="is_free">Is Free?</label>
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="cost" id="cost_label">Cost</label>
    <input disabled type="number" class="form-control" id="cost" name="cost"
        value="{{ isset($event) ? $event->cost : old('cost') }}" />
</div>
@if($event->coordinates)
<div class="mb-1 mt-2">
    <div id="map_show"></div>
</div>
@endif


<script>
    $(document).ready(function(){

    freeClicked($('#is_free'));
    });
    function freeClicked(ele){
        console.log('here');
        if($(ele).is(":checked")) {
            $("#cost").hide();
            $('#cost_label').hide();
            $("#cost").val(null);

        } else {
            $('#cost_label').show();
            $("#cost").show();
        }
    }
    </script>




