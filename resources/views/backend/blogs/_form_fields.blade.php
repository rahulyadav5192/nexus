@php
  $blogImageUrl = isset($data) ? $data->imageUrl() : null;
@endphp

<div class="col-xs-12 col-sm-12 col-md-6">
  <div class="form-group">
    <strong>URL Slug:</strong>
    {!! Form::text('slug', null, ['placeholder' => 'auto-generated if empty', 'class' => 'form-control']) !!}
    <small class="text-muted">Used in the blog detail URL.</small>
  </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-3">
  <div class="form-group">
    <strong>Meta Label:</strong>
    {!! Form::text('meta_label', null, ['placeholder' => 'e.g. Corporate Announcement', 'class' => 'form-control']) !!}
  </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-3">
  <div class="form-group">
    <strong>Read Time:</strong>
    {!! Form::text('read_time', null, ['placeholder' => 'e.g. 4 min read', 'class' => 'form-control']) !!}
  </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Short Description</strong>
    {!! Form::textarea('short_description', null, ['placeholder' => 'Short Description', 'class' => 'form-control', 'rows' => 4]) !!}
  </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Article Content</strong>
    {!! Form::textarea('content', null, ['placeholder' => 'Full article HTML/content for the detail page', 'class' => 'form-control', 'rows' => 12]) !!}
    <small class="text-muted">Supports HTML. You can also add sections after saving from the blog sections page.</small>
  </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-6">
  <div class="form-group">
    <strong>Thumbnail Image Upload:</strong>
    <input type="file" name="blog_image" {{ isset($data) ? '' : '' }}>
  </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-6">
  <div class="form-group">
    <strong>Or Image URL:</strong>
    {!! Form::url('blog_image_url', null, ['placeholder' => 'https://...', 'class' => 'form-control']) !!}
  </div>
</div>
@if($blogImageUrl)
<div class="col-xs-12 col-sm-12 col-md-12">
  <img src="{{ $blogImageUrl }}" width="270" height="180" style="object-fit:cover" alt="Blog thumbnail preview">
</div>
@endif
<div class="col-xs-12 col-sm-12 col-md-6">
  <div class="form-group">
    {{ Form::label('is_featured', 'Featured Article') }}
    {!! Form::checkbox('is_featured', 1, isset($data) ? $data->is_featured : false) !!}
    <small class="text-muted d-block">Only one featured article is shown at the top of /blogs.</small>
  </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-6">
  <div class="form-group">
    {{ Form::label('active', 'Active') }}
    {!! Form::checkbox('active', 1, isset($data) ? $data->status : true) !!}
  </div>
</div>
