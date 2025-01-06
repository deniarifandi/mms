

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
   
   
   <form action="<?= base_url() ?>lesson-plans/update/<?= $data['lessonPlan_id'] ?>" method="post"  enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-12">
       <label class="form-label text-dark">1. Lesson Plan's Name</label>
       <div class="input-group input-group-static mb-4 is-filled" id="lessonPlan_title">
        <input type="text" name="lessonPlan_title" class="form-control" value="<?= $data['lessonPlan_title'] ?>" required>
      </div>
      <label for="exampleFormControlSelect1" class="ms-0 text-dark">2. Subject</label>
      <div class="input-group input-group-static mb-4 is-filled">
        
       <select class="form-control px-2" name="subject_id" id="exampleFormControlSelect1">
        <option value="">-Select Subject-</option>
        <?php foreach ($subjects as $subject): ?>
         <option value="<?= $subject['subject_id'] ?>"><?= $subject['subject_name'] ?></option>
       <?php endforeach ?>
     </select>
   </div>
   <label class="form-label text-dark">3. Lesson Plan's Description</label>
   <div class="input-group input-group-static mb-4 is-filled" id="description">
    
    <input type="text" name="description" class="form-control" value="<?= $data['description'] ?>" required>
  </div>


  <label class="form-label text-dark">4. Lesson Plan's File <sup>*(doc,docx,ppt,pptx,pdf)</sup></label>
  <div class="input-group input-group-static" id="file">
     <input type="file" name="file" id="file">
     <!-- Display the current file name if it exists -->
     <?php if (!empty($data['file'])): ?>
      <p>Current file: <strong><?= $data['file'] ?></strong></p>
      <input type="hidden" name="currentFile" value="<?= $data['file']?>" readonly>
      <a class="btn btn-sm btn-success" href="<?php echo base_url().'lesson-plans/view/'.$data['subject_id'].'/'.$data['file'] ?>">Download</a>
    <?php endif; ?>
  </div>




<button class="btn btn-success float-end" type="submit">Save</button>
</div>
</div>
</form>
</div>
</div>
</div>

<script>
    // Replace 'your_desired_value' with the value you want to select.
    var selectedValue = '<?= $data['subject_id'] ?>'; // Example: '2'

    // Get the select element by its ID
    var selectElement = document.getElementById('exampleFormControlSelect1');

    // Set the selected option based on the value
    selectElement.value = selectedValue;
  </script>