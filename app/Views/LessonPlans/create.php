

<div class="card card-frame">
  <div class="card-header p-0 position-relative mt-n2 mx-3 z-index-2">
    <div class="bg-gradient-dark shadow-dark border-radius-lg">
      <h6 class="text-white text-capitalize ps-3 m-0 p-2">Add Lesson Plan</h6>
    </div>
  </div>
  <div class="card-body">
    <div class="px-4 py-1">

      <?php if (session()->getFlashdata('error')): ?>
        
        <div class="alert alert-primary text-white px-2 py-1 mb-4" role="alert">
           <?= session()->getFlashdata('error') ?>
        </div>
        
      <?php endif; ?>
      
      
      <form action="store" method="post">
        <div class="row">
          <div class="col-md-12">
            <div class="input-group input-group-outline my-3" id="lessonPlan_title">
              <label class="form-label">Lesson Plan's Title</label>
              <input type="text" name="lessonPlan_title" class="form-control" value="<?= old('lessonPlan_title') ?>" required>
            </div>
             <div class="input-group input-group-outline my-3" id="subject_id">
              <label class="form-label">Subject</label>
              <input type="text" name="subject_id" class="form-control" value="<?= old('subject_id') ?>" required>
            </div>
             <div class="input-group input-group-outline my-3" id="description">
              <label class="form-label">Lesson Plan's Description</label>
              <input type="text" name="description" class="form-control" value="<?= old('description') ?>" required>
            </div>
             <div class="input-group input-group-outline my-3" id="file">
              <label class="form-label">Lesson Plan's File</label>
              <input type="text" name="file" class="form-control" value="<?= old('file') ?>" required>
            </div>
              <button class="btn btn-success float-end" type="submit">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>