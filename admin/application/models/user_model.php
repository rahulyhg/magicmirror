<?php
if ( !defined( 'BASEPATH' ) )
	exit( 'No direct script access allowed' );
class User_model extends CI_Model
{
	protected $id,$username ,$password;
	public function validate($username,$password )
	{
		
		$password=md5($password);
		$query ="SELECT `id`,`firstname`,`lastname`,`name`,`email`,`accesslevel` FROM `user` WHERE `email` LIKE '$username' AND `password` LIKE '$password' ";
		$row =$this->db->query( $query );
		if ( $row->num_rows() > 0 ) {
			$row=$row->row();
			$this->id       = $row->id;
			$this->name = $row->name;
			$this->email = $row->email;
			$this->firstname = $row->firstname;
			$this->lastname = $row->lastname;
			$newdata        = array(
				'id' => $this->id,
				'email' => $this->email,
				'name' => $this->name ,
				'firstname' => $this->firstname ,
				'lastname' => $this->lastname ,
				'accesslevel' => $row->accesslevel ,
				'logged_in' => 'true',
			);
			$this->session->set_userdata( $newdata );
			return true;
		} //count( $row_array ) == 1
		else
			return false;
	}
	
	public function create($name,$firstname,$lastname,$password,$accesslevel,$email,$phone,$status,$billingaddress,$billingcity,$billingstate,$billingcountry,$shippingaddress,$shippingcity,$shippingstate,$shippingcountry,$currency,$companyname,$companyregistrationno,$vatnumber,$country)
	{ 
		$data  = array(
            'companyname'=>$companyname,
            'companyregistrationno'=>$companyregistrationno,
            'vatnumber'=>$vatnumber,
            'country'=>$country,
			'password' =>md5($password),
			'name' => $name,
			'firstname' => $firstname,
			'lastname' => $lastname,
			'accesslevel' => $accesslevel,
			'email' => $email,
			'phone' => $phone,
			'status' =>$status,
			'billingaddress' => $billingaddress,
			'billingcity' => $billingcity,
			'billingstate' => $billingstate,
			'billingcountry' => $billingcountry,
			'shippingaddress' => $shippingaddress,
			'shippingcity' => $shippingcity,
			'shippingstate' => $shippingstate,
			'shippingcountry' => $shippingcountry,
			'currency' => $currency,
		);
		
		$query=$this->db->insert( 'user', $data );
		$id=$this->db->insert_id();
		if($query)
		{
			$user = $this->session->userdata('id');
			$this->saveuserlog($id,'User Created',$user);
			
		}
		if(!$query)
			return  0;
		else
			return  1;
	}
	function viewusers()
	{
		$query="SELECT `user`.`id` as `id`,`user`.`name` as `name`,`user`.`firstname` as `firstname`,`user`.`lastname` as `lastname`,`user`.`status` as `status`,`accesslevel`.`name` as `accesslevel`,`user`.`companyname`,`user`.`country`,`country`.`name` as `countryname` FROM `user`
		LEFT JOIN `accesslevel` ON `user`.`accesslevel` = `accesslevel`.`id` 
		LEFT JOIN `country` ON `user`.`country` = `country`.`id` 
		ORDER BY `user`.`id` ASC";
	   
		$query=$this->db->query($query)->result();
		return $query;
	}
	public function beforeedit( $id )
	{
		$this->db->where( 'id', $id );
		$query=$this->db->get( 'user' )->row();
		return $query;
	}
	
