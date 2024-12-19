 <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">

 <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Students table <a href="students/create" class="btn btn-primary btn-sm float-end my-0 me-3">Add Student</a> </h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive px-5">
                <table class="table align-items-center table-striped mb-0" id="studentsTable">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Student Name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($students as $student): ?>
                      <tr>
                      <td><?= $student['student_id'] ?></td>
                      <td><?= $student['student_name'] ?></td>
                      <td><?= $student['email'] ?></td>
                      <td>
                        <a class="btn btn-primary btn-sm mb-0" href="students/edit/<?= $student['student_id'] ?>">Edit</a>
                        <a class="btn btn-danger btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick='modalConfirmation(<?= json_encode($student); ?>)'>Delete</a>
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
        Deleting this student will remove all associated data permanently. Continue?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <form action="student/delete/<?= $student['student_id'] ?>" method="post">
            <!-- <input type="hidden" name="_method" value="delete"> -->
          <button type="submit" id="deleteConfirm"  class="btn bg-gradient-danger">Confirm Delete</button>
        </form>
        
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  new DataTable('#studentsTable');
</script>

<script type="text/javascript">
  
  function modalConfirmation(id){
    const array = Object.entries(id);
    console.log(array);
    document.getElementById('deleteModalLabel').innerText = "Delete Student '"+array[1][1]+"'";
    // document.getElementById('deleteConfirm').href = "student/delete/"+array[0][1];
  }

</script>