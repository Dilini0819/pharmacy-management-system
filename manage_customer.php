<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Manage Customer</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/manage_customer.js"></script>
    <script src="js/validateForm.js"></script>
    <script src="js/restrict.js"></script>
  </head>
  <body style="max-height: 100%;">
    <!--max-height: 100% ensures content doesn’t exceed screen height.-->$_COOKIE

    <!-- including side navigations -->
    <?php include("sections/sidenav.html"); ?>



    <!--Bootstrap layout: fluid container for full-width background, and nested fixed-width content.-->
    <div class="container-fluid">
      <div class="container">

        <!-- header section -->
        <?php
          require "php/header.php";
          createHeader('handshake', 'Manage Customer', 'Manage Existing Customer'); //'handshake': the icon 
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row">

          <!--Row with a search label and input.
          When user types, it calls searchCustomer() JavaScript function dynamically.-->
          <div class="col-md-12 form-group form-inline">
            <label class="font-weight-bold" for="">Search :&emsp;</label>
            <input type="text" class="form-control" id="" placeholder="Search Customer" onkeyup="searchCustomer(this.value);">
          </div>

          <!--A horizontal line separating the search box from the table.-->
          <div class="col col-md-12">
            <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #000000ff;">
          </div>

          <div class="col col-md-12 table-responsive">
            <div class="table-responsive">
            	<table class="table table-bordered table-striped table-hover">
            		<thead>
            			<tr>
            				<th style="width: 2%;">SL.</th>
                    <th style="width: 10%;">Customer ID</th>
            				<th style="width: 13%;">Customer Name</th>
                    <th style="width: 13%;">Contact Number</th>
                    <th style="width: 17%;">Address</th>
                    <th style="width: 13%;">Doctor's Name</th>
                    <th style="width: 17%;">Doctor's Address</th>
                    <th style="width: 15%;">Action</th>
            			</tr>
            		</thead>
            		<tbody id="customers_div">
                  <?php
                    require 'php/manage_customer.php';
                    //which fetches and displays customer data inside <tr> rows dynamically.
                    showCustomers(0); 
                  ?>
            		</tbody>
            	</table>
            </div>
          </div>

        </div>
      </div>
    </div>
  </body>
</html>
