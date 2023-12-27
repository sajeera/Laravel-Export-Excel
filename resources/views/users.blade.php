@extends('home')

@section('header')
    <!--livewire Styles -->
    @livewireStyles
@endsection()

@section('status')
    <div>
    <?php
    if (session('error'))         
        echo session('error');  
    if (session('success'))
        echo session('success');  
      ?>
    </div>
@endsection()

@section('content')
    <div>
        @livewire('export')

        @livewire('import')
    </div>
@endsection()

@section('footer')
    <!--livewire scripts -->
    @livewireScripts
@endsection()