	public function edit($id,$name,$firstname,$lastname,$password,$accesslevel,$email,$phone,$status,$billingaddress,$billingcity,$billingstate,$billingcountry,$shippingaddress,$shippingcity,$shippingstate,$shippingcountry,$currency,$companyname,$companyregistrationno,$vatnumber,$country)
	{
		$data  = array(
            'companyname'=>$companyname,
            'companyregistrationno'=>$companyregistrationno,
            'vatnumber'=>$vatnumber,
            'country'=>$country,
			'name' => $name,
			'firstname' => $firstname,
			'lastname' => $lastname,
			'accesslevel' => $accesslevel,
			'email' => $email,
			'phone' => $phone,
			'status' =>$status,
			/*'billingaddress' => $billingaddress,
			'billingcity' => $billingcity,
			'billingstate' => $billingstate,
			'billingcountry' => $billingcountry,
			'shippingaddress' => $shippingaddress,
			'shippingcity' => $shippingcity,
			'shippingstate' => $shippingstate,
			'shippingcountry' => $shippingcountry,*/
			'currency' => $currency,
		);
		if($password != "")
			$data['password']=md5($password);
		$this->db->where( 'id', $id );
		$query=$this->db->update( 'user', $data );
		if($query)
		{
			$user = $this->session->userdata('id');
			$this->saveuserlog($id,'User Details Edited',$user);
			
		}
		return 1;
	}
	function deleteuser($id)
	{
		$query=$this->db->query("DELETE FROM `user` WHERE `id`='$id'");
	}
	function changepassword($id,$password)
	{
		$data  = array(
			'password' =>md5($password),
		);
		$this->db->where('id',$id);
		$query=$this->db->update( 'user', $data );
		if(!$query)
			return  0;
		else
			return  1;
	}
	public function getaccesslevels()
	{
		$return=array();
		$query=$this->db->query("SELECT * FROM `accesslevel` ORDER BY `id` ASC")->result();
		$accesslevel=$this->session->userdata('accesslevel');
			foreach($query as $row)
			{
				if($accesslevel==1)
				{
					$return[$row->id]=$row->name;
				}
				else if($accesslevel==2)
				{
					if($row->id > $accesslevel)
					{
						$return[$row->id]=$row->name;
					}
				}
				else if($accesslevel==3)
				{
					if($row->id > $accesslevel)
					{
						$return[$row->id]=$row->name;
					}
				}
				else if($accesslevel==4)
				{
					if($row->id == $accesslevel)
					{
						$return[$row->id]=$row->name;
					}
				}
			}
	
		return $return;
	}
	function changestatus($id)
	{
		$query=$this->db->query("SELECT `status` FROM `user` WHERE `id`='$id'")->row();
		$status=$query->status;
		if($status==1)
		{
			$status=0;
		}
		else if($status==0)
		{
			$status=1;
		}
		$data  = array(
			'status' =>$status,
		);
		$this->db->where('id',$id);
		$query=$this->db->update( 'user', $data );
		if(!$query)
			return  0;
		else
			return  1;
	}
	public function getstatusdropdown()
	{
		$status= array(
			 "1" => "Enabled",
			 "0" => "Disabled",
			);
		return $status;
	}
	public function getcountry()
	{
		$query=$this->db->query("SELECT * FROM `country`  ORDER BY `name` ASC")->result();
		$return=array(
		"" => ""
		);
		foreach($query as $row)
		{
            $return[$row->name]=$row->name;
		}
		
		return $return;
	}
	function editaddress($id,$billingaddress,$billingcity,$billingstate,$billingcountry,$shippingaddress,$shippingcity,$shippingstate,$shippingcountry,$shippingpincode)
	{
		$data  = array(
			'billingaddress' => $billingaddress,
			'billingcity' => $billingcity,
			'billingstate' => $billingstate,
			'billingcountry' => $billingcountry,
			'shippingaddress' => $shippingaddress,
			'shippingcity' => $shippingcity,
			'shippingstate' => $shippingstate,
			'shippingcountry' => $shippingcountry,
			'shippingpincode' => $shippingpincode,
		);
		
		$this->db->where( 'id', $id );
		$query=$this->db->update( 'user', $data );
		if($query)
		{
			$user = $this->session->userdata('id');
			$this->saveuserlog($id,'User Address Edited',$user);
			
		}
		return 1;
	}
	function addcredits($id,$credits)
	{
		$query=$this->db->query("UPDATE `user` SET `credits`=`credits`+$credits WHERE `id`='$id'");
		if($query)
		{
			$user = $this->session->userdata('id');
			$this->saveuserlog($id,"User Credits Edited, Credits: $credits",$user);
			
		}
		return 1;
	}
	function saveuserlog($id,$action,$fromuser)
	{
		$data2  = array(
			'user' => $id,
			'fromuser' => $fromuser,
			'action' => $action,
		);
		$query2=$this->db->insert( 'userlog', $data2 );
	}
    //############################################################Frontend function########################################3
    function registeruser($firstname,$lastname,$email,$password)
    {
    	$newdata=0;
        $password=md5($password);
        //echo $email;
        $query=$this->db->query("SELECT `id` FROM `user` WHERE `email`='$email'");
        if($query->num_rows == 0)
        {
             $this->db->query("INSERT INTO `user`(`firstname`, `lastname`, `email`, `password`) VALUE('$firstname','$lastname','$email','$password')");
            $user=$this->db->insert_id();
            $this->db->query("INSERT INTO `newsletterusers`(`user`, `email`, `status`) VALUES ('$user','$email','0')");
            $newdata = array(
                    'id' => $user,
                    'email' => $email,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'logged_in' => 'true'
            );

            $this->session->set_userdata($newdata);

       
        }
        else
        { $newdata="android";}
        return $newdata;
        
    }
    function registewholesaler($firstname,$lastname,$phone,$email,$password)
    {
        $password=md5($password);
        
        $query=$this->db->query("SELECT `id` FROM `user` WHERE `email`='$email'");
        if($query->num_rows == 0)
        {
             $this->db->query("INSERT INTO `user`(`firstname`, `lastname`, `email`,`phone`, `password`,`accesslevel`) VALUE('$firstname','$lastname','$email','$phone','$password','3')");
            $user=$this->db->insert_id();
            $newdata = array(
                    'id' => $user,
                    'email' => $email,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'logged_in' => 'true'
            );

            $this->session->set_userdata($newdata);

               return $newdata;
        }
        else
         return false;
    }
    function loginuser($email,$password)
    {
        $password=md5($password);
        $query=$this->db->query("SELECT `id` FROM `user` WHERE `email`='$email' AND `password`= '$password'");
        if($query->num_rows > 0)
        {
            $user=$query->row();
            $user=$user->id;
            

            $newdata = array(
                'email'     => $email,
                'logged_in' => 'true',
                'id'=> $user
            );

            $this->session->set_userdata($newdata);
            //print_r($newdata);
            return $newdata;
        }
        else
        return false;
    }
    
