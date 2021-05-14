<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Contact</title>
  </head>
  <body>
   
  <?php include 'partials/_dbconnect.php'?>
  <?php include 'partials/_header.php'?>

        <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact ">
      <div class="container-fluid my-4">

        <div class="section-title text-center" style="color:red">
          <h2>Contact me...</h2>
        </div>

        <div class="row my-5" data-aos="fade-in">

          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="icofont-google-map"></i>
                <h4>Location:</h4>
                <p>Sunder Nagar, Raipur, Chhattisgarh, 492001</p>
              </div>
            </div>
          </div>  

          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="info">
              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>Email:</h4>
                <p>Sumeet0604.sv@gmail.com</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 d-flex align-items-stretch my-3">
            <div class="info">
              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Call:</h4>
                <p>+91 8462805060, +91 7999001618</p>
              </div>
            </div>
          </div>
          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d378.3169442226107!2d81.60399358467363!3d21.231575433681897!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2sin!4v1616837461635!5m2!1sen!2sin"
               width="250" height="250" style="padding-left: 300px padding-right:300px;" allowfullscreen="" loading="lazy"></iframe>
      </div>
        </div>
    </section>
    <!-- End Contact Section -->

   <?php include 'partials/_footer.php' ?>
    
  </body> 
  </html>