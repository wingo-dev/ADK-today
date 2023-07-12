<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name"
        value="{{ isset($user) ? $user->name : old('name') }}"
        placeholder="Please enter name" />
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email"
        value="{{ isset($user) ? $user->email : old('email') }}"
        placeholder="Please enter email" />
</div>


<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password"
        placeholder="Please enter password" autocomplete="new-password" />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="password_confirmation">Password Confirmation</label>
    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
        placeholder="Please enter password_confirmation" autocomplete="new-password_confirmation" />
</div>


<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="role">Role</label>
    <select class="form-control" name="role" id="role">
        @foreach (\App\Utils\Common\UserRoles::ALL as $key => $role)

        @if(\App\Utils\Common\UserRoles::SUPER_ADMIN === $key || (\App\Utils\Common\UserRoles::SUPER_ADMIN != auth()->user()->role && \App\Utils\Common\UserRoles::ADMIN === $key))

        @else
        <option value="{{$key}}" {{isset($user) && $user->role == $key ? "Selected" : ''}}>{{$role}}</option>
        @endif
        @endforeach

    </select>
</div>
@if(isset($user) && \App\Utils\Common\UserRoles::VENDOR === $user->role)
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title"
        value="{{ isset($user) ? $user->title : old('title') }}"
        placeholder="Please enter title" />
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="organization">Organization</label>
    <input type="text" class="form-control" id="organization" name="organization"
        value="{{ isset($user) ? $user->organization : old('organization') }}"
        placeholder="Please enter organization" />
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="phone">Phone</label>
    <input type="text" class="form-control" id="phone" name="phone"
        value="{{ isset($user) ? $user->phone : old('phone') }}"
        placeholder="Please enter phone" />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="address1">Address 1</label>
    <input type="text" class="form-control" id="address1" name="address1"
        value="{{ isset($user) ? $user->address1 : old('address1') }}"
        placeholder="Please enter address1" />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="address2">Address 2</label>
    <input type="text" class="form-control" id="address2" name="address2"
        value="{{ isset($user) ? $user->address2 : old('address2') }}"
        placeholder="Please enter address2" />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="url">Url</label>
    <input type="text" class="form-control" id="url" name="url"
        value="{{ isset($user) ? $user->url : old('url') }}"
        placeholder="Please enter url" />
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="town">Town</label>
    <input type="text" class="form-control" id="town" name="town"
        value="{{ isset($user) ? $user->town : old('town') }}"
        placeholder="Please enter town" />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="county">County</label>
    <input type="text" class="form-control" id="county" name="county"
        value="{{ isset($user) ? $user->county : old('county') }}"
        placeholder="Please enter county" />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="state">State</label>
    <input type="text" class="form-control" id="state" name="state"
        value="{{ isset($user) ? $user->state : old('state') }}"
        placeholder="Please enter state" />
</div>
<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="zip">Zip</label>
    <input type="text" class="form-control" id="zip" name="zip"
        value="{{ isset($user) ? $user->zip : old('zip') }}"
        placeholder="Please enter zip" />
</div>
@endif
{{-- <div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="status">Status</label>
    <select class="form-control" name="status" id="status">
        @foreach (\App\Utils\Common\UserStatus::ALL as $key => $status)

        <option value="{{$key}}" {{isset($user) && $user->status == $key ? "selected" : ""}}>{{$status}}</option>

        @endforeach

    </select>
</div> --}}

@if(isset($user))
<div class="col-md-4 col-sm-6 mb-1 mt-2">
    <label class="form-check-label" for="is_verified">User Verified</label>
    <input class="form-check-input" type="checkbox" id="is_verified" {{$user->email_verified_at != null ? "Checked" : ""}} name="is_verified" value="1">
</div>
@endif

