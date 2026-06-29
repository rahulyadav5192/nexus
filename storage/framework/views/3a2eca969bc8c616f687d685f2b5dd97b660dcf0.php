<?php
  $bulletPointsText = old('bullet_points', isset($data) && is_array($data->bullet_points) ? implode("\n", $data->bullet_points) : '');
  $highlightsText = '';
  if (old('highlights')) {
      $highlightsText = old('highlights');
  } elseif (isset($data) && is_array($data->highlights)) {
      $highlightsText = collect($data->highlights)->map(function ($item) {
          return ($item['value'] ?? '') . '|' . ($item['suffix'] ?? '') . '|' . ($item['label'] ?? '');
      })->implode("\n");
  }
?>

<div class="col-xs-12 col-sm-12 col-md-6">
  <div class="form-group">
    <strong>Title:</strong>
    <?php echo Form::text('name', null, ['placeholder' => 'e.g. Gold Sourcing', 'class' => 'form-control', 'required']); ?>

  </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-6">
  <div class="form-group">
    <strong>Category Tag:</strong>
    <?php echo Form::text('category_tag', null, ['placeholder' => 'Label shown on image', 'class' => 'form-control', 'required']); ?>

  </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-6">
  <div class="form-group">
    <strong>Category Slug:</strong>
    <?php echo Form::text('category_slug', null, ['placeholder' => 'e.g. sourcing', 'class' => 'form-control', 'required']); ?>

    <small class="text-muted">Used for filtering (data-cat attribute).</small>
  </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-6">
  <div class="form-group">
    <strong>Reveal Animation:</strong>
    <?php echo Form::select('reveal_delay', ['' => 'Default', 'd1' => 'Delay 1', 'd2' => 'Delay 2'], null, ['class' => 'form-control']); ?>

  </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Image:</strong>
    <br />
    <input type="file" name="service_image" <?php if(!isset($data)): ?> <?php endif; ?>>
    <?php if($errors->has('service_image')): ?>
    <span class="invalid-feedback d-block" role="alert">
      <strong><?php echo e($errors->first('service_image')); ?></strong>
    </span>
    <?php endif; ?>
    <?php if(isset($data) && $data->image): ?>
    <div class="mt-2">
      <img src="<?php echo e($data->image_url); ?>" width="200" alt="<?php echo e($data->image_alt ?? $data->name); ?>">
    </div>
    <?php endif; ?>
  </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Or Image Path / URL:</strong>
    <?php echo Form::text('image_path', old('image_path', isset($data) ? $data->image : null), ['placeholder' => 'nexus/images/example.webp or https://...', 'class' => 'form-control']); ?>

    <small class="text-muted">Use when not uploading a file. Supports nexus asset paths or external URLs.</small>
  </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Image Alt Text:</strong>
    <?php echo Form::text('image_alt', null, ['placeholder' => 'Image description for accessibility', 'class' => 'form-control']); ?>

  </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Description:</strong>
    <?php echo Form::textarea('short_description', null, ['placeholder' => 'Main paragraph shown on the operations card', 'class' => 'form-control', 'rows' => 4, 'required']); ?>

  </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Bullet Points:</strong>
    <textarea name="bullet_points" class="form-control" rows="5" placeholder="One item per line"><?php echo e($bulletPointsText); ?></textarea>
    <small class="text-muted">Shown as a list. Leave empty if using highlights instead.</small>
  </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Highlights:</strong>
    <textarea name="highlights" class="form-control" rows="4" placeholder="value|suffix|label"><?php echo e($highlightsText); ?></textarea>
    <small class="text-muted">One per line, e.g. <code>3|kg|Daily chain production</code>. Used instead of bullet points when set.</small>
  </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Extended Description (optional):</strong>
    <?php echo Form::textarea('description', null, ['placeholder' => 'Optional long description', 'class' => 'form-control', 'rows' => 3]); ?>

  </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-6">
  <div class="form-group">
    <?php echo e(Form::label('active', 'Active')); ?>

    <?php echo e(Form::checkbox('active', 1, isset($data) ? (bool) $data->status : true)); ?>

  </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/nexus/resources/views/backend/product_items/_form_fields.blade.php ENDPATH**/ ?>