    function newsletter($id,$email,$status)
    {
        $query=$this->db->query("SELECT `email` FROM `newsletterusers` WHERE `email`='$email'");
        if($query->num_rows > 0)
        {
            return true;
        }
        else
        {
            $this->db->query("INSERT INTO `newsletterusers`(`user`, `email`, `status`) VALUES ('$id','$email','$status')");
            $newsletter=$this->db->insert_id();
            return $newsletter;
        }
    }
    function usercontact($id,$name,$email,$phone,$comment)
    {
        $this->db->query("INSERT INTO `contact` (`id`, `name`, `email`, `telephone`, `comment`) VALUES ('', '$name', '$email', '$phone', '$comment');");
            $contact=$this->db->insert_id();
            return $contact;
    }
    function authenticate() {
         $is_logged_in = $this->session->userdata( 'logged_in' );
        //print_r($this->session->userdata( 'logged_in' ));
        if ( $is_logged_in !== 'true' || !isset( $is_logged_in ) ) {
            return false;
        } //$is_logged_in !== 'true' || !isset( $is_logged_in )
        else {
		$userid=$this->session->userdata('id');
		$query=$this->db->query("SELECT * FROM `user` WHERE `id`='$userid'")->row();
           // $userid = $this->session->userdata( );
         return $query;
        }
    }
    function searchbyname($search)
    {
           // $query=$this->db->query("SELECT `product`.`id`,`product`.`name`,`product`.`sku`,`product`.`description`,`product`.`url`,`product`.`price`,`product`.`wholesaleprice`, `product`.`firstsaleprice`,`product`.`secondsaleprice`,`product`.`specialpriceto`,`product`.`specialpricefrom`, `productimage`.`image`,`category`.`name` FROM `product` INNER JOIN `productcategory` ON `product`.`id`=`productcategory`.`product` LEFT OUTER JOIN `productimage` ON `productimage`.`product`=`product`.`id` LEFT OUTER JOIN `category` ON `category`.`id`=`productcategory`.`category` WHERE `product`.`name` LIKE '%$search%' OR `product`.`description` LIKE '%$search%' OR `category`.`name` LIKE '%$search%'");
        
            $query=$this->db->query("SELECT `product`.`id`,`product`.`name`,`product`.`sku`,`product`.`description`,`product`.`url`,`product`.`price`,`product`.`wholesaleprice`, `product`.`firstsaleprice`,`product`.`secondsaleprice`,`product`.`specialpriceto`,`product`.`specialpricefrom`,`productimage`.`image` FROM `product` INNER JOIN `productimage` ON `productimage`.`product`=`product`.`id`  WHERE `product`.`name` LIKE '%$search%' OR `product`.`description` LIKE '%$search%' GROUP BY `product`.`id`");
            foreach($query as $p_row)
		{
			$productid = $p_row->id;
			$query5=$this->db->query("SELECT count(`category`) as `isnew`  FROM `productcategory` 
			WHERE  `productcategory`.`category`='31' AND `product`='$productid'
			LIMIT 0,1")->row();
			$p_row->isnew=$query5->isnew;
			
		}
        return $query->result();
    }
    
    
    
    function addtocart($product,$productname,$quantity,$price) {
        //$data=$this->cart->contents();
        
        $data = array(
               'id'      => $product,
               'name'      => $productname,
               'qty'     => $quantity,
               'price'   => $price,
        );
        //array_push($data,$data2);

        $this->cart->insert($data);
    }
    
    function destroycart() {
        $this->cart->destroy();
        $orderid=$this->session->userdata("orderid");
        $this->db->query("UPDATE `order` SET `orderstatus`='2' WHERE `id`='$orderid'");
        return 0;
    }
    
    function exportusercsv()
	{
		$this->load->dbutil();
		$query=$this->db->query("SELECT `user`.`id` as `id`,`user`.`name` as `name`,`user`.`firstname` as `firstname`,`user`.`lastname` as `lastname`,`user`.`status` as `status`,`accesslevel`.`name` as `accesslevel`,`user`.`companyname`,`user`.`country`,`country`.`name` as `countryname` FROM `user`
		LEFT JOIN `accesslevel` ON `user`.`accesslevel` = `accesslevel`.`id` 
		LEFT JOIN `country` ON `user`.`country` = `country`.`id` 
		ORDER BY `user`.`id` ASC");

       $content= $this->dbutil->csv_from_result($query);
        //$data = 'Some file data';

        if ( ! write_file('./csvgenerated/userfile.csv', $content))
        {
             echo 'Unable to write the file';
        }
        else
        {
            redirect(base_url('csvgenerated/userfile.csv'), 'refresh');
             echo 'File written!';
        }
	}
    
}
?>