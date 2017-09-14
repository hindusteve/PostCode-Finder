<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Postcode Finder</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous"> 
    <!-- above added 09.04.2017 -->

<!--     <link href="css/bootstrap.min.css" rel="stylesheet"> -->

    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>

        html, body {
          height: 100%;
        }

        .container {
          background-image: url("city image.jpg");
          width: 100%;
          height: 100%;
          background-size: cover;
          background-position: center;
          padding-top: 150px;
        }

        .center {
          text-align: center;
        }

        .white {
          color: white;
        }

         .whiteBackground {
          background-color: white;
          padding: 20px;
          border-radius: 20px;
        }

       p {
          padding-top: 30px;
          padding-bottom: 30px;
        }

        button {
          margin-top: 20px;
          margin-bottom: 20px;
        }

/*        .container-alt {
          width: 35%;
          height: 35%;
          position: center;
        }*/

    </style>

  </head>
  <body>
<!--     <h1>Weather Scraper</h1> -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <div class="container">
      <div class="row">
          <div class="col-md-6 col-md-offset-6 center whiteBackground">



                <h1 class="center">Postcode Finder</h1>

                <p class="lead center">Enter any address to find the postcode.</p>

                <form>
                  <div class="form-group">
                    <input type="text" class="form-control" id="address" name="address" placeholder="73 Main St., Springfield, Illinois"/>
<!--                     <div class="input-group-btn">
 -->                      <button id="findMyPostcode" class="btn btn-success btn-lg">
                            Find My Postcode
                          </button>
<!--                     </div>
 -->                  </div>
                </form>

                <div id="success" class="alert alert-success">Success!</div>

                <div id="fail" class="alert alert-danger">Could not find postcode for that address. Please try again.</div>

                <div id="fail2" class="alert alert-danger">Could not connect to server. Please try again.</div>

          </div>
      </div>
<!--       <img src="Background-2.jpg"/>
 --> </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>

<!--         <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> -->
      <!-- above added 09.04.2017 -->


        <script> 

                        // alert("Got here 0");

          $(".alert").hide();

          $("#findMyPostcode").click(function(event) {

            var result = 0;

            $(".alert").hide();

                // alert("working");
            event.preventDefault();
  
                // alert($("#address").val());

            $.ajax({
              type: "GET", 
              url: "https://maps.googleapis.com/maps/api/geocode/xml?address="+encodeURIComponent($('#address').val())+"&key=AIzaSyDWrN5v8ID11q3ZRgRTWCHA2B_KIIaovlg",
              dataType: "xml",
              success: processXML,
              error: error
            });

                // alert($("#address").val());

              function error() {

                  $("#fail2").fadeIn();
              }

              function processXML(xml) {

                // alert("Got here 1");

                // alert($(xml).find("formatted_address").text());

                $(xml).find("address_component").each(function () {

                // alert("Got here 2");


                  if ($(this).find("type").text() == "postal_code") {

                     // alert("Got here 3");

                    $("#success").html("The postcode you need is "+$(this).find('long_name').text()).fadeIn();

                    result = 1;
                     // alert(result);
                    // alert($(this).find("long_name").text());
                  }

                  if ($(this).find("type").text() == "country") {

                    alert($(this).find("long_name").text());
                  }

                //   if ($(this).find("type").text() == "postal_code") {

 
               // alert("Got here 5");

                //     alert($(this).find("long_name").text());
                //   }
                                  // alert("Got here 4");

                });

                if (result==0) {

                   // alert("Got here 4");

                    $(".alert").hide();
                    $("#fail").fadeIn();
              }

            }

          });
        
        </script>



  </body>
</html>