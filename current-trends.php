<!doctype html>
<html class="no-js" lang="en">
<head>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <!-- 1. --> <link rel="stylesheet" href="http://printer.exciting.io/stylesheets/print.css" type="text/css" media="screen" title="no title" charset="utf-8">
  <!-- 2. --> <script src="http://printer.exciting.io/javascripts/printer.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript" charset="utf-8">
  $(function() {
    $("#previewPage").click(Printer.previewPage);
    $("#printPage").click(function() {
      var printerID = prompt("Enter the ID of the printer to target");
      Printer.printPage(printerID, function(result) {
        if (result.response == "ok") {
          alert("Page successfully sent for printing");
        } else {
          alert("There was a problem sending this content");
          console.log("Error response", result);
        }
      });
    });
  })
  </script>
</head>
<style media="screen" type="text/css">
.header img {
  float: left;
  width: 50px;
  height: 50px;
}

.header h1 {
  position: relative;
  top: 5px;
  font-size: 50px;   }
  </style>

  <body class="preview"> <!-- 3. -->
    <div class="controls">
      <a id="previewPage" href="#">Preview</a>
      <a id="printPage" href="#">Print</a>
    </div>
    <div class="paper"> <!-- 4. -->
      <div class="content">
        <div class="header">
          <img src="image/twitter-512.jpg">
          <h1>#trend</h1>
        </div>
        <p>Latest 10 Trending topics 
          <?php

// IDs to where we want trends from: (doing this here to print the location)
// http://woeid.rosselliot.co.nz/
          $worldwide 	= 	"?id=1";
          $bristol	=	"?id=13963";
          $england	=	"?id=24554868";
          $scotland	=	"?id=12578048";
          $uk			=	"?id=23424975";


//Set the location
          $getfield = $uk;

//echo '<p>';

          if($getfield == $worldwide){
            echo "Worldwide";
          }
          else if($getfield ==$eu){
            echo "Europe";
          }
          else if($getfield == $eu){
            echo "Europe";
          }
          else if($getfield == $uk){
            echo "United Kingdom";
          }
          else if($getfield == $scotland){
            echo "Scotland";
          }
          else if($getfield == $england){
            echo "England";
          }
          else if($getfield == $bristol){
            echo "Bristol";
          }

          else {
            echo "something may be broken";
          }

          echo '</p>';

// Setting our Authentication Variables that we got after creating an application
          $settings = array(
            'oauth_access_token' => "",
            'oauth_access_token_secret' => "",
            'consumer_key' => "",
            'consumer_secret' => ""
            );

// We are using GET Method to Fetch the trends by place.
          $url = 'https://api.twitter.com/1.1/trends/place.json';

          $requestMethod = 'GET';

// https://wordpress.org/plugins/twitter/
// Making an object to access our library class
          $twitter = new TwitterAPIExchange($settings);
          $store = $twitter->setGetfield($getfield)
          ->buildOauth($url, $requestMethod)
          ->performRequest();
// Since the returned result is in json format, we need to decode it             
          $result = json_decode($store);

// After decoding, we have an standard object array, so we can print each tweet into a list item.
          $multi_array = objectToArray($result);
          foreach($multi_array[0]['trends'] as $key => $value ){

// printing each tweet wrapped in a <li> tag
            echo '<h3>'.$value['name'].'</h3>';

          }
          echo '</p>'; 

          ?>


        </div>
      </div>
    </body>
    </html>