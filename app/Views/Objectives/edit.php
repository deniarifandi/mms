

<div class="card card-frame">
  <div class="card-header p-0 position-relative mt-n2 mx-3 z-index-2">
    <div class="bg-gradient-dark shadow-dark border-radius-lg">
      <h6 class="text-white text-capitalize ps-3 m-0 p-2">Edit Objective</h6>
    </div>
  </div>
  <div class="card-body">
    <div class="px-4 py-1">

      <?php if (session()->getFlashdata('error')): ?>
        
        <div class="alert alert-primary text-white px-2 py-1 mb-4" role="alert">
           <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>
      
      
      <form action="<?= base_url() ?>/objectives/update/<?= $data['objective_id'] ?>" method="post">
        <div class="row">
          <div class="col-md-12">
            <div class="input-group input-group-outline my-3 is-filled" id="objective_name">
              <label class="form-label">Objective's Description</label>
              <input type="text" name="objective_description" class="form-control" value="<?= $data['objective_description'] ?>" required>

            </div>
              <button class="btn btn-success float-end" type="submit">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
