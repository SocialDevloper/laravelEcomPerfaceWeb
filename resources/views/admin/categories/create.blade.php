@extends('admin.app')
@section('breadcrumbs')
	<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
	<li class="breadcrumb-item"><a href="{{route('admin.category.index')}}">Categories</a></li>
	<li class="breadcrumb-item active" aria-current="page">Add/Edit Category</li>
@endsection
@section('content')

<form action="@if(isset($category)) {{route('admin.category.update', $category)}} @else {{route('admin.category.store')}} @endif" method="post" accept-charset="utf-8">
	@csrf
	@if(isset($category))
		@method('PUT')
	@endif
	<div class="form-group row">
		<div class="col-sm-12">
			@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
		</div>
		<div class="col-sm-12">
			@if (session()->has('message'))
			<div class="alert alert-success">
				{{session('message')}}
			</div>
			@endif
		</div>
		<div class="col-sm-12">
			<label class="form-control-label">Title: </label>
			<input type="text" id="txturl" name="title" class="form-control " value="{{old('title')}}{{@$category->title}}">
			<p class="small">{{config('app.url')}}/<span id="url">{{old('title')}}{{@$category->slug}}</span></p>
			<input type="hidden" name="slug" id="slug" value="{{@$category->slug}}">
		</div>
	</div>
	<div class="form-group row">
		
		<div class="col-sm-12">
			<label class="form-control-label">Description: </label>
			<textarea name="description" id="editor" class="form-control " rows="10" cols="80">{{old('description')}}{!! @$category->description !!}</textarea>
		</div>
	</div>
	<div class="form-group row">
		@php 
			$ids = (isset($category->children) && $category->children->count() > 0 ) ? $category->children->pluck('id')->toArray() : null
		@endphp
		<div class="col-sm-12">
			<label class="form-control-label">Select Category: </label>
			<select name="parent_id[]" id="parent_id" class="form-control" multiple>
				@if(isset($categories))
				<option value="0">Top Level</option>
				@foreach($categories as $cat)
				<option value="{{$cat->id}}" @if(!empty($ids) && in_array($cat->id, $ids)) {{'selected'}} @endif>{{$cat->title}}</option>
				@endforeach
				@endif
				option
			</select>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-12">
			@if(isset($category))
			<input type="submit" name="submit" class="btn btn-primary" value="Edit Category" />
			@else
			<input type="submit" name="submit" class="btn btn-primary" value="Add Category" />
			@endif
		</div>
		
	</div>
	
</form>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="./node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
<script type="text/javascript">
$(function(){
	ClassicEditor.create( document.querySelector( '#editor' ), {
		toolbar: [ 'Heading', 'Link', 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote','undo', 'redo' ],
	}).then( editor => {
		console.log( editor );
	}).catch( error => {
		console.error( error );
	});
	$('#txturl').on('keyup', function(){
		var url = slugify($(this).val());
		$('#url').html(url);
		$('#slug').val(url);
	})
	$('#parent_id').select2({
		placeholder: "Select a Parent Category",
		allowClear: true,
		minimumResultsForSearch: Infinity
	});
})
</script>
@endsection