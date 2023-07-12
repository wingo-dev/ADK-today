<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name"
        value="{{ old('name') ? old('name') : (isset($user) ? $user->name : '') }}"
        placeholder="Please enter first name" />
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password"
        value=""
        placeholder="Please enter password" />
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="password_confirmation">Password Confirmation</label>
    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
        placeholder="Please Confirm password" />
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="address1">Address 1</label>
    <input type="text" class="form-control" id="address1" name="address1"
        value="{{ old('address1') ? old('address1') : (isset($user) ? $user->address1 : '') }}"
        placeholder="Please enter address1" />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="address2">Address 2</label>
    <input type="text" class="form-control" id="address2" name="address2"
        value="{{ old('address2') ? old('address2') : (isset($user) ? $user->address2 : '') }}"
        placeholder="Please enter address2" />
</div>

@if(auth()->user()->role == \App\Utils\Common\UserRoles::VENDOR)

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title"
        value="{{ old('title') ? old('title') : (isset($user) ? $user->title : '') }}"
        placeholder="Please enter title" />
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="organization">Organization</label>
    <input type="text" class="form-control" id="organization" name="organization"
        value="{{ old('organization') ? old('organization') : (isset($user) ? $user->organization : '') }}"
        placeholder="Please enter organization" />
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="phone">Phone</label>
    <input type="text" class="form-control" id="phone" name="phone"
        value="{{ old('phone') ? old('phone') : (isset($user) ? $user->phone : '') }}"
        placeholder="Please enter phone" />
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="url">Url</label>
    <input type="text" class="form-control" id="url" name="url"
        value="{{ old('url') ? old('url') : (isset($user) ? $user->url : '') }}"
        placeholder="Please enter url" />
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="town">Town</label>
    <input type="text" class="form-control" id="town" name="town"
        value="{{ old('town') ? old('town') : (isset($user) ? $user->town : '') }}"
        placeholder="Please enter town" />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="county">County</label>
    <input type="text" class="form-control" id="county" name="county"
        value="{{ old('county') ? old('county') : (isset($user) ? $user->county : '') }}"
        placeholder="Please enter county" />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="state">State</label>
    <input type="text" class="form-control" id="state" name="state"
        value="{{ old('state') ? old('state') : (isset($user) ? $user->state : '') }}"
        placeholder="Please enter state" />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="zip">Zip</label>
    <input type="text" class="form-control" id="zip" name="zip"
        value="{{ old('zip') ? old('zip') : (isset($user) ? $user->zip : '') }}"
        placeholder="Please enter zip" />
</div>
@endif

