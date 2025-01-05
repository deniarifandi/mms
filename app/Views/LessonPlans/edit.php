

<div class="card card-frame">
  <div class="card-header p-0 position-relative mt-n2 mx-3 z-index-2">
    <div class="bg-gradient-dark shadow-dark border-radius-lg">
      <h6 class="text-white text-capitalize ps-3 m-0 p-2">Edit Lesson Plan</h6>
    </div>
  </div>
  <div class="card-body">
    <div class="px-4 py-1">

      <?php if (session()->getFlashdata('error')): ?>
        
        <div class="alert alert-primary text-white px-2 py-1 mb-4" role="alert">
           <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>
      
      
      <form action="<?= base_url() ?>/lesson-plans/update/<?= $data['lessonPlan_id'] ?>" method="post">
        <div class="row">
          <div class="col-md-12">
            <div class="input-group input-group-outline my-3 is-filled" id="lessonPlan_title">
              <label class="form-label">Lesson Plan's Name</label>
              <input type="text" name="lessonPlan_title" class="form-control" value="<?= $data['lessonPlan_title'] ?>" required>
            </div>
           <div class="input-group input-group-static mb-4">
               <label for="exampleFormControlSelect1" class="ms-0">Subject</label>
               <select class="form-control px-2" name="subject_id" id="exampleFormControlSelect1">
                <option value="">-Select Subject-</option>
                <?php foreach ($subjects as $subject): ?>
                   <option value="<?= $subject['subject_id'] ?>"><?= $subject['subject_name'] ?></option>
                <?php endforeach ?>
                
               </select>
             </div>
              <div class="input-group input-group-outline my-3 is-filled" id="description">
              <label class="form-label">Lesson Plan's Description</label>
              <input type="text" name="description" class="form-control" value="<?= $data['description'] ?>" required>
            </div>
              <div class="input-group input-group-outline my-3 is-filled" id="file">
              <label class="form-label">File Lesson Plan</label>
              <input type="text" name="file" class="form-control" value="<?= $data['file'] ?>" required>
            </div>
              <button class="btn btn-success float-end" type="submit">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
