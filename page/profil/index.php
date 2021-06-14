<?php include('../page/template/header.php'); ?>
<?php

echo '<section class="content">
                  <!-- /.tab-pane -->

                  <div class="tab-pane m-4" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nom</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" placeholder="'.$user->getLastname().'" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Prénom</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" placeholder="'.$user->getFirstname().'" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" placeholder="'.$user->getEmail().'" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Rôle</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" placeholder="'.$user->getRole()->getLabel().'" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label pe-none">Nombre de tâche</label>
                        <div class="col-sm-1">
                            <div class="btn-dark form-control d-flex justify-content-center"><h5><strong>'.$task[0]->getTasks().'</strong></h5></div>
                        </div>
                      </div>
                      </div>
                    </form>
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
    </section>';
?>

<?php include ('../page/template/footer.php'); ?>