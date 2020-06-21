@extends('layouts.app')

@section('style')
<style>

</style>
@endsection

@section('content')
<div id="content"><br><br><br><br>
    <div class="row">
    	<div class="superbox col-sm-12">
        @foreach($data as $d)
    		<div class="superbox-list">
    			<img src="{{ asset($d->thumb) }}" data-img="{{ asset($d->photo) }}" alt="{{ $d->deskripsi }}" title="{{ $d->name }}" class="superbox-img">
    		</div>
        @endforeach
    		<div class="superbox-float"></div>
    	</div>
    	<div class="superbox-show" style="height:300px; display: none"></div>
    </div>
</div><br><br><br><br>

@endsection

@section('script')
<script>

$(document).ready(function() {
  pageSetUp();
  $('.superbox').SuperBox();
})

</script>
@endsection
