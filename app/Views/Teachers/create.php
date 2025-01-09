

<div class="card card-frame">
  <div class="card-header p-0 position-relative mt-n2 mx-3 z-index-2">
    <div class="bg-gradient-dark shadow-dark border-radius-lg">
      <h6 class="text-white text-capitalize ps-3 m-0 p-2">Add Teacher</h6>
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
            <label class="form-label">Teacher's Name</label>
            <div class="input-group input-group-static mb-3 is-filled" id="teacher_name">
              
              <input type="text" name="teacher_name" class="form-control" value="<?= old('teacher_name') ?>" required>

            </div>
            <label class="form-label">Teacher's E-mail</label>
            <div class="input-group input-group-static mb-3 is-filled">
        
                <input type="text" name="email" class="form-control" value="" autocomplete="off" required id="email">  
              
            </div>
            <label class="form-label">Password</label>
            <div class="input-group input-group-static mb-3" id="password">
              <input type="password" name="pass" class="form-control" placeholder="*********" autocomplete="off">
            </div>

              <button class="btn btn-success float-end" type="submit">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  
  document.getElementsById("email").value = "";
</script>
