

<div class="card card-frame">
  <div class="card-header p-0 position-relative mt-n2 mx-3 z-index-2">
    <div class="bg-gradient-dark shadow-dark border-radius-lg">
      <h6 class="text-white text-capitalize ps-3 m-0 p-2">Edit Subject</h6>
    </div>
  </div>
  <div class="card-body">
    <div class="px-4 py-1">

      <?php if (session()->getFlashdata('error')): ?>
        
        <div class="alert alert-primary text-white px-2 py-1 mb-4" role="alert">
           <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>
      
      
      <form action="<?= base_url() ?>subjects/update/<?= $data['subject_id'] ?>" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-12">
            <div class="input-group input-group-outline my-3 is-filled" id="subject_name">
              <label class="form-label">Subject's Name</label>
              <input type="text" name="subject_name" class="form-control" value="<?= $data['subject_name'] ?>" required>
            </div>
            <div class="input-group input-group-outline my-3 is-filled" id="description">
              <label class="form-label">Subject's Description</label>
              <input type="text" name="description" class="form-control" value="<?= $data['description'] ?>" required>
            </div>

             <label class="form-label text-dark">3. Subject's Image <sup>*(png,jpg,jpeg / 1MB Max)</sup></label>
            <div class="input-group input-group-static" id="file">
               <input type="file" name="file" id="file">
               <!-- Display the current file name if it exists -->
               <?php if (!empty($data['image'])): ?>
                <p>Current file: <strong><?= $data['image'] ?></strong></p>
                <input type="hidden" name="currentFile" value="<?= $data['image']?>" readonly>
                <a class="btn btn-sm btn-success" target="_blank" href="<?php echo base_url().'subjects/view/'.$data['image'] ?>">Download</a>
              <?php endif; ?>
            </div>


              <button class="btn btn-success float-end" type="submit">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
