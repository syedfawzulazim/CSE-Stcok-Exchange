<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>CSE Stock Price</title>
  </head>
  <body>


 <?php  

  $curl = curl_init();

  $url = "https://www.cse.com.bd/market/current_price";

  curl_setopt($curl,CURLOPT_URL,$url);
  curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
  curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);

  $result = curl_exec($curl);
  curl_close($curl);

  $share = array ();

  preg_match_all('!https:\/\/www\.cse\.com\.bd\/company\/companydetails\/(.*?)">!', $result, $match);
  $share = $match[1];
  $number = count($share);


  preg_match_all('!<td style="text-align: center;">(.*?)<\/td>!', $result, $matches);

  $count = 0;

  foreach ($matches as $type) {
    $count+= count($type);
  }


  $numbers = $count/2-1;

  $all = $matches[1];

  $price = array_chunk($all,8);

  $combine = array_combine($share, $price);


?>


    <div class="cointainer">
      <div class="col-sm-6">
         <h2>CSE Stock Exchange</h2>
          <h5>Syed Fawzul Azim</h5>
        <table class="table" align="center">
          <thead class="thead-dark">
            <tr>
              <th scope="col">SL</th>
              <th scope="col">Share</th>
              <th scope="col">LTP</th>
              <th scope="col">OTP</th>
              <th scope="col">High</th>
              <th scope="col">Low</th>
              <th scope="col">YCP</th>
              <th scope="col">Trade</th>
              <th scope="col">Value</th>
              <th scope="col">Volume</th>
            </tr>
          </thead>
          <tbody>


                 <?php $sl=1;?>
                 <?php foreach($combine as $key=>$value){?>
                  <tr>
                    <td><?php echo $sl;?></td>
                    <td><?php echo $key;?></td>
                    <?php foreach($value as $val){?>
                      <td><?php echo $val;?></td>
                    <?php } ?>
                  </tr>
                 <?php $sl=$sl+1; } ?>
            
          </tbody>
        </table>
      </div>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>

