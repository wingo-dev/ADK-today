<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ isset($tag) ? $tag->name : old('name') }}"
        placeholder="Please enter name" />
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="name">Category</label>
    <select class="form-control" name="category_id" id="category_id">
        @foreach ($categories as $category)

        <option value="{{$category->id}}" {{isset($tag) && $tag->category_id == $category->id ? "selected" : ""}}>{{$category->name}}</option>

        @endforeach

    </select>
</div>