@extends('layouts.app')

@section('content')

    <div class="container">
        @if($user->avatar)
            <img class="rounded-circle" src="{{asset('/storage/' . $user->avatar->path)}}" alt=""
                 style="width: 200px;height:200px">
        @else
            <img class="rounded-circle" src="{{asset('/storage/avatars/default.jpg' )}}" alt=""
                 style="width: 200px;height:200px">
        @endif


        <form action="{{route('avatar.upload')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <input type="file" name="avatar">
            </div>
            <button class="btn btn-default" type="submit">Upload</button>
        </form>


        {{--        <img class="img-thumbnail" src="{{asset('/storage/' . session('path'))}}" alt="">--}}
    </div>





    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-5">
                    <div class="card-header">Profile</div>
                    <div class="card-body">
                        @if(session('successProf'))
                            <span
                                class="alert alert-success d-flex justify-content-center p-2">{{ session('successProf') }}</span>
                        @endif
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ $user['name'] }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __(' E-mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ $user['email'] }}" required autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password">
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" name="UpdateProfile">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-5">
                    <div class="card-header">Details</div>

                    <div class="card-body">
                        @if(session('successDe'))
                            <span
                                class="alert alert-success d-flex justify-content-center p-2">{{ session('successDe') }}</span>
                        @endif

                        <form method="POST" action="{{ route('detail.update') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="phone"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text"
                                           class="form-control @error('phone') is-invalid @enderror" name="phone"
                                           value="{{optional($user->detail)->phone }}" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text"
                                           class="form-control @error('address') is-invalid @enderror"
                                           name="address"
                                           value="{{ optional($user->detail)->address  }}" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="city"
                                       class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                                <div class="col-md-6">
                                    <input id="city" type="text"
                                           class="form-control @error('city') is-invalid @enderror" name="city"
                                           value="{{optional($user->detail)->city }}"
                                           autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="country"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                                <div class="col-md-6">
                                    <input id="country" type="text"
                                           class="form-control @error('country') is-invalid @enderror"
                                           name="country"
                                           value="{{optional($user->detail)->country }}" autofocus>
                                </div>

                            </div>


                            <div class="form-group row">
                                <label for="profession"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Select Profession') }}</label>
                                <div class="col-md-6">
                                    <select class="js-example-basic-multiple" name="profession[]" multiple="multiple">
                                        <option value="">Select Country</option>
                                        @foreach($professions as $profession)
                                            <option value="{{$profession->id}} "
                                                    @if(in_array($profession->id,$user->professions->pluck('id')->all())) selected @endif >{{$profession->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">

                                    <button type="submit" class="btn btn-primary" name="UpdateDetails">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


