<?php include "layout/header.php"; ?>





<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mx-auto border shadow p-4">
           <h2 class="text-center mb-4">Register</h2> 
            <hr />


            <form method="post">
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">First Name*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="first_name" value="">
                        <span class="text-danger"></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Last Name*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="last_name" value="">
                        <span class="text-danger"></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Email*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="email" value="">
                        <span class="text-danger"></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Phone*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="phone" value="">
                        <span class="text-danger"></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Address*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="address" value="">
                        <span class="text-danger"></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Password*</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="password" name="password" value="">
                        <span class="text-danger"></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Confirm Password*</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="password" name="confirm_password" value="">
                        <span class="text-danger"></span>
                    </div>
                </div>

                <div class="row mb-3">
                    
                </div>

            </form>
        </div>
    </div>
</div>

<?php include "layout/footer.php"; ?>