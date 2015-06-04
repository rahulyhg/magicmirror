<!--
	This is the sample Checkout Page php script. It can be directly used for integration with CCAvenue if your application is developed in PHP. You need to simply change the variables to match your variables as well as insert routines (if any) for handling a successful or unsuccessful transaction.
-->


<html>
<head>
<title> Checkout</title>
</head>
<body>
<center>
<?php include('adler32.php')?>
<?php include('Aes.php')?>
<?php 

//error_reporting(0);
//$limited = json_decode(file_get_contents('php://input'), true);
//
//Array
//(
//    [form] => Array
//        (
//            [shipdifferent] => 2
//            [shippingcost] => 5
//            [firstname] => jagruti
//            [lastname] => patil
//            [company] => wohlig
//            [email] => jagruti@wohlig.com
//            [billingaddress] => varadvinayak soc
//            [billingcity] => thakurli
//            [billingstate] => maharashtra
//            [billingpincode] => 421201
//            [billingcountry] => India
//            [shippingmethod] => 5
//            [phone] => 9819222221
//            [cart] => Array
//                (
//                )
//
//            [orderid] => 3
//            [amount] => 5
//            [shippingname] => chhaya
//            [shippingtel] => 9878654367
//            [shippingaddress] => siddhivinayak soc
//            [shippingcity] => thane
//            [shippingstate] => maharashtra
//            [shippingpincode] => 432312
//            [shippingcountry] => India
//            [customernote] => hey my note
//        )
//
//)

$order_id=$_POST['orderid'];  

$merchant_id="M_magicwmn_11883";  // Merchant id(also User_Id) 

$amount=$_POST['amount'];            // your script should substitute the amount here in the quotes provided here
//$order_id=$_POST['Order_Id'];        //your script should substitute the order description here in the quotes provided here
//$order_id=$orderid;        //your script should substitute the order description here in the quotes provided here
$url="http://magicmirror.in/#/home";         //your redirect URL where your customer will be redirected after authorisation from CCAvenue
$billing_cust_name=$_POST['firstname']." ".$_POST['lastname'];
$billing_cust_address=$_POST["billingaddress"];
$billing_cust_country=$_POST["billingcountry"];
$billing_cust_state=$_POST["billingstate"];
$billing_city=$_POST["billingcity"];
$billing_zip=$_POST["billingpincode"];
$billing_cust_tel=$_POST["phone"];
$billing_cust_email=$_POST["email"];
$delivery_cust_name=$_POST["shippingname"];
$delivery_cust_address=$_POST["shippingaddress"];
$delivery_cust_country=$_POST["shippingcountry"];
$delivery_cust_state=$_POST["shippingstate"];
$delivery_city=$_POST["shippingstate"];
$delivery_zip=$_POST["shippingpincode"];
$delivery_cust_tel=$_POST["shippingtel"];
$delivery_cust_notes=$_POST["customernote"];


$working_key='ptljk2r1lxqc8k8gbf';	//Put in the 32 bit alphanumeric key in the quotes provided here.


$checksum=getchecksum($merchant_id,$amount,$order_id,$url,$working_key); // Method to generate checksum

$merchant_data= 'Merchant_Id='.$merchant_id.'&Amount='.$amount.'&Order_Id='.$order_id.'&Redirect_Url='.$url.'&billing_cust_name='.$billing_cust_name.'&billing_cust_address='.$billing_cust_address.'&billing_cust_country='.$billing_cust_country.'&billing_cust_state='.$billing_cust_state.'&billing_cust_city='.$billing_city.'&billing_zip_code='.$billing_zip.'&billing_cust_tel='.$billing_cust_tel.'&billing_cust_email='.$billing_cust_email.'&delivery_cust_name='.$delivery_cust_name.'&delivery_cust_address='.$delivery_cust_address.'&delivery_cust_country='.$delivery_cust_country.'&delivery_cust_state='.$delivery_cust_state.'&delivery_cust_city='.$delivery_city.'&delivery_zip_code='.$delivery_zip.'&delivery_cust_tel='.$delivery_cust_tel.'&billing_cust_notes='.$delivery_cust_notes.'&Checksum='.$checksum  ;

$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

?>

<form method="post" name="redirect" action="http://www.ccavenue.com/shopzone/cc_details.jsp"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=Merchant_Id value=$merchant_id>";

?>
</form>

</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>
