@extends('components.user-profile-page')
@section('profile-content')
    <div class="col-xl-9 col-lg-8 col-md-12 m-b30">
        <!--Filter Short By-->
        <div class="twm-right-section-panel site-bg-gray">
            <form>


                <!--Basic Information-->
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">Profil Bilgileri</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">

                        <div class="row">

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>İsim & Soyisim</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" name="name" type="text" placeholder="{{ $user->fullName }}">
                                        <i class="fs-input-icon fa fa-building"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Telefon</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" name="phone" type="text" placeholder="{{ $user->phone }}">
                                        <i class="fs-input-icon fa fa-phone-alt"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" name="email" type="email" placeholder="{{ $user->email }}">
                                        <i class="fs-input-icon fas fa-at"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Meslek</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" name="profession" type="text" placeholder="{{ $user->profession }}">
                                        <i class="fs-input-icon fa fa-solid fa-user-tie"></i>
                                    </div>
                                </div>
                            </div>


                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="form-group city-outer-bx has-feedback">
                                    <label>Yaş</label>
                                    <div class="ls-inputicon-box">
                                        <input class="form-control" name="age" type="text" placeholder="{{ $user->age }}">
                                        <i class="fs-input-icon fa fa-birthday-cake"></i>
                                    </div>

                                </div>
                            </div>

                            {{--<div class="col-lg-12 col-md-12">
                                <div class="text-left">
                                    <button type="submit" class="site-button">Save Changes</button>
                                </div>
                            </div>--}}
                        </div>

                    </div>
                </div>

                <!--Social Network-->
                <div class="panel panel-default">
                    <div class="panel-body wt-panel-body p-a20">
                        {{--<div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="text-left">
                                    <button type="submit" class="site-button">Save Changes</button>
                                </div>
                            </div>
                        </div>--}}
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
