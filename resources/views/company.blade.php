@extends('layouts.site')
@php( $page_name = $data->title )
@push('side-bar-class', 'd-none')
@push('mini-sidebar', 'mini-sidebar')
@section('title', $page_name)
@section('styles')
<!-- page css -->
        <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/company.css') }}">
@endsection
@section('content')
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <img src="{{ asset('assets/img/ellipse-12.png') }}" alt="" id="ellipse-12">
        <img src="{{ asset('assets/img/ellipse-13.png') }}" alt="" id="ellipse-13">
        <img src="{{ asset('assets/img/ellipse-14.png') }}" alt="" id="ellipse-14">
        <div class="col-md-12 text-center mt-3 mb-2" style="margin-top: 4rem !important;"> <!-- col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2 -->
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>{{ $data->title }}</strong></h2>
                <p>{{ $data->description }}</p>
                @role(['admin','super-admin'])
                <a href="{{ route('admin') }}">Skip to admin panel</a>
                @endrole
                <div class="row">
                    <div class="col-md-12 mx-0">
                        @include('layouts.includes.notifications')
                        <form id="msform" action="{{ route('register.companies.save') }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="col-md-6 offset-md-3"> @include('layouts.partials.form-error') </div>
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li id="account" class="active"><strong>Company</strong></li>
                                <li id="personal"><strong>Personal</strong></li>
                                <li id="payment"><strong>Profiling</strong></li>
                                <li id="confirm"><strong>Finish</strong></li>
                            </ul>
                            <!-- fieldset sections -->
                            <fieldset>
                                <div class="form-card">
                                    <p class="fs-title">Account Information</p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="company-ownership-toggle" class="mt-2">Company/Team/Group Registration status:</label>
                                            <br>
                                            <input type="checkbox" id="company-ownership-toggle" name="type" value="new-company">
                                            <br class="mb-4">
                                        </div>
                                        <div class="col-md-6 company-exist">
                                            <label for="company-choice">Select company:</label>
                                            <br>
                                            <select name="company_id" class="form-control select2" id="company-choice" style="width: 100%;">
                                                @foreach($data->companies as $comp)
                                                <option value="{{ $comp->id }}" @if(old('company_id') == $comp->id ) selected @endif>{{ $comp->name }}</option>
                                                @endforeach 
                                            </select> <br class="mb-4">
                                        </div>
                                        <div class="col-md-6 company-exist">
                                            <label>Assigned code (invitation):</label>
                                            <input type="text" id="user_code" name="user_code" placeholder="" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        {{-- the difference --}}
                                        <div class="col-md-4 company-new d-none">
                                            <label for="companyName">Company name</label>
                                            <input type="text" name="company_name" id="companyName" placeholder="" class="form-control"  />
                                        </div>
                                        <div class="col-md-4 company-new d-none">
                                            <label for="companyEmail">Company email</label>
                                            <input type="text" name="company_email" id="companyEmail" placeholder="" class="form-control"  />
                                        </div>
                                        <div class="col-md-4 company-new d-none">
                                            <label for="companyPhone">Company phone number</label>
                                            <input type="text" name="company_phone" id="companyPhone" placeholder="" class="form-control"  />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 company-new d-none">
                                            <label id="companyCountry">Company headquters country</label>
                                            <select name="country_id" class="form-control select2" id="companyCountry" style="width: 100%;">
                                                @foreach($data->countries as $ctry)
                                                <option value="{{ $ctry->id }}">{{ $ctry->country_name }}</option>
                                                @endforeach 
                                            </select> <br class="mb-4">
                                        </div>
                                        <div class="col-md-4 company-new d-none">
                                            <label for="companyVillage">Company locale (Village)</label>
                                            <input type="text" name="companyVillage" placeholder="" class="form-control"  />
                                        </div>
                                        <div class="col-md-4 company-new d-none">
                                            <label>Tax Identification Number (TIN)</label>
                                            <input type="text" name="companyTin" placeholder="" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 company-new d-none">
                                            <label>Company address (as signature)</label>
                                            <textarea name="companyAddress" class="form-control" placeholder=""></textarea>
                                        </div>
                                        <div class="col-md-4 company-new d-none">
                                            <label for="langSel">Major language</label>
                                            <select id="langSel" name="language" class="form-control select2" style="width: 100%;">
                                                @foreach($data->languageList as $lang)
                                                <option value="{{ $lang->id }}">
                                                    {{ $lang->language_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 company-new d-none">
                                            <label for="other_languages">Other languages</label>
                                            <select name="other_languages[]" id="other_languages" multiple class="form-control select2" style="width: 100%">
                                                @foreach($data->languageList as $lang)
                                                <option value="{{ $lang->id }}">
                                                    {{ $lang->language_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="button" name="next" class="next action-button" value="Next Step &raquo;" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <p class="fs-title">Personal Information</p>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Initials</label>
                                            <br>
                                            <select class="list-dt form-control select2" name="prefix" style="width: 100%">
                                                <option>-- select --</option>
                                                <option value="Mr.">Mr.</option>
                                                <option value="Mrs.">Mrs.</option>
                                                <option value="Ms.">Ms.</option>
                                                <option value="Rev.">Rev.</option>
                                                <option value="Tr.">Tr.</option>
                                                <option value="Prof.">Prof.</option>
                                                <option value="Dr.">Dr.</option>
                                                <option value="">None</option>
                                            </select> <br class="mb-4">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Full names</label>
                                            <input type="text" name="user_name" placeholder="" class="form-control" value="{{ Auth::user()->name }}" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Email</label>
                                            <input type="text" name="user_email" placeholder="Email address" class="form-control" value="{{ Auth::user()->email }}" readonly />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Gender</label>
                                            <br>
                                            <select name="gender_id" class="list-dt form-control select2" style="width: 100%">
                                                @foreach($data->genders as $gender)
                                                <option value="{{ $gender->id }}" title="{{ $gender->gender_description }}">{{ $gender->gender_name }}</option>
                                                @endforeach
                                            </select> <br class="mb-4">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Personal phone number</label>
                                            <input type="text" name="user_phone" placeholder="" class="form-control" value="{{ Auth::user()->phone }}" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Occupation</label>
                                            <input type="text" name="user_occupation" class="form-control" value="{{ Auth::user()->occupation }}" />
                                        </div>
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="&laquo; Previous" />
                                <input type="button" name="next" class="next action-button" value="Next Step &raquo;" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Additional profiling information</h2>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Date of birth</label>
                                            <input type="date" name="dob" class="form-control" value="" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Profile status</label>
                                            <select class="list-dt form-control select2" name="status" style="width: 100%">
                                                <option value="Active">Active</option>
                                                <option value="Public">Public</option>
                                                <option value="Private">Private</option>
                                                <option value="Busy">Busy</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>User bio</label>
                                            <textarea id="bio" name="bio" class="form-control" placeholder=""></textarea>
                                        </div>
                                        <div class="col-12">
                                            <hr />
                                            <h4>Additional company</h4>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Has a warehouse (Store)</label>
                                            <select class="list-dt form-control select2" name="has_store" style="width: 100%">
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Has store-fronts (Branches)</label>
                                            <select class="list-dt form-control select2" name="has_store_fronts" style="width: 100%">
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value=" &laquo; Previous" />
                                <input type="button" name="make_payment" class="next action-button" value="Next  &raquo;" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title text-center">Success !</h2> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-3">
                                            <img src="{{ asset('assets/img/ok-green-tick.png') }}" class="fit-image">
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                            <h5>You Have Successfully Finished Your Company Profile</h5>
                                        </div>
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value=" &laquo; Previous" />
                                <input type="submit" class="next action-button" value="Submit" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script>
        let earliestYear = 1900;
        let dateDropdown = document.getElementById('selected-year');
        let currentYear = new Date().getFullYear();
        while (currentYear >= earliestYear) {
            let dateOption = document.createElement('option');
            dateOption.text = currentYear;
            dateOption.value = currentYear;
            dateDropdown.add(dateOption);
            currentYear -= 1;
        }

        $(document).ready(function(){
            var current_fs, next_fs, previous_fs; //fieldsets
            var opacity;
            $(function() { $('#company-ownership-toggle').bootstrapToggle({ on: 'New', off: 'Registered' }); });
            $('#company-ownership-toggle').change(function(){
                var togod = $(this).is(':checked');
                
                if (togod) {
                    // new company || company-new
                    $('.company-new').removeClass('d-none');
                    $('.company-exist').addClass('d-none');
                    console.log('new company');
                } else {
                    // existing || company-exist
                    $('.company-exist').removeClass('d-none');
                    $('.company-new').addClass('d-none');
                    console.log('already existing company');
                }
            });
            $(".next").click(function(){
                current_fs = $(this).parent();
                next_fs = $(this).parent().next();

                var togod = $('#company-ownership-toggle').is(':checked');
                console.log(togod);

                //Add Class Active
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                //show the next fieldset
                next_fs.show();
                //hide the current fieldset with style
                current_fs.animate({opacity: 0}, {
                    step: function(now) {
                        // for making fielset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        next_fs.css({'opacity': opacity});
                    },
                    duration: 600
                });
            });
            $(".previous").click(function(){
                current_fs = $(this).parent();
                previous_fs = $(this).parent().prev();

                //Remove class active
                $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

                //show the previous fieldset
                previous_fs.show();

                //hide the current fieldset with style
                current_fs.animate({opacity: 0}, {
                    step: function(now) {
                        // for making fielset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        previous_fs.css({'opacity': opacity});
                    },
                    duration: 600
                });
            });
            $('.radio-group .radio').click(function(){
                $(this).parent().find('.radio').removeClass('selected');
                $(this).addClass('selected');
            });
            $(".submit").click(function(ev){
                ev.preventDefault();
                return false;
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: 'resolve' // need to override the changed default
            });
        });
    </script>
@endsection