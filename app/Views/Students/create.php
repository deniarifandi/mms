 <style>
        .error {
            border: 1px solid red;
        }

        .error-message {
            color: red;
            font-size: 0.9em;
        }
    </style>

<h1>Add Student</h1>



 <?php if (session()->getFlashdata('error')): ?>
        <p style="color: red;"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

<form action="store" method="post">
     <?= csrf_field() ?>
    <label for="student_name">Student's Name:</label>

    <input type="text" name="student_name" id="student_name" value="<?= old('student_name') ?>" required>
    <div id="student_name_error" class="error-message"></div>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?= old('email') ?>" required>
    <button type="submit">Save</button>
</form>


<?php if (session('validation')): ?>
    <script>
        // Create an array of fields with errors from PHP
        const errors = <?= json_encode(session('validation')->getErrors()) ?>;

        // Function to highlight fields with errors
        function highlightErrors(errors) {
            for (const field in errors) {
                const input = document.getElementById(field);
                const errorDiv = document.getElementById(`${field}_error`);

                if (input && errorDiv) {
                    // Add the red border to the input field
                    input.classList.add('error');

                    // Display the error message beneath the field
                    errorDiv.innerText = errors[field];
                }
            }
        }

        // Highlight the fields with errors
        highlightErrors(errors);
    </script>
<?php endif; ?>
