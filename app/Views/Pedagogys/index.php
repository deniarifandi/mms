 <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">

<?php if (session()->getFlashdata('success')): ?>
        
    <div class="alert alert-success text-white px-2 py-1 mb-4" role="alert">
      <?= session()->getFlashdata('success') ?>
    </div>
        
<?php endif; ?>

 <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">EMI Videos table <a href="pedagogys/create" class="btn btn-primary btn-sm float-end my-0 me-3">Add Videos</a> </h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive px-5">
                <table class="table align-items-center table-striped mb-0" id="pedagogysTable">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pedagogy Name</th>
                      <th>File</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($pedagogys as $pedagogy): ?>
                      <tr>
                      <td><?= $pedagogy['pedagogy_id'] ?></td>
                      <td><?= $pedagogy['pedagogy'] ?></td>
                      <td>
                        <?php if (!empty($pedagogy['file'])): ?>
                         <a class="btn btn-sm btn-success mb-0" href="<?php echo base_url().'streaming?video='.$pedagogy['file'] ?>">View</a>
                        <?php else: ?> 
                           <a class="btn btn-sm btn-secondary mb-0" style="pointer-events: none;">No File</a>
                        <?php endif; ?>
                      </td>
                      <td>
                        <a class="btn btn-primary btn-sm mb-0" href="pedagogys/edit/<?= $pedagogy['pedagogy_id'] ?>">Edit</a>
                        <a class="btn btn-danger btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick='modalConfirmation(<?= json_encode($pedagogy); ?>)'>Delete</a>
                      </td>
                      
                    </tr>  
                    <?php endforeach ?>
                    
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>


<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-normal" id="deleteModalLabel"></h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Deleting this pedagogy will remove all associated data permanently. Continue?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        
        <form action="/pedagogys/delete/1" method="POST" id="formDelete">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-danger">Confirm Delete</button>
        </form>
        
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  new DataTable('#pedagogysTable', {
      order: [[0, 'desc']]
  });
</script>

<script type="text/javascript">
  
  function modalConfirmation(id){
    const array = Object.entries(id);
    console.log(array);
    document.getElementById('deleteModalLabel').innerText = "Delete Pedagogy '"+array[1][1]+"'";
    document.getElementById('formDelete').action = "pedagogys/delete/"+array[0][1];
  }

</script>