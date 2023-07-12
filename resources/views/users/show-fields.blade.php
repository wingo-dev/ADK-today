<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="name">Name</label>
    <input disabled type="text" class="form-control" id="name" name="name"
        value="{{ isset($user) ? $user->name : old('name') }}"
        placeholder="Please enter name" />
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="email">Email</label>
    <input disabled type="email" class="form-control" id="email" name="email"
        value="{{ isset($user) ? $user->email : old('email') }}"
        placeholder="Please enter email" />
</div>

<div class="col-md-4 col-sm-6 mb-1">
    <label class="form-label" for="role">Role</label>
    <input disabled type="text" class="form-control" id="role" name="role"
    value="{{ isset($user) ? \App\Utils\Common\UserRoles::ALL[$user->role] : old('role') }}"
    placeholder="Please enter role" />
</div>