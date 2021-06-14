<?php include('../page/template/header.php'); ?>
<?php
echo '<div class="error-page h-100">
        <h2 class="headline text-dark"> 404</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-dark"></i> Oops! La route spécifiée '."'$route'".' n\'existe pas !.</h3>

          <p>
La page que vous cherchez n\'existe pas.
            En attendant, vous pouvez <a href="" onclick="javascript:window.history.back(-1);return false;">retournez en arrière</a>.
          </p>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>';

?>

<?php include ('../page/template/footer.php'); ?>
