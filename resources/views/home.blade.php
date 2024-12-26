@extends('layouts.main')


@section('content')
  <div class="content-body">
    <form action="{{route('auth.register')}}" method="POST">
      @csrf
      <input type="text" name="phone" id="">
      <button>submit</button>
    </form>
  </div>
@endsection