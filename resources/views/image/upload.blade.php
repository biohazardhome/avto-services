
<form id="form-image-upload" action="/image/upload/" method="POST" enctype="multipart/form-data">
	{{-- {{ csrf_field() }} --}}
	<input type="hidden" name="folder" value="{{ !empty($folder) ? $folder : '' }}"></input>
	<input type="hidden" name="imageable_type" value="{{ !empty($imageable_type) ? $imageable_type : '' }}"></input>
	<input type="hidden" name="imageable_id" value="{{ !empty($imageable_id) ? $imageable_id : '' }}"></input>
	@include('image.button', ['required' => true])
	<input type="text" name="filename" value="{{ !empty($filename) ? $filename : '' }}">
	<input type="text" name="alt" value="">
	<input type="text" name="title" value="">
	<button type="submit">Upload</button>
</form>
<div class="images-preview"></div>

