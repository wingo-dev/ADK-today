@extends('layouts.front_end.master')

@section('content')

<style>
    .form-group .required {
        color: red;
        display: inline;
        margin-left: 5px;
        line-height: 2.8;
    }
</style>
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            {{-- @dd(auth()->user()) --}}
            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">Edit Profile</div>

                    <div class="card-body">
                        <label for="" class="text-danger py-2">* Indicates Required Field</label>
                        
                        @php
                        $url = request()->get('redirect') ? route('update-account', ['redirect' => request()->get('redirect')]) : route('update-account');
                        @endphp

                        <form action="{{ $url }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            @if(auth()->user()->role == \App\Utils\Common\UserRoles::SUPER_ADMIN || auth()->user()->role == \App\Utils\Common\UserRoles::ADMIN)
                            <div class="mb-2">
                                <label for="name" class="form-label">Name <i class="text-danger">*</i></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{old('name')? old('name') : auth()->user()->name}}"
                                    placeholder="Enter your Name">
                                @if($errors->has('name'))
                                <span class="text-danger col-sm-4">{{$errors->first('name')}}</span>
                                @endif
                            </div>
                            @endif
                            
                            <div class="mb-2">
                                <label for="email" class="form-label">Email <i class="text-danger">*</i></label>
                                <input type="text" class="form-control" id="email" name="email"
                                    value="{{old('email')? old('email') : auth()->user()->email}}"
                                    placeholder="Enter your Email">
                                @if($errors->has('email'))
                                <span class="text-danger col-sm-4">{{$errors->first('email')}}</span>
                                @endif
                            </div>
                            
                            @if(auth()->user()->role == \App\Utils\Common\UserRoles::SUPER_ADMIN || auth()->user()->role == \App\Utils\Common\UserRoles::ADMIN)
                            <div class="mb-2">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    autocomplete="new-password">
                                @if($errors->has('password'))
                                <span class="text-danger col-sm-4">{{$errors->first('password')}}</span>
                                @endif
                            </div>
                            <div class="mb-2">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">
                                @if($errors->has('password_confirmation'))
                                <span class="text-danger col-sm-4">{{$errors->first('password')}}</span>
                                @endif
                            </div>
                            @endif
                                
                            @if(auth()->user()->role == \App\Utils\Common\UserRoles::VENDOR || auth()->user()->role == \App\Utils\Common\UserRoles::ADMIN || auth()->user()->role == \App\Utils\Common\UserRoles::SUPER_ADMIN)

                            <!-- Address Starts -->
                            <div class="mb-2">
                                <label for="address1" class="form-label">Address 1 <i class="text-danger">*</i></label>
                                <input type="text" class="form-control" id="address1" name="address1"
                                    value="{{old('address1')? old('address1') : auth()->user()->address1}}"
                                    placeholder="Enter your Address 1">
                                @if($errors->has('address1'))
                                <span class="text-danger col-sm-4">{{$errors->first('address1')}}</span>
                                @endif
                            </div>
                            <div class="mb-2">
                                <label for="address2" class="form-label">Address 2</label>
                                <input type="text" class="form-control" id="address2" name="address2"
                                    value="{{old('address2')? old('address2') : auth()->user()->address2}}"
                                    placeholder="Enter your Address 2">
                                @if($errors->has('address2'))
                                <span class="text-danger col-sm-4">{{$errors->first('address2')}}</span>
                                @endif
                            </div>

                            {{-- start vendor or admin or super admin --}}

                            <div class="row">
                                <div class="mb-2 col-md-6">
                                    <label class="form-label" for="title">Title <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ old('title') ? old('title') : (isset($user) ? $user->title : '') }}"
                                        placeholder="Please enter title" />
                                    @if($errors->has('title'))
                                    <span class="text-danger col-sm-4">{{$errors->first('title')}}</span>
                                    @endif
                                </div>

                                <div class="mb-2 col-md-6">
                                    <label class="form-label" for="organization">Organization <i
                                            class="text-danger">*</i></label>
                                    <input type="text" class="form-control" id="organization" name="organization"
                                        value="{{ old('organization') ? old('organization') : (isset($user) ? $user->organization : '') }}"
                                        placeholder="Please enter organization" />
                                    @if($errors->has('organization'))
                                    <span class="text-danger col-sm-4">{{$errors->first('organization')}}</span>
                                    @endif
                                </div>

                                <div class="mb-2 col-md-6">
                                    <label class="form-label" for="phone">Phone <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ old('phone') ? old('phone') : (isset($user) ? $user->phone : '') }}"
                                        placeholder="Please enter phone" />
                                    @if($errors->has('phone'))
                                    <span class="text-danger col-sm-4">{{$errors->first('phone')}}</span>
                                    @endif
                                </div>

                                <div class="mb-2 col-md-6">
                                    <label class="form-label" for="url">Url</label>
                                    <input type="text" class="form-control" id="url" name="url"
                                        value="{{ old('url') ? old('url') : (isset($user) ? $user->url : '') }}"
                                        placeholder="Please enter url" />
                                    @if($errors->has('url'))
                                    <span class="text-danger col-sm-4">{{$errors->first('url')}}</span>
                                    @endif
                                </div>

                                <div class="mb-2 col-md-6">
                                    <label class="form-label" for="town">Town <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" id="town" name="town"
                                        value="{{ old('town') ? old('town') : (isset($user) ? $user->town : '') }}"
                                        placeholder="Please enter town" />
                                    @if($errors->has('town'))
                                    <span class="text-danger col-sm-4">{{$errors->first('town')}}</span>
                                    @endif
                                </div>
                                <div class="mb-2 col-md-6">
                                    <label class="form-label" for="county">County <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" id="county" name="county"
                                        value="{{ old('county') ? old('county') : (isset($user) ? $user->county : '') }}"
                                        placeholder="Please enter county" />
                                    @if($errors->has('county'))
                                    <span class="text-danger col-sm-4">{{$errors->first('county')}}</span>
                                    @endif
                                </div>
                                <div class="mb-2 col-md-6">
                                    <label class="form-label" for="state">State <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" id="state" name="state"
                                        value="{{ old('state') ? old('state') : (isset($user) && !empty($user->state) ? $user->state : 'New York') }}"
                                        placeholder="Please enter state" />
                                    @if($errors->has('state'))
                                    <span class="text-danger col-sm-4">{{$errors->first('state')}}</span>
                                    @endif
                                </div>
                                <div class="mb-2 col-md-6">
                                    <label class="form-label" for="zip">Zip <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" id="zip" name="zip"
                                        value="{{ old('zip') ? old('zip') : (isset($user) ? $user->zip : '') }}"
                                        placeholder="Please enter zip" />
                                    @if($errors->has('zip'))
                                    <span class="text-danger col-sm-4">{{$errors->first('zip')}}</span>
                                    @endif
                                </div>
                            </div>
                            @endif

                            {{-- End Vendor or Admin or Super Admin --}}
                            <div class="modal-footer">
                                <div class="mb-2">

                                    <div class="pull-right">
                                        <a href="javascript: history.back()" class="btn btn btn-secondary mt-2">Back</a>
                                        <button type="submit" class="btn btn-primary mt-2"
                                            style="margin-right:1rem">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
</main>
<script>
    window.scrollTo(0, document.body.scrollHeight);

</script>
@endsection
