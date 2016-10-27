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
    <div class="card blue">
      <div class="title">Project 1</div> <a href="" class="edit">edit</a> </button> <span class="glyphicon glyphicon-upload"></span>
      <div class="value">05/10/16</div>
      <div class="value">06/11/16</div>
      <div class="stat">
        <div class="title">Top vote</div>
        <div class="value">5</div>
      </div>
    </div>
    <div class="card green">
      <div class="title">Project 2</div><span class="glyphicon glyphicon-upload"></span>
      <div class="value">00/00/00</div>
      <div class="value">00/00/00</div>
      <div class="stat">
        <div class="title">Top vote</div>
        <div class="value">0</div>
      </div>

    </div>
    <div class="card orange">
      <div class="title">Project 3</div><span class="glyphicon glyphicon-download"></span>
      <div class="value">00/00/00</div>
      <div class="value">00/00/00</div>
      <div class="stat">
        <div class="title">Top vote</div>
        <div class="value">0</div>
      </div>
    </div>
    <div class="card red">
      <div class="title">Project 4</div><span class="glyphicon glyphicon-download"></span>
      <div class="value">00/00/00</div>
      <div class="value">00/00/00</div>
      <div class="stat">
        <div class="title">Top vote</div>
        <div class="value">0</div>
      </div>
    </div>
  </div>
  <div class="container projects">
    <div class="projects-inner">
      <header class="projects-header">
        <div class="title">2 Projects are set</div>
        <div class="count">| add new date</div><span class="glyphicon glyphicon-download-alt"></span>
        <hr>
        <form role="form" method="POST" action="{{ url('/createproject') }}">
            {{ csrf_field() }}

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
