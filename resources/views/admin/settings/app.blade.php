@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('admin.setting.account') }}" class="btn btn-sm btn-outline-primary">Ustawienia
                    konta</a>
                <a href="{{ route('admin.setting.application') }}" class="btn btn-sm btn-primary">Ustawienia
                    apliacji</a>

                <div class="mt-3">
                    @foreach($settingsApp as $key => $setting)
                        <form method="post" action="{{ route('admin.setting.application') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $setting->name }}" name="name">
                            <input type="hidden" value="{{ $setting->type }}" name="type">
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <h4 style="text-align: right;margin-top: 40px;">{{ __('admin.settings.'.$setting->name) }}</h4>
                                </div>
                                <div class="col-md-5">
                                    @if($setting->type == \App\Models\Settings\SettingApp::$typeValue['txt'])
                                        <label for="value_{{$key}}" class="col-form-label">Wartość</label>
                                        <input type="text" id="value_{{$key}}" value="{{ $setting->value }}" class="form-control" name="value">
                                    @endif
                                    @if($setting->type == \App\Models\Settings\SettingApp::$typeValue['file'])
                                        <label for="value_{{$key}}" class="col-form-label">Wartość</label>
                                        <input type="file" id="value_{{$key}}" class="form-control" name="value">
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" style="margin-top: 38px" class="btn btn-sm btn-primary">Zapisz</button>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
