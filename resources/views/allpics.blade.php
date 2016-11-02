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
    <a href="/admin" class="button button-block">
        <i class="fa fa-arrow-left"></i> back
    </a>

    <div class="container">



    <h1>All the pics</h1>

    <!-- will be used to show any messages -->
    {{-- @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif --}}

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>name</td>
                <td>email</td>
                <td>photo id</td>
                <td>img name</td>
                <td>votes</td>
                <td>contest id</td>
                <td>price</td>
                <td>Deleted</td>

            </tr>
        </thead>
        <tbody>
        @foreach($allpics as $key => $pic)
            <tr>
                <td>{{ $pic->name }}</td>
                <td>{{ $pic->email }}</td>
                <td>{{ $pic->id }}</td>
                <td>{{substr($pic->contestimage, 5) }}</td>
                <td>{{ $pic->votes }}</td>
                <td>{{ $pic->wedstrijd_id }}</td>
                <td>{{ $pic->price }}</td>
                <td>@if ($pic->isdeleted == 1)
                  True
                @else
                  False
                @endif</td>


                <!-- we will also add show, edit, and delete buttons -->
                <td>

                    <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                    <!-- we will add this later since its a little more complicated than the other two buttons -->

                    <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                  @if ($pic->isdeleted == 0)
                    <a class="btn btn-danger" href="{{ URL::to('deletepic/' . $pic->id) }}">delete</a>
                  @else
                    <a class="btn btn-info" href="{{ URL::to('recoverpic/' . $pic->id) }}">recover</a>
                  @endif



                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    </div>

  </div>

@endsection
