

<div class="card card-frame">
  <div class="card-header p-0 position-relative mt-n2 mx-3 z-index-2">
    <div class="bg-gradient-dark shadow-dark border-radius-lg">
      <h6 class="text-white text-capitalize ps-3 m-0 p-2">Edit Microcredential</h6>
    </div>
  </div>
  <div class="card-body">
    <div class="px-4 py-1">

      <?php if (session()->getFlashdata('error')): ?>
        
        <div class="alert alert-primary text-white px-2 py-1 mb-4" role="alert">
           <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>
      
      
      <form action="<?= base_url() ?>/microcredentials/update/<?= $data['microcredential_id'] ?>" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-12">
            <div class="input-group input-group-outline my-3 is-filled" id="microcredential">
              <label class="form-label">Question</label>
              <input type="text" name="microcredential" class="form-control" value="<?= $data['microcredential'] ?>" required>

            </div>
            <label class="form-label text-dark">Answer</label>
            <div class="input-group input-group-static mb-4 is-filled" id="description">
              
            <input type="text" name="description" class="form-control" value="<?= $data['description'] ?>" required>
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