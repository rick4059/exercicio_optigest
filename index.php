<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício Optigest</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <?php
        session_start();
        if(isset($_SESSION['error'])){
            echo "<div class='alert alert-danger' role='alert'>".$_SESSION['error']."</div>";
            unset($_SESSION['error']);
        }

        if(isset($_SESSION['success'])){
            echo "<div class='alert alert-success' role='alert'>".$_SESSION['success']."</div>";
            unset($_SESSION['success']);
        }
        ?>


        <div class="card">
            <div class="card-header">
                New Employeer
            </div>
            <div class="card-body">
                <form class="row g-3 needs-validation" method="POST" action="controllers/Employeer/store.php" novalidate>
                    <div class="col-md-10">
                        <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" minlength="3" required>
                        <div class="invalid-feedback">
                            Please provide a valid name.
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="age" class="form-label">Age<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="age" min="0" max="120" required>
                        <div class="invalid-feedback">
                            Please provide a valid age.
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="job" class="form-label">Job<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="job" placeholder="Software Developer" required>
                        <div class="invalid-feedback">
                            Please provide a job.
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="salary" class="form-label">Salary</label>
                        <input type="number" name="salary" class="form-control" min="0">
                    </div>
                    <div class="col-md-4">
                        <label for="admission_date" class="form-label">Admission Date<span class="text-danger">*</span></label>
                        <input type="date" name="admission_date" class="form-control" required>
                        <div class="invalid-feedback">
                            Please provide an admission date.
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    // Bootstrap validation
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
    </script>
</body>
</html>

