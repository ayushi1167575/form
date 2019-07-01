<?php if(count($errors)>0): ?>
<div class="errors">
    <?php foreach($errors as $value): ?>
    <p><?php echo $value; ?> </p>
    <?php endforeach ?>
</div>
<?php endif ?>
