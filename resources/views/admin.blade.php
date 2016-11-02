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

  <div class="container card-list">
    <a href="/allpics" class="button button-block">
        Check All pictures <i class="fa fa-arrow-right"></i>
    </a>
    @foreach ($allDates as $key => $date)
        @if ($key == 0)
          <div class="card blue">
        @elseif ($key == 1)
          <div class="card green">
        @elseif ($key == 2)
          <div class="card orange">
        @else
          <div class="card red">
        @endif
        <div class="title">Period {{$key +1}}</div>
          @if ($date->enddate>$now)
            <a href="/editperiod/{{$date->id}}" class="edit"><i class="fa fa-pencil"></i></a>
          @endif
        <a href="/deleteperiod/{{$date->id}}" class="edit"><i class="fa fa-trash"></i></a>
        <span class="glyphicon glyphicon-upload"></span>
        <div class="value">{{$date->startdate}}</div>
        <div class="value">{{$date->enddate}}</div>
        <div class="value">{{$date->price}}</div>
        <div class="stat">
          <div class="value">Top voted</div>
        @foreach ($topvoted as $key => $topvote)
          @if ($topvote->wedstrijd_id == $date->id)
            <div class="value">{{$topvote->votes}}</div>
            <div class="topname">{{$topvote->name}}</div>
            @break
          @endif
        @endforeach

        </div>
      </div>
    @endforeach
  </div>
  <div class="container projects">
    <div class="projects-inner">
      <header class="projects-header">
        <div class="title">{{$aantal}} Periods are set</div>
        <div class="count">| add a new one</div><span class="glyphicon glyphicon-download-alt"></span>
        <hr>
        <form role="form" method="POST" action="{{ url('/createperiod') }}">
            {{ csrf_field() }}
            @if(session()->has('error'))
              <li>{{ session()->get('error') }}</li>
            @endif

            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
              <div class="field-wrap">
                <label for="price" >Price <span class="req">*</span></label>


                    <input id="price" type="text" name="price" value="{{ old('price') }}" >

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
                    <input id="startdate" type="date"  name="startdate" required>

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
                    <input id="enddate" type="date"  name="enddate" required>

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
                        Create new project
                    </button>

                </div>
            </div>
        </form>
      </header>
    </div>
  </div>

@endsection
