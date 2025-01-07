

<div class="card card-frame">
  <div class="card-header p-0 position-relative mt-n2 mx-3 z-index-2">
    <div class="bg-gradient-dark shadow-dark border-radius-lg">
      <h6 class="text-white text-capitalize ps-3 m-0 p-2">Add Subject</h6>
    </div>
  </div>
  <div class="card-body">
    <div class="px-4 py-1">

      <?php if (session()->getFlashdata('error')): ?>
        
        <div class="alert alert-primary text-white px-2 py-1 mb-4" role="alert">
           <?= session()->getFlashdata('error') ?>
        </div>
        
      <?php endif; ?>
      
      
      <form action="store" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-12">
            <div class="input-group input-group-outline my-3" id="subject_name">
              <label class="form-label">1. Subject's Title</label>
              <input type="text" name="subject_name" class="form-control" value="<?= old('subject_name') ?>" required>
            </div>
            <div class="input-group input-group-outline my-3" id="description">
              <label class="form-label">2. Subject's Description</label>
              <input type="text" name="description" class="form-control" value="<?= old('description') ?>" required>
            </div>


            <label class="form-label">3. Subject Image <sup>*(jpg,jpeg,png / 1MB Max)</sup></label>
            <div class="input-group input-group-outline" id="file">
              <input type="file" name="file" class="form-control">
            </div>


              <button class="btn btn-success float-end" type="submit">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>