@extends('layouts.app')

@section('content')
    <form action="" method="post">
      @csrf
      password:<input type="password" name="input_password"> 
      <input type="submit" value="提出">
    </form>
@endsection
