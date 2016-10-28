@extends('layouts.home-layout')
@section('title', 'All Pictures')
@section('css')
    <link rel="stylesheet" href="/css/admin.css">
        <link rel="stylesheet" href="/css/form.css">
@endsection
@section('scripts')


        <script src="/js/admin.js"></script>
@endsection
@section('content')

  <div class="container projects">
    <div class="projects-inner">
      <header class="projects-header">
        <div class="title">Edit</div>
        <div class="count"></div><span class="glyphicon glyphicon-download-alt"></span>
        <hr>
        <form role="form" method="POST" action="/updateperiod/{{$contest->id}}">
            {{ csrf_field() }}
            @if(session()->has('error'))
              <li>{{ session()->get('error') }}</li>
            @endif

            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
              <div class="field-wrap">
                <label for="price" >Price <span class="req">*</span></label>

                    {{-- <input type="hidden" id="SavePrice" value="{{ old('price') }}" > --}}
                    <input id="price" type="text" name="price" value="{{ $contest->price }}" >

                    @if ($errors->has('price'))
                        <span class="help-block">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('startdate') ? ' has-error' : '' }}">
              <div class="field-wrap">

                <label for="startdate" >Start date <span class="req">*</span></label>
                    <input id="startdate" type="date"  name="startdate" value="{{ $contest->startdate }}" required>

                    @if ($errors->has('startdate'))
                        <span class="help-block">
                            <strong>{{ $errors->first('startdate') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('enddate') ? ' has-error' : '' }}">
              <div class="field-wrap">

                <label for="enddate" >End date <span class="req">*</span></label>
                    <input id="enddate" type="date"  name="enddate" value="{{ $contest->enddate }}" required>

                    @if ($errors->has('enddate'))
                        <span class="help-block">
                            <strong>{{ $errors->first('enddate') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div>
                    <button type="submit" class="button button-block">
                        Save
                    </button>

                </div>
            </div>
        </form>
      </header>
    </div>
  </div>

@endsection
