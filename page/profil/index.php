<?php include('../page/template/header.php'); ?>


    <section class="content">
                  <!-- /.tab-pane -->
        <form method="post" action=".?route=profil&action=edit">
                  <div class="tab-pane m-4" id="settings">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nom</label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" id="inputName" name="lastName" value="<?= $user->getLastname() ?>" " <?= $read ?>>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Prénom</label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" name="firstName" value="<?= $user->getFirstname(); ?>" <?= $read ?>>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-2">
                          <input type="email" class="form-control" name="email" value="<?= $user->getEmail(); ?>" <?= $read ?>>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Rôle</label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" value="<?= $user->getRole()->getLabel(); ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label pe-none">Nombre de tâche</label>
                        <div class="col-sm-1">
                            <div class="btn-dark form-control d-flex justify-content-center"><h5><strong><?= $task ?></strong></h5></div>
                        </div>
                      </div>
                      <div class="d-flex">
                      <button type="submit" class="btn btn-success" style="display: <?= $displaySubmit; ?>" >Valider</button></form>
                            <form method="post" action=".?route=profil&action=modif"><button type="submit" class="btn btn-primary" style="display: <?= $displayModif; ?>">Modifier</button></form>
                            <button class="btn btn-warning ml-1" onclick="javascript:window.history.back(-1);return false;" style="display: <?= $displaySubmit; ?>">Retour</button>
                        </div>
                      </div>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

<?php include ('../page/template/footer.php'); ?>