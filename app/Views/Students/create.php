

<div class="card card-frame">
  <div class="card-header p-0 position-relative mt-n2 mx-3 z-index-2">
    <div class="bg-gradient-dark shadow-dark border-radius-lg">
      <h6 class="text-white text-capitalize ps-3 m-0 p-2">Add Student</h6>
    </div>
  </div>
  <div class="card-body">
    <div class="p-4">
      <form  action="store" method="post">
        <div class="input-group input-group-dynamic mb-4" id="student_name">
          <label class="form-label">Student's Name</label>
          <input type="text" name="student_name" class="form-control" value="<?= old('student_name') ?>" required>

        </div>
        <div class="input-group input-group-dynamic mb-4">
          <label class="form-label">Student's E-mail</label>
          <input type="text" name="email" class="form-control" value="<?= old('email') ?>" required>
        </div>
          <button class="btn btn-success float-end" type="submit">Save</button>
      </form>
    </div>
  </div>
</div>



<?php if (session('validation')): ?>
    <script>
        // Create an array of fields with errors from PHP
        const errors = <?= json_encode(session('validation')->getErrors()) ?>;

        // Function to highlight fields with errors
        function highlightErrors(errors) {
            for (const field in errors) {
                console.log(field);
                const input = document.getElementById(field);
            

                if (input) {
                    const filled = document.getElementById(field);
                    filled.classList.add('is-invalid');
                    filled.classList.add('is-filled');
                    // Add the red border to the input field
                    // Display the error message beneath the field
                    // errorDiv.innerText = errors[field];
                    
                    //adding is filled
                    // const filled = document.getElementById(field);
                    // filled.classList.add('is-filled');
                }
            }
        }

        // Highlight the fields with errors
        highlightErrors(errors);
    </script>
<?php endif; ?>