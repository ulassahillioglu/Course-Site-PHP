<?php
require "libs/variables.php";
require "libs/functions.php";
?>

<?php include 'partials/_header.php' ?>
<?php include 'partials/_navbar.php' ?>

<div class="container my-3">
    <div class="row">
        <div class="col-6">
            <h3>Contact Us</h3>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Username">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Email">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <input class="form-control" type="text" name="subject" id="subject" placeholder="Subject">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <textarea class="form-control" name="message" id="message" placeholder="Message"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="float: right;">Send Message</button>
        </div>
        <div class="col-4 ">
            <div class="card my-3">
                <div class="card-body comp-info">
                    <h5 class="card-title">Company Information</h5>
                    <p class="card-text">
                        <i class="fas fa-building mb-3"></i> <strong>Company Name:</strong> Acme Corporation<br>
                        <i class="fas fa-map-marker-alt mb-3"></i> <strong>Address:</strong> 1234 Elm Street, Suite 567<br>
                        <i class="fas fa-city mb-3"></i> <strong>City:</strong> Springfield<br>
                        <i class="fas fa-map mb-3"></i> <strong>State:</strong> IL<br>
                        <i class="fas fa-mail-bulk mb-3"></i> <strong>Zip Code:</strong> 62704<br>
                        <i class="fas fa-phone-alt mb-3"></i> <strong>Phone:</strong> (555) 123-4567<br>
                        <i class="fas fa-envelope"></i> <strong>Email:</strong> info@acme.com
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include 'partials/_footer.php' ?>