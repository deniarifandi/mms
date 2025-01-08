

<div class="card card-frame">
  <div class="card-header p-0 position-relative mt-n2 mx-3 z-index-2">
    <div class="bg-gradient-dark shadow-dark border-radius-lg">
      <h6 class="text-white text-capitalize ps-3 m-0 p-2">Add Microcredential</h6>
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
            <label class="form-label">1. Microcredential's Name</label>
            <div class="input-group input-group-static mb-3" id="microcredential">
              
              <input type="text" name="microcredential" class="form-control" value="<?= old('microcredential') ?>" required>
            </div>
            <div class="input-group input-group-static mb-4">
               <label for="exampleFormControlSelect1" class="ms-0">2. Subject</label>
               <select class="form-control px-2" name="subject_id" id="exampleFormControlSelect1" required>
                <option value="">-Select Subject-</option>
                <?php foreach ($subjects as $subject): ?>
                   <option value="<?= $subject['subject_id'] ?>"><?= $subject['subject_name'] ?></option>
                <?php endforeach ?>
               </select>
             </div>
            
            <label class="form-label">3. Microcredentials's Description</label>
             <div class="input-group input-group-static mb-4" id="description">
              <input type="text" name="description" class="form-control" value="<?= old('description') ?>" required>
            </div>

            <label class="form-label">4. Microcredentials's File <sup>*(doc,docx,ppt,pptx,pdf / 3MB Max)</sup></label>
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