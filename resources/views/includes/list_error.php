<ul class="list-unstyled">
    <?php /** @var array $errors */
      foreach ($errors as $error): ?>
        <?=   view()->renderPartial("includes/field_error",['error'=>$error]); ?>
      <?php endforeach ?>
</ul>
