

<div class="card card-frame">
  <div class="card-header p-0 position-relative mt-n2 mx-3 z-index-2">
    <div class="bg-gradient-dark shadow-dark border-radius-lg">
      <h6 class="text-white text-capitalize ps-3 m-0 p-2">Edit Teacher</h6>
    </div>
  </div>
  <div class="card-body">
    <div class="px-4 py-1">

      <?php if (session()->getFlashdata('error')): ?>
        
        <div class="alert alert-primary text-white px-2 py-1 mb-4" role="alert">
           <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>
      
      
      <form action="<?= base_url() ?>/teachers/update/<?= $data['teacher_id'] ?>" method="post">
        <div class="row">
          <div class="col-md-12">
            <div class="input-group input-group-outline my-3 is-filled" id="teacher_name">
              <label class="form-label">Teacher's Name</label>
              <input type="text" name="teacher_name" class="form-control" value="<?= $data['teacher_name'] ?>" required>

            </div>
            <div class="input-group input-group-outline my-3 is-filled" id="email">
              <label class="form-label">Teacher's E-mail</label>
              <input type="text" name="email" class="form-control" value="<?= $data['email'] ?>" required>
            </div>

              <button class="btn btn-success float-end" type="submit">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
