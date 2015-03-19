<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site extends CI_Controller 
{
	public function __construct( )
	{
		parent::__construct();
		
		$this->is_logged_in();
	}
	function is_logged_in( )
	{
		$is_logged_in = $this->session->userdata( 'logged_in' );
		if ( $is_logged_in !== 'true' || !isset( $is_logged_in ) ) {
			redirect( base_url() . 'index.php/login', 'refresh' );
		} //$is_logged_in !== 'true' || !isset( $is_logged_in )
	}
	function checkaccess($access)
	{
		$accesslevel=$this->session->userdata('accesslevel');
		if(!in_array($accesslevel,$access))
			redirect( base_url() . 'index.php/site?alerterror=You do not have access to this page. ', 'refresh' );
	}
	public function index()
	{
		//$access = array("1","2");
		$access = array("1","2");
		$this->checkaccess($access);
		$data[ 'page' ] = 'dashboard';
		$data[ 'title' ] = 'Welcome';
		$this->load->view( 'template', $data );	
	}
	public function createuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data[ 'country' ] =$this->user_model->getcountry();
		$data[ 'currency' ] =$this->currency_model->getcurrencydropdown();
		$data[ 'page' ] = 'createuser';
		$data[ 'title' ] = 'Create User';
		$this->load->view( 'template', $data );	
	}
	function createusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('name','name','trim');
		$this->form_validation->set_rules('firstname','Firstname','trim|required');
		$this->form_validation->set_rules('lastname','Lastname','trim|required');
		$this->form_validation->set_rules('companyname','Companyname','trim|required');
		$this->form_validation->set_rules('companyregistrationno','Company Registration Number','trim|required');
		$this->form_validation->set_rules('vatnumber','VAT Number','trim|required');
		$this->form_validation->set_rules('country','Country','trim|required');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('phone','Phone','trim');
		$this->form_validation->set_rules('billingaddress','billingaddress','trim');
		$this->form_validation->set_rules('billingcity','billingcity','trim');
		$this->form_validation->set_rules('billingstate','billingstate','trim');
		$this->form_validation->set_rules('billingcountry','billingcountry','trim');
		$this->form_validation->set_rules('shippingaddress','shippingaddress','trim');
		$this->form_validation->set_rules('shippingcity','shippingcity','trim');
		$this->form_validation->set_rules('shippingstate','shippingstate','trim');
		$this->form_validation->set_rules('shippingcountry','shippingcountry','trim');
		$this->form_validation->set_rules('shippingpincode','shippingpincode','trim');
		$this->form_validation->set_rules('currency','currency','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
			$data[ 'country' ] =$this->user_model->getcountry();
			$data[ 'currency' ] =$this->currency_model->getcurrencydropdown();
			$data['page']='createuser';
			$data['title']='Create New User';
			$this->load->view('template',$data);
		}
		else
		{
            $companyname=$this->input->post('companyname');
            $companyregistrationno=$this->input->post('companyregistrationno');
            $vatnumber=$this->input->post('vatnumber');
            $country=$this->input->post('country');
			$password=$this->input->post('password');
			$name=$this->input->post('name');
			$firstname=$this->input->post('firstname');
			$lastname=$this->input->post('lastname');
			$accesslevel=$this->input->post('accesslevel');
			$email=$this->input->post('email');
			$phone=$this->input->post('phone');
			$billingaddress=$this->input->post('billingaddress');
			$billingcity=$this->input->post('billingcity');
			$billingstate=$this->input->post('billingstate');
			$billingcountry=$this->input->post('billingcountry');
			$shippingaddress=$this->input->post('shippingaddress');
			$shippingcity=$this->input->post('shippingcity');
			$shippingstate=$this->input->post('shippingstate');
			$shippingcountry=$this->input->post('shippingcountry');
			$currency=$this->input->post('currency');
			$status=$this->input->post('status');
			if($this->user_model->create($name,$firstname,$lastname,$password,$accesslevel,$email,$phone,$status,$billingaddress,$billingcity,$billingstate,$billingcountry,$shippingaddress,$shippingcity,$shippingstate,$shippingcountry,$currency,$companyname,$companyregistrationno,$vatnumber,$country)==0)
			$data['alerterror']="New user could not be created.";
			else
			$data['alertsuccess']="User created Successfully.";
			
			$data['table']=$this->user_model->viewusers();
			$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
	function viewusers()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->user_model->viewusers();
		$data['page']='viewusers';
		$data['title']='View Users';
		$this->load->view('template',$data);
	}
	function edituser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'country' ] =$this->user_model->getcountry();
		$data[ 'currency' ] =$this->currency_model->getcurrencydropdown();
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['page']='edituser';
		$data['page2']='block/userblock';
		$data['title']='Edit User';
		$this->load->view('template',$data);
	}
	function editusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('password','Password','trim|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|matches[password]');
		$this->form_validation->set_rules('accesslevel','Accesslevel','trim');
		$this->form_validation->set_rules('name','name','trim');
        
        $this->form_validation->set_rules('companyname','Companyname','trim|required');
		$this->form_validation->set_rules('companyregistrationno','Company Registration Number','trim|required');
		$this->form_validation->set_rules('vatnumber','VAT Number','trim|required');
		$this->form_validation->set_rules('country','Country','trim|required');
        
		$this->form_validation->set_rules('dob','Date of birth','trim');
		$this->form_validation->set_rules('email','Email','trim|valid_email');
		$this->form_validation->set_rules('phone','Phone','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
			$data[ 'country' ] =$this->user_model->getcountry();
			$data[ 'currency' ] =$this->currency_model->getcurrencydropdown();
			$data['before']=$this->user_model->beforeedit($this->input->post('id'));
			$data['page']='edituser';
			$data['page2']='block/userblock';
			$data['title']='Edit User';
			$this->load->view('template',$data);
		}
		else
		{
            $companyname=$this->input->post('companyname');
            $companyregistrationno=$this->input->post('companyregistrationno');
            $vatnumber=$this->input->post('vatnumber');
            $country=$this->input->post('country');
			$id=$this->input->post('id');
			$password=$this->input->post('password');
			$name=$this->input->post('name');
			$firstname=$this->input->post('firstname');
			$lastname=$this->input->post('lastname');
			$accesslevel=$this->input->post('accesslevel');
			$email=$this->input->post('email');
			$phone=$this->input->post('phone');
			$billingaddress=$this->input->post('billingaddress');
			$billingcity=$this->input->post('billingcity');
			$billingstate=$this->input->post('billingstate');
			$billingcountry=$this->input->post('billingcountry');
			$shippingaddress=$this->input->post('shippingaddress');
			$shippingcity=$this->input->post('shippingcity');
			$shippingstate=$this->input->post('shippingstate');
			$shippingcountry=$this->input->post('shippingcountry');
			$currency=$this->input->post('currency');
			$status=$this->input->post('status');
			if($this->user_model->edit($id,$name,$firstname,$lastname,$password,$accesslevel,$email,$phone,$status,$billingaddress,$billingcity,$billingstate,$billingcountry,$shippingaddress,$shippingcity,$shippingstate,$shippingcountry,$currency,$companyname,$companyregistrationno,$vatnumber,$country)==0)
			$data['alerterror']="User Editing was unsuccesful";
			else
			$data['alertsuccess']="User edited Successfully.";
			
			$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			
		}
	}
	
	function addcredits()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['page']='addcredits';
		$data['page2']='block/userblock';
		$data['title']='Add Credits';
		$this->load->view('template',$data);
	}
	function deleteall()
	{
		$access = array("1");
		$this->checkaccess($access);
        //print_r($this->input->post('ids'));
		$data['table']=$this->product_model->deleteall($this->input->post('ids'));
		$data['alertsuccess']="products Deleted Successfully";
		$data['page']='viewproduct';
		$data['title']='View product';
		//$this->load->view('template',$data);
	}
	function deletenewsletter()
	{
		$access = array("1");
		$this->checkaccess($access);
        //print_r($this->input->post('ids'));
		$this->newsletter_model->deletenewsletter($this->input->get('id'));
		$data['table']=$this->newsletter_model->viewnewsletter();
		$data['alertsuccess']="Newsletter Deleted Successfully";
		$data['page']='viewnewsletter';
		$data['title']='View Newsletter';
		$this->load->view('template',$data);
        
	}
	function deletelimitedstock()
	{
		$access = array("1");
		$this->checkaccess($access);
        //print_r($this->input->post('ids'));
		$this->newsletter_model->deletelimitedstock($this->input->get('id'));
		$data['table']=$this->newsletter_model->limitedstock();
		$data['alertsuccess']="Offer Deleted Successfully";
		$data['page']='limitedstock';
		$data['title']='View Limited Stock Offer';
		$this->load->view('template',$data);
        
	}
	function deletecontact()
	{
		$access = array("1");
		$this->checkaccess($access);
        //print_r($this->input->post('ids'));
		$this->newsletter_model->deletecontact($this->input->get('id'));
		$data['table']=$this->newsletter_model->viewcontact();
		$data['alertsuccess']="Contact Deleted Successfully";
		$data['page']='viewcontact';
		$data['title']='View Contact';
		$this->load->view('template',$data);
        
	}
	function addcreditssubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('credits','credits','trim');
		
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['before']=$this->user_model->beforeedit($this->input->post('id'));
			$data['page']='edituser';
			$data['page2']='block/userblock';
			$data['title']='Edit User';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$credits=$this->input->post('credits');
			if($this->user_model->addcredits($id,$credits)==0)
			$data['alerterror']="User Editing was unsuccesful";
			else
			$data['alertsuccess']="User edited Successfully.";
			$data['table']=$this->user_model->viewusers();
			$data['redirect']="site/addcredits?id=".$id;
			//$data['other']="template=$template";
			$this->load->view("redirect2",$data);
			
		}
	}
	function editaddress()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'country' ] =$this->user_model->getcountry();
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['page']='editaddress';
		$data['page2']='block/userblock';
		$data['title']='Edit User';
		$this->load->view('template',$data);
	}
	function editaddresssubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('billingaddress','billingaddress','trim');
		$this->form_validation->set_rules('billingcity','billingcity','trim');
		$this->form_validation->set_rules('billingstate','billingstate','trim');
		$this->form_validation->set_rules('billingcountry','billingcountry','trim');
		$this->form_validation->set_rules('shippingaddress','billingaddress','trim');
		$this->form_validation->set_rules('shippingstate','shippingstate','trim');
		$this->form_validation->set_rules('shippingcity','shippingcity','trim');
		$this->form_validation->set_rules('shippingcountry','shippingcountry','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
			$data[ 'country' ] =$this->user_model->getcountry();
			$data['before']=$this->user_model->beforeedit($this->input->post('id'));
			$data['page']='edituser';
			$data['page2']='block/userblock';
			$data['title']='Edit User';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$billingaddress=$this->input->post('billingaddress');
			$billingcity=$this->input->post('billingcity');
			$billingstate=$this->input->post('billingstate');
			$billingcountry=$this->input->post('billingcountry');
			$shippingaddress=$this->input->post('shippingaddress');
			$shippingcity=$this->input->post('shippingcity');
			$shippingstate=$this->input->post('shippingstate');
			$shippingcountry=$this->input->post('shippingcountry');
			$shippingpincode=$this->input->post('shippingpincode');
			if($this->user_model->editaddress($id,$billingaddress,$billingcity,$billingstate,$billingcountry,$shippingaddress,$shippingcity,$shippingstate,$shippingcountry,$shippingpincode)==0)
			$data['alerterror']="User Editing was unsuccesful";
			else
			$data['alertsuccess']="User edited Successfully.";
			$data['table']=$this->user_model->viewusers();
			$data['redirect']="site/editaddress?id=".$id;
			//$data['other']="template=$template";
			$this->load->view("redirect2",$data);
			
		}
	}
	function deleteuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->deleteuser($this->input->get('id'));
		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="User Deleted Successfully";
		$data['page']='viewusers';
		$data['title']='View Users';
		$this->load->view('template',$data);
	}
	function changeuserstatus()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->changestatus($this->input->get('id'));
		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="Status Changed Successfully";
		$data['page']='viewusers';
		$data['title']='View Users';
		$this->load->view('template',$data);
	}
    
    
    
    
	//category
	public function createcategory()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['category']=$this->category_model->getcategorydropdown();
		$data[ 'page' ] = 'createcategory';
		$data[ 'title' ] = 'Create category';
		$this->load->view( 'template', $data );	
	}
	function createcategorysubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('parent','parent','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('order','order','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
			$data['category']=$this->category_model->getcategorydropdown();
			$data[ 'page' ] = 'createcategory';
			$data[ 'title' ] = 'Create category';
			$this->load->view('template',$data);
		}
		else
		{
			$name=$this->input->post('name');
			$parent=$this->input->post('parent');
			$status=$this->input->post('status');
			$order=$this->input->post('order');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
			$filename="image1";
			$image1="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image1=$uploaddata['file_name'];
			}
			$filename="image2";
			$image2="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image2=$uploaddata['file_name'];
			}
			if($this->category_model->createcategory($name,$parent,$status,$order,$image1,$image2)==0)
			$data['alerterror']="New category could not be created.";
			else
			$data['alertsuccess']="category  created Successfully.";
			$data['table']=$this->category_model->viewcategory();
			$data['redirect']="site/viewcategory";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
	function viewcategory()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->category_model->viewcategory();
		$data['page']='viewcategory';
		$data['title']='View category';
		$this->load->view('template',$data);
	}
	function editcategory()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->category_model->beforeeditcategory($this->input->get('id'));
		$data['category']=$this->category_model->getcategorydropdown();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['page']='editcategory';
		$data['title']='Edit category';
		$this->load->view('template',$data);
	}
	function editcategorysubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('parent','parent','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('order','order','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
			$data['category']=$this->category_model->getcategorydropdown();
			$data['before']=$this->category_model->beforeeditcategory($this->input->post('id'));
			$data['page']='editcategory';
			$data['title']='Edit category';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$name=$this->input->post('name');
			$parent=$this->input->post('parent');
			$status=$this->input->post('status');
			$order=$this->input->post('order');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
			$filename="image1";
			$image1="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image1=$uploaddata['file_name'];
			}
			$filename="image2";
			$image2="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image2=$uploaddata['file_name'];
			}
			if($this->category_model->editcategory($id,$name,$parent,$status,$order,$image1,$image2)==0)
			$data['alerterror']="category Editing was unsuccesful";
			else
			$data['alertsuccess']="category edited Successfully.";
			$data['table']=$this->category_model->viewcategory();
			$data['redirect']="site/viewcategory";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			/*$data['page']='viewusers';
			$data['title']='View Users';
			$this->load->view('template',$data);*/
		}
	}
	function deletecategory()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->category_model->deletecategory($this->input->get('id'));
		$data['table']=$this->category_model->viewcategory();
		$data['alertsuccess']="category Deleted Successfully";
		$data['page']='viewcategory';
		$data['title']='View category';
		$this->load->view('template',$data);
	}
	//product
	public function createproduct()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->product_model->getstatusdropdown();
		$data['relatedproduct']=$this->product_model->getproductdropdown();
		$data['category']=$this->product_model->getcategorydropdown();
		$data['visibility']=$this->product_model->getvisibility();
		$data[ 'page' ] = 'createproduct';
		$data[ 'title' ] = 'Create product';
		$this->load->view( 'template', $data );	
	}
	function createproductsubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('sku','sku','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('description','description','trim|');
		$this->form_validation->set_rules('url','url','trim|');
		$this->form_validation->set_rules('visibility','visibility','trim|');
		$this->form_validation->set_rules('price','price','trim|');
		$this->form_validation->set_rules('wholesaleprice','wholesaleprice','trim|');
		$this->form_validation->set_rules('firstsaleprice','firstsaleprice','trim|');
		$this->form_validation->set_rules('secondsaleprice','secondsaleprice','trim|');
		$this->form_validation->set_rules('specialpricefrom','specialpricefrom','trim|');
		$this->form_validation->set_rules('specialpriceto','specialpriceto','trim|');
		$this->form_validation->set_rules('metatitle','metatitle','trim|');
		$this->form_validation->set_rules('metadesc','metadesc','trim|');
		$this->form_validation->set_rules('metakeyword','metakeyword','trim|');
		$this->form_validation->set_rules('quantity','quantity','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->product_model->getstatusdropdown();
			$data['relatedproduct']=$this->product_model->getproductdropdown();
			$data['category']=$this->product_model->getcategorydropdown();
			$data['visibility']=$this->product_model->getvisibility();
			$data[ 'page' ] = 'createproduct';
			$data[ 'title' ] = 'Create product';
			$this->load->view('template',$data);
		}
		else
		{
			$name=$this->input->post('name');
			$sku=$this->input->post('sku');
			$status=$this->input->post('status');
			$description=$this->input->post('description');
			$url=$this->input->post('url');
			$visibility=$this->input->post('visibility');
			$price=$this->input->post('price');
			$wholesaleprice=$this->input->post('wholesaleprice');
			$firstsaleprice=$this->input->post('firstsaleprice');
			$secondsaleprice=$this->input->post('secondsaleprice');
			$specialpricefrom=$this->input->post('specialpricefrom');
			$specialpriceto=$this->input->post('specialpriceto');
			$metatitle=$this->input->post('metatitle');
			$metadesc=$this->input->post('metadesc');
			$metakeyword=$this->input->post('metakeyword');
			$quantity=$this->input->post('quantity');
			$category=$this->input->post('category');
			$relatedproduct=$this->input->post('relatedproduct');
			if($specialpricefrom != "")
				$specialpricefrom = date("Y-m-d",strtotime($specialpricefrom));
			if($specialpriceto != "")
				$specialpriceto = date("Y-m-d",strtotime($specialpriceto));
			if($this->product_model->createproduct($name,$sku,$description,$url,$visibility,$price,$wholesaleprice,$firstsaleprice,$secondsaleprice,$specialpricefrom,$specialpriceto,$metatitle,$metadesc,$metakeyword,$quantity,$status,$category,$relatedproduct)==0)
			$data['alerterror']="New product could not be created.";
			else
			$data['alertsuccess']="product  created Successfully.";
			$data['table']=$this->product_model->viewproduct();
			$data['redirect']="site/viewproduct";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
	function viewproduct()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->product_model->viewproduct();
		$data['page']='viewproduct';
		$data['title']='View product';
		$this->load->view('template',$data);
	}
	function editproduct()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->product_model->beforeeditproduct($this->input->get('id'));
		$data[ 'status' ] =$this->product_model->getstatusdropdown();
		$data['relatedproduct']=$this->product_model->getproductdropdown();
		$data['category']=$this->product_model->getcategorydropdown();
		$data['visibility']=$this->product_model->getvisibility();
		$data['page']='editproduct';
		$data['page2']='block/productblock';
		$data['title']='Edit product';
		$this->load->view('template',$data);
	}
	function editproductsubmit()
	{
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('sku','sku','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('description','description','trim|');
		$this->form_validation->set_rules('url','url','trim|');
		$this->form_validation->set_rules('visibility','visibility','trim|');
		$this->form_validation->set_rules('price','price','trim|');
		$this->form_validation->set_rules('wholesaleprice','wholesaleprice','trim|');
		$this->form_validation->set_rules('firstsaleprice','firstsaleprice','trim|');
		$this->form_validation->set_rules('secondsaleprice','secondsaleprice','trim|');
		$this->form_validation->set_rules('specialpricefrom','specialpricefrom','trim|');
		$this->form_validation->set_rules('specialpriceto','specialpriceto','trim|');
		$this->form_validation->set_rules('metatitle','metatitle','trim|');
		$this->form_validation->set_rules('metadesc','metadesc','trim|');
		$this->form_validation->set_rules('metakeyword','metakeyword','trim|');
		$this->form_validation->set_rules('quantity','quantity','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->product_model->getstatusdropdown();
			$data['relatedproduct']=$this->product_model->getproductdropdown();
			$data['category']=$this->product_model->getcategorydropdown();
			$data['visibility']=$this->product_model->getvisibility();
			$data['before']=$this->product_model->beforeeditproduct($this->input->post('id'));
			$data['page']='editproduct';
			$data['page2']='block/productblock';
			$data['title']='Edit product';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$name=$this->input->post('name');
			$sku=$this->input->post('sku');
			$status=$this->input->post('status');
			$description=$this->input->post('description');
			$url=$this->input->post('url');
			$visibility=$this->input->post('visibility');
			$price=$this->input->post('price');
			$wholesaleprice=$this->input->post('wholesaleprice');
			$firstsaleprice=$this->input->post('firstsaleprice');
			$secondsaleprice=$this->input->post('secondsaleprice');
			$specialpricefrom=$this->input->post('specialpricefrom');
			$specialpriceto=$this->input->post('specialpriceto');
			if($specialpricefrom != "")
				$specialpricefrom = date("Y-m-d",strtotime($specialpricefrom));
			if($specialpriceto != "")
				$specialpriceto = date("Y-m-d",strtotime($specialpriceto));
			$specialpriceto=$this->input->post('specialpriceto');
			$metatitle=$this->input->post('metatitle');
			$metadesc=$this->input->post('metadesc');
			$metakeyword=$this->input->post('metakeyword');
			$quantity=$this->input->post('quantity');
			$category=$this->input->post('category');
			$relatedproduct=$this->input->post('relatedproduct');
			if($this->product_model->editproduct($id,$name,$sku,$description,$url,$visibility,$price,$wholesaleprice,$firstsaleprice,$secondsaleprice,$specialpricefrom,$specialpriceto,$metatitle,$metadesc,$metakeyword,$quantity,$status,$category,$relatedproduct)==0)
			$data['alerterror']="product Editing was unsuccesful";
			else
			$data['alertsuccess']="product edited Successfully.";
			$data['table']=$this->product_model->viewproduct();
            
			$data['redirect']="site/editproduct?id=".$id;
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			/*$data['page']='viewusers';
			$data['title']='View Users';
			$this->load->view('template',$data);*/
		}
	}
	function deleteproduct()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->product_model->deleteproduct($this->input->get('id'));
		$data['table']=$this->product_model->viewproduct();
		$data['alertsuccess']="product Deleted Successfully";
		$data['page']='viewproduct';
		$data['title']='View product';
		$this->load->view('template',$data);
	}
	function uploadproductimage()
	{
		$access = array("1");
		$this->checkaccess($access);
		$id=$this->input->get('id');
		$data['table']=$this->product_model->viewallimages($id);
		$data['before']=$this->product_model->beforeeditproduct($id);
		$data['page']='uploadproductimage';
		$data['page2']='block/productblock';
		$data['title']='Upload Image';
		$this->load->view('template',$data);
	}
	function uploadproductimagesubmit()
	 {
		$access = array("1");
		$this->checkaccess($access);
		$config[ 'upload_path' ]   = './uploads/';
		$config[ 'allowed_types' ] = 'gif|jpg|png|jpeg';
		$config[ 'encrypt_name' ]  = TRUE;
		$this->load->library( 'upload', $config );
		if(!$this->upload->do_upload( 'image'))
		{
			$data['alerterror'] = "Image Uploaded Unsuccessfully.";
			$data['table']=$this->product_model->viewallimages($id);
			$data['before']=$this->product_model->beforeeditproduct($this->input->get('id'));
			$data['page']='uploadproductimage';
			$data['page2']='block/productblock';
			$data['title']='Image Upload';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->get('id');
			$uploaddata  = $this->upload->data();
			$this->product_model->addimage($id,$uploaddata);
			$data['alertsuccess']="Image Uploaded Successfully.";
			$data['before']=$this->product_model->beforeeditproduct($this->input->get('id'));
			$data['table']=$this->product_model->viewallimages($id);
			$data['page']='uploadproductimage';
			$data['title']='Image Upload';
			//$this->load->view('template',$data);
			$data['redirect']="site/uploadproductimage?id=$id";
			//$data['other']="template=$template";
			$this->load->view("redirect2",$data);
		}
	 }
	 function deleteimage()
	 {
		$access = array("1");
		$this->checkaccess($access);
		$id=$this->input->get('id');
		$imageid=$this->input->get('imageid');
		$this->product_model->deleteimage($imageid,$id);
		$data['alertsuccess']="Image Deleted Successfully.";
		$data['before']=$this->product_model->beforeeditproduct($this->input->get('id'));
		$data['table']=$this->product_model->viewallimages($id);
		$data['page']='uploadproductimage';
		$data['page2']='block/productblock';
		$data['title']='Image Upload';
		$this->load->view('template',$data);
	 
	 }
	 function defaultimage()
	 {
		$access = array("1");
		$this->checkaccess($access);
		$id=$this->input->get('id');
		$imageid=$this->input->get('imageid');
		$this->product_model->defaultimage($imageid,$id);
		$data['alertsuccess']="Default Image is Selected Successfully.";
		$data['before']=$this->product_model->beforeeditproduct($this->input->get('id'));
		$data['table']=$this->product_model->viewallimages($id);
		$data['page']='uploadproductimage';
		$data['page2']='block/productblock';
		$data['title']='Image Upload';
		$this->load->view('template',$data);
	 
	 }
	  function changeorder()
	 {
		$access = array("1");
		$this->checkaccess($access);
		$id=$this->input->get_post('id');
		$order=$this->input->get_post('order');
		$product=$this->input->get_post('product');
		$data['page2']='block/productblock';
		$this->product_model->changeorder($id,$order,$product);	 
	 }
	//Wishlist
	function wishlistsubmit()
	{
		$this->checkaccess($access);
		$user=$this->input->post('user');
		$product=$this->input->post('product');
		if($this->wishlist_model->wishlistsubmit($user,$product)==0)
		$data['message']="0";
		else
		$data['message']="1";
		
		$this->load->view('json',$data);
	}
	function viewwishlist()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->wishlist_model->viewwishlist();
		$data['page']='viewwishlist';
		$data['title']='View Wishlist';
		$this->load->view('template',$data);
	}
	function viewuserwishlist()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->wishlist_model->viewuserwishlist($this->input->get('id'));
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['page']='viewuserwishlist';
		$data['page2']='block/userblock';
		$data['title']='View Wishlist';
		$this->load->view('template',$data);
	}
	//cart
	function cartsubmit()
	{
		$this->checkaccess($access);
		$user=$this->input->post('user');
		$product=$this->input->post('product');
		$quantity=$this->input->post('quantity');
		if($this->cart_model->cartsubmit($user,$product,$quantity)==0)
		$data['message']="0";
		else
		$data['message']="1";
		
		$this->load->view('json',$data);
	}
	function viewcart()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->cart_model->viewcart();
		$data['page']='viewcart';
		$data['title']='View cart';
		$this->load->view('template',$data);
	}
	function viewusercart()
	{
		$access = array("1");
		$this->checkaccess($access);
		
		$data['table']=$this->cart_model->viewusercart($this->input->get('id'));
		$data['page']='viewusercart';
		$data['page2']='block/userblock';
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['title']='View cart';
		$this->load->view('template',$data);
	}
	//page
	public function createpage()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'page' ] = 'createpage';
		$data[ 'title' ] = 'Create page';
		$this->load->view( 'template', $data );	
	}
	function createpagesubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('content','content','trim|');
		
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'page' ] = 'createpage';
			$data[ 'title' ] = 'Create page';
			$this->load->view('template',$data);
		}
		else
		{
			$name=$this->input->post('name');
			$content=$this->input->post('content');
			if($this->page_model->createpage($name,$content)==0)
			$data['alerterror']="New page could not be created.";
			else
			$data['alertsuccess']="page  created Successfully.";
			$data['table']=$this->page_model->viewpage();
			$data['redirect']="site/viewpage";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
	function viewpage()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->page_model->viewpage();
		$data['page']='viewpage';
		$data['title']='View page';
		$this->load->view('template',$data);
	}
	function editpage()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->page_model->beforeeditpage($this->input->get('id'));
		$data['page']='editpage';
		$data['title']='Edit page';
		$this->load->view('template',$data);
	}
	function editpagesubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('content','content','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['before']=$this->page_model->beforeeditpage($this->input->post('id'));
			$data['page']='editpage';
			$data['title']='Edit page';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$name=$this->input->post('name');
			$content=$this->input->post('content');
			if($this->page_model->editpage($id,$name,$content)==0)
			$data['alerterror']="page Editing was unsuccesful";
			else
			$data['alertsuccess']="page edited Successfully.";
			$data['table']=$this->page_model->viewpage();
			$data['redirect']="site/viewpage";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			/*$data['page']='viewusers';
			$data['title']='View Users';
			$this->load->view('template',$data);*/
		}
	}
	function deletepage()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->page_model->deletepage($this->input->get('id'));
		$data['table']=$this->page_model->viewpage();
		$data['alertsuccess']="page Deleted Successfully";
		$data['page']='viewpage';
		$data['title']='View page';
		$this->load->view('template',$data);
	}
	//slider
	public function createslider()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->slider_model->getstatusdropdown();
		$data['order']=$this->order_model->getorderdropdown();
		$data['product']=$this->product_model->getproductdropdown();
		$data[ 'page' ] = 'createslider';
		$data[ 'title' ] = 'Create slider';
		$this->load->view( 'template', $data );	
	}
	function createslidersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
//		$this->form_validation->set_rules('link','link','trim|');
//		$this->form_validation->set_rules('target','target','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('product','product','trim|');
		$this->form_validation->set_rules('order','order','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->slider_model->getstatusdropdown();
            $data['order']=$this->order_model->getorderdropdown();
            $data['product']=$this->product_model->getproductdropdown();
			$data[ 'page' ] = 'createslider';
			$data[ 'title' ] = 'Create slider';
			$this->load->view('template',$data);
		}
		else
		{
			$name=$this->input->post('name');
//			$link=$this->input->post('link');
//			$target=$this->input->post('target');
//			$fromdate=$this->input->post('fromdate');
//			if($fromdate != "")
//				$fromdate = date("Y-m-d",strtotime($fromdate));
//			$todate=$this->input->post('todate');
//			if($todate != "")
//				$todate = date("Y-m-d",strtotime($todate));
			$status=$this->input->post('status');
			$order=$this->input->post('order');
			$product=$this->input->post('product');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
			}
			
			if($this->slider_model->createslider($name,$status,$order,$product,$image)==0)
			$data['alerterror']="New slider could not be created.";
			else
			$data['alertsuccess']="slider  created Successfully.";
			$data['table']=$this->slider_model->viewslider();
			$data['redirect']="site/viewslider";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
	function viewslider()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->slider_model->viewslider();
		$data['page']='viewslider';
		$data['title']='View slider';
		$this->load->view('template',$data);
	}
	function editslider()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->slider_model->beforeeditslider($this->input->get('id'));
		$data[ 'status' ] =$this->slider_model->getstatusdropdown();
		$data['product']=$this->product_model->getproductdropdown();
		$data['page']='editslider';
		$data['title']='Edit slider';
		$this->load->view('template',$data);
	}
	function editslidersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('product','product','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('order','order','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->slider_model->getstatusdropdown();
			$data['before']=$this->slider_model->beforeeditslider($this->input->post('id'));
			$data['page']='editslider';
			$data['title']='Edit slider';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$name=$this->input->post('name');
			$product=$this->input->post('product');
//			$target=$this->input->post('target');
//			$fromdate=$this->input->post('fromdate');
//			if($fromdate != "")
//				$fromdate = date("Y-m-d",strtotime($fromdate));
//			$todate=$this->input->post('todate');
//			if($todate != "")
//				$todate = date("Y-m-d",strtotime($todate));
			$status=$this->input->post('status');
			$order=$this->input->post('order');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
			}
			if($this->slider_model->editslider($id,$name,$status,$order,$product,$image)==0)
			$data['alerterror']="slider Editing was unsuccesful";
			else
			$data['alertsuccess']="slider edited Successfully.";
			$data['table']=$this->slider_model->viewslider();
			$data['redirect']="site/viewslider";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			/*$data['page']='viewusers';
			$data['title']='View Users';
			$this->load->view('template',$data);*/
		}
	}
	function deleteslider()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->slider_model->deleteslider($this->input->get('id'));
		$data['table']=$this->slider_model->viewslider();
		$data['alertsuccess']="slider Deleted Successfully";
		$data['page']='viewslider';
		$data['title']='View slider';
		$this->load->view('template',$data);
	}
	//banner1
	public function createbanner1()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->banner_model->getstatusdropdown();
		$data[ 'page' ] = 'createbanner1';
		$data[ 'title' ] = 'Create banner1';
		$this->load->view( 'template', $data );	
	}
	function createbannersubmit1()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('link','link','trim|');
		$this->form_validation->set_rules('target','target','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->banner_model->getstatusdropdown();
			$data[ 'page' ] = 'createbanner1';
			$data[ 'title' ] = 'Create banner1';
			$this->load->view('template',$data);
		}
		else
		{
			$name=$this->input->post('name');
			$link=$this->input->post('link');
			$target=$this->input->post('target');
			$fromdate=$this->input->post('fromdate');
			if($fromdate != "")
				$fromdate = date("Y-m-d",strtotime($fromdate));
			$todate=$this->input->post('todate');
			if($todate != "")
				$todate = date("Y-m-d",strtotime($todate));
			$status=$this->input->post('status');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
			}
			
			if($this->banner_model->createbanner1($name,$link,$target,$status,$fromdate,$todate,$image)==0)
			$data['alerterror']="New banner1 could not be created.";
			else
			$data['alertsuccess']="banner1  created Successfully.";
			$data['table']=$this->banner_model->viewbanner1();
			$data['redirect']="site/viewbanner1";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
	function viewbanner1()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->banner_model->viewbanner1();
		$data['page']='viewbanner1';
		$data['title']='View banner1';
		$this->load->view('template',$data);
	}
	function editbanner1()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->banner_model->beforeeditbanner1($this->input->get('id'));
		$data[ 'status' ] =$this->banner_model->getstatusdropdown();
		$data['page']='editbanner1';
		$data['title']='Edit banner1';
		$this->load->view('template',$data);
	}
	function editbannersubmit1()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('link','link','trim|');
		$this->form_validation->set_rules('target','target','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->banner_model->getstatusdropdown();
			$data['before']=$this->banner_model->beforeeditbanner1($this->input->post('id'));
			$data['page']='editbanner1';
			$data['title']='Edit banner1';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$name=$this->input->post('name');
			$link=$this->input->post('link');
			$target=$this->input->post('target');
			$fromdate=$this->input->post('fromdate');
			if($fromdate != "")
				$fromdate = date("Y-m-d",strtotime($fromdate));
			$todate=$this->input->post('todate');
			if($todate != "")
				$todate = date("Y-m-d",strtotime($todate));
			$status=$this->input->post('status');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
			}
			if($this->banner_model->editbanner1($id,$name,$link,$target,$status,$fromdate,$todate,$image)==0)
			$data['alerterror']="banner1 Editing was unsuccesful";
			else
			$data['alertsuccess']="banner1 edited Successfully.";
			$data['table']=$this->banner_model->viewbanner1();
			$data['redirect']="site/viewbanner1";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			/*$data['page']='viewusers';
			$data['title']='View Users';
			$this->load->view('template',$data);*/
		}
	}
	function deletebanner1()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->banner_model->deletebanner1($this->input->get('id'));
		$data['table']=$this->banner_model->viewbanner1();
		$data['alertsuccess']="banner1 Deleted Successfully";
		$data['page']='viewbanner1';
		$data['title']='View banner1';
		$this->load->view('template',$data);
	}
	//banner2
	public function createbanner2()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->banner_model->getstatusdropdown();
		$data[ 'page' ] = 'createbanner2';
		$data[ 'title' ] = 'Create banner2';
		$this->load->view( 'template', $data );	
	}
	function createbannersubmit2()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('link','link','trim|');
		$this->form_validation->set_rules('target','target','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->banner_model->getstatusdropdown();
			$data[ 'page' ] = 'createbanner2';
			$data[ 'title' ] = 'Create banner2';
			$this->load->view('template',$data);
		}
		else
		{
			$name=$this->input->post('name');
			$link=$this->input->post('link');
			$target=$this->input->post('target');
			$fromdate=$this->input->post('fromdate');
			if($fromdate != "")
				$fromdate = date("Y-m-d",strtotime($fromdate));
			$todate=$this->input->post('todate');
			if($todate != "")
				$todate = date("Y-m-d",strtotime($todate));
			$status=$this->input->post('status');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
			}
			
			if($this->banner_model->createbanner2($name,$link,$target,$status,$fromdate,$todate,$image)==0)
			$data['alerterror']="New banner2 could not be created.";
			else
			$data['alertsuccess']="banner2  created Successfully.";
			$data['table']=$this->banner_model->viewbanner2();
			$data['redirect']="site/viewbanner2";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
	function viewbanner2()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->banner_model->viewbanner2();
		$data['page']='viewbanner2';
		$data['title']='View banner2';
		$this->load->view('template',$data);
	}
	function editbanner2()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->banner_model->beforeeditbanner2($this->input->get('id'));
		$data[ 'status' ] =$this->banner_model->getstatusdropdown();
		$data['page']='editbanner2';
		$data['title']='Edit banner2';
		$this->load->view('template',$data);
	}
	function editbannersubmit2()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('link','link','trim|');
		$this->form_validation->set_rules('target','target','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->banner_model->getstatusdropdown();
			$data['before']=$this->banner_model->beforeeditbanner2($this->input->post('id'));
			$data['page']='editbanner2';
			$data['title']='Edit banner2';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$name=$this->input->post('name');
			$link=$this->input->post('link');
			$target=$this->input->post('target');
			$fromdate=$this->input->post('fromdate');
			if($fromdate != "")
				$fromdate = date("Y-m-d",strtotime($fromdate));
			$todate=$this->input->post('todate');
			if($todate != "")
				$todate = date("Y-m-d",strtotime($todate));
			$status=$this->input->post('status');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
			}
			if($this->banner_model->editbanner2($id,$name,$link,$target,$status,$fromdate,$todate,$image)==0)
			$data['alerterror']="banner2 Editing was unsuccesful";
			else
			$data['alertsuccess']="banner2 edited Successfully.";
			$data['table']=$this->banner_model->viewbanner2();
			$data['redirect']="site/viewbanner2";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			/*$data['page']='viewusers';
			$data['title']='View Users';
			$this->load->view('template',$data);*/
		}
	}
	function deletebanner2()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->banner_model->deletebanner2($this->input->get('id'));
		$data['table']=$this->banner_model->viewbanner2();
		$data['alertsuccess']="banner2 Deleted Successfully";
		$data['page']='viewbanner2';
		$data['title']='View banner2';
		$this->load->view('template',$data);
	}
	//banner3
	public function createbanner3()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->banner_model->getstatusdropdown();
		$data[ 'page' ] = 'createbanner3';
		$data[ 'title' ] = 'Create banner3';
		$this->load->view( 'template', $data );	
	}
	function createbannersubmit3()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('link','link','trim|');
		$this->form_validation->set_rules('target','target','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->banner_model->getstatusdropdown();
			$data[ 'page' ] = 'createbanner3';
			$data[ 'title' ] = 'Create banner3';
			$this->load->view('template',$data);
		}
		else
		{
			$name=$this->input->post('name');
			$link=$this->input->post('link');
			$target=$this->input->post('target');
			$fromdate=$this->input->post('fromdate');
			if($fromdate != "")
				$fromdate = date("Y-m-d",strtotime($fromdate));
			$todate=$this->input->post('todate');
			if($todate != "")
				$todate = date("Y-m-d",strtotime($todate));
			$status=$this->input->post('status');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
			}
			
			if($this->banner_model->createbanner3($name,$link,$target,$status,$fromdate,$todate,$image)==0)
			$data['alerterror']="New banner3 could not be created.";
			else
			$data['alertsuccess']="banner3  created Successfully.";
			$data['table']=$this->banner_model->viewbanner3();
			$data['redirect']="site/viewbanner3";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
	function viewbanner3()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->banner_model->viewbanner3();
		$data['page']='viewbanner3';
		$data['title']='View banner3';
		$this->load->view('template',$data);
	}
	function editbanner3()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->banner_model->beforeeditbanner3($this->input->get('id'));
		$data[ 'status' ] =$this->banner_model->getstatusdropdown();
		$data['page']='editbanner3';
		$data['title']='Edit banner3';
		$this->load->view('template',$data);
	}
	function editbannersubmit3()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('link','link','trim|');
		$this->form_validation->set_rules('target','target','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->banner_model->getstatusdropdown();
			$data['before']=$this->banner_model->beforeeditbanner3($this->input->post('id'));
			$data['page']='editbanner3';
			$data['title']='Edit banner3';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$name=$this->input->post('name');
			$link=$this->input->post('link');
			$target=$this->input->post('target');
			$fromdate=$this->input->post('fromdate');
			if($fromdate != "")
				$fromdate = date("Y-m-d",strtotime($fromdate));
			$todate=$this->input->post('todate');
			if($todate != "")
				$todate = date("Y-m-d",strtotime($todate));
			$status=$this->input->post('status');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
			}
			if($this->banner_model->editbanner3($id,$name,$link,$target,$status,$fromdate,$todate,$image)==0)
			$data['alerterror']="banner3 Editing was unsuccesful";
			else
			$data['alertsuccess']="banner3 edited Successfully.";
			$data['table']=$this->banner_model->viewbanner3();
			$data['redirect']="site/viewbanner3";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			/*$data['page']='viewusers';
			$data['title']='View Users';
			$this->load->view('template',$data);*/
		}
	}
	function deletebanner3()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->banner_model->deletebanner3($this->input->get('id'));
		$data['table']=$this->banner_model->viewbanner3();
		$data['alertsuccess']="banner3 Deleted Successfully";
		$data['page']='viewbanner3';
		$data['title']='View banner3';
		$this->load->view('template',$data);
	}
	//celebcorner
	public function createcelebcorner()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->celebcorner_model->getstatusdropdown();
		$data[ 'page' ] = 'createcelebcorner';
		$data[ 'title' ] = 'Create celebcorner';
		$this->load->view( 'template', $data );	
	}
	function createcelebcornersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('link','link','trim|');
		$this->form_validation->set_rules('target','target','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('order','order','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->celebcorner_model->getstatusdropdown();
			$data[ 'page' ] = 'createcelebcorner';
			$data[ 'title' ] = 'Create celebcorner';
			$this->load->view('template',$data);
		}
		else
		{
			$name=$this->input->post('name');
			$link=$this->input->post('link');
			$target=$this->input->post('target');
			$status=$this->input->post('status');
			$order=$this->input->post('order');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
			}
			
			if($this->celebcorner_model->createcelebcorner($name,$link,$target,$status,$order,$image)==0)
			$data['alerterror']="New celebcorner could not be created.";
			else
			$data['alertsuccess']="celebcorner  created Successfully.";
			$data['table']=$this->celebcorner_model->viewcelebcorner();
			$data['redirect']="site/viewcelebcorner";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
	function viewcelebcorner()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->celebcorner_model->viewcelebcorner();
		$data['page']='viewcelebcorner';
		$data['title']='View celebcorner';
		$this->load->view('template',$data);
	}
	function editcelebcorner()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->celebcorner_model->beforeeditcelebcorner($this->input->get('id'));
		$data[ 'status' ] =$this->celebcorner_model->getstatusdropdown();
		$data['page']='editcelebcorner';
		$data['title']='Edit celebcorner';
		$this->load->view('template',$data);
	}
	function editcelebcornersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('link','link','trim|');
		$this->form_validation->set_rules('target','target','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('order','order','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->celebcorner_model->getstatusdropdown();
			$data['before']=$this->celebcorner_model->beforeeditcelebcorner($this->input->post('id'));
			$data['page']='editcelebcorner';
			$data['title']='Edit celebcorner';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$name=$this->input->post('name');
			$link=$this->input->post('link');
			$target=$this->input->post('target');
			$status=$this->input->post('status');
			$order=$this->input->post('order');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
			}
			if($this->celebcorner_model->editcelebcorner($id,$name,$link,$target,$status,$order,$image)==0)
			$data['alerterror']="celebcorner Editing was unsuccesful";
			else
			$data['alertsuccess']="celebcorner edited Successfully.";
			$data['table']=$this->celebcorner_model->viewcelebcorner();
			$data['redirect']="site/viewcelebcorner";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			/*$data['page']='viewusers';
			$data['title']='View Users';
			$this->load->view('template',$data);*/
		}
	}
	function deletecelebcorner()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->celebcorner_model->deletecelebcorner($this->input->get('id'));
		$data['table']=$this->celebcorner_model->viewcelebcorner();
		$data['alertsuccess']="celebcorner Deleted Successfully";
		$data['page']='viewcelebcorner';
		$data['title']='View celebcorner';
		$this->load->view('template',$data);
	}
	//bloggerscorner
	public function createbloggerscorner()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->bloggerscorner_model->getstatusdropdown();
		$data[ 'page' ] = 'createbloggerscorner';
		$data[ 'title' ] = 'Create bloggerscorner';
		$this->load->view( 'template', $data );	
	}
	function createbloggerscornersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('link','link','trim|');
		$this->form_validation->set_rules('target','target','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('order','order','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->bloggerscorner_model->getstatusdropdown();
			$data[ 'page' ] = 'createbloggerscorner';
			$data[ 'title' ] = 'Create bloggerscorner';
			$this->load->view('template',$data);
		}
		else
		{
			$name=$this->input->post('name');
			$link=$this->input->post('link');
			$target=$this->input->post('target');
			$status=$this->input->post('status');
			$order=$this->input->post('order');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
			}
			
			if($this->bloggerscorner_model->createbloggerscorner($name,$link,$target,$status,$order,$image)==0)
			$data['alerterror']="New bloggerscorner could not be created.";
			else
			$data['alertsuccess']="bloggerscorner  created Successfully.";
			$data['table']=$this->bloggerscorner_model->viewbloggerscorner();
			$data['redirect']="site/viewbloggerscorner";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
	function viewbloggerscorner()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->bloggerscorner_model->viewbloggerscorner();
		$data['page']='viewbloggerscorner';
		$data['title']='View bloggerscorner';
		$this->load->view('template',$data);
	}
	function editbloggerscorner()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->bloggerscorner_model->beforeeditbloggerscorner($this->input->get('id'));
		$data[ 'status' ] =$this->bloggerscorner_model->getstatusdropdown();
		$data['page']='editbloggerscorner';
		$data['title']='Edit bloggerscorner';
		$this->load->view('template',$data);
	}
	function editbloggerscornersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('link','link','trim|');
		$this->form_validation->set_rules('target','target','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('order','order','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->bloggerscorner_model->getstatusdropdown();
			$data['before']=$this->bloggerscorner_model->beforeeditbloggerscorner($this->input->post('id'));
			$data['page']='editbloggerscorner';
			$data['title']='Edit bloggerscorner';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$name=$this->input->post('name');
			$link=$this->input->post('link');
			$target=$this->input->post('target');
			$status=$this->input->post('status');
			$order=$this->input->post('order');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
			}
			if($this->bloggerscorner_model->editbloggerscorner($id,$name,$link,$target,$status,$order,$image)==0)
			$data['alerterror']="bloggerscorner Editing was unsuccesful";
			else
			$data['alertsuccess']="bloggerscorner edited Successfully.";
			$data['table']=$this->bloggerscorner_model->viewbloggerscorner();
			$data['redirect']="site/viewbloggerscorner";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			/*$data['page']='viewusers';
			$data['title']='View Users';
			$this->load->view('template',$data);*/
		}
	}
	function deletebloggerscorner()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->bloggerscorner_model->deletebloggerscorner($this->input->get('id'));
		$data['table']=$this->bloggerscorner_model->viewbloggerscorner();
		$data['alertsuccess']="bloggerscorner Deleted Successfully";
		$data['page']='viewbloggerscorner';
		$data['title']='View bloggerscorner';
		$this->load->view('template',$data);
	}
	//navigation
	public function createnavigation()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->navigation_model->getstatusdropdown();
		$data[ 'parent' ] =$this->navigation_model->getnavigationdropdown();
		$data[ 'page' ] = 'createnavigation';
		$data[ 'title' ] = 'Create navigation';
		$this->load->view( 'template', $data );	
	}
	function createnavigationsubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('link','link','trim|');
		$this->form_validation->set_rules('target','target','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('order','order','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->navigation_model->getstatusdropdown();
			$data[ 'parent' ] =$this->navigation_model->getnavigationdropdown();
			$data[ 'page' ] = 'createnavigation';
			$data[ 'title' ] = 'Create navigation';
			$this->load->view('template',$data);
		}
		else
		{
			$name=$this->input->post('name');
			$link=$this->input->post('link');
			$target=$this->input->post('target');
			$status=$this->input->post('status');
			$order=$this->input->post('order');
			$parent=$this->input->post('parent');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
			}
			
			if($this->navigation_model->createnavigation($name,$link,$target,$status,$order,$image,$parent)==0)
			$data['alerterror']="New navigation could not be created.";
			else
			$data['alertsuccess']="navigation  created Successfully.";
			$data['table']=$this->navigation_model->viewnavigation();
			$data['redirect']="site/viewnavigation";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
	function viewnavigation()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->navigation_model->viewnavigation();
		$data['page']='viewnavigation';
		$data['title']='View navigation';
		$this->load->view('template',$data);
	}
	function editnavigation()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->navigation_model->beforeeditnavigation($this->input->get('id'));
		$data[ 'status' ] =$this->navigation_model->getstatusdropdown();
		$data[ 'parent' ] =$this->navigation_model->getnavigationdropdown();
		$data['page']='editnavigation';
		$data['title']='Edit navigation';
		$this->load->view('template',$data);
	}
	function editnavigationsubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('link','link','trim|');
		$this->form_validation->set_rules('target','target','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('order','order','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->navigation_model->getstatusdropdown();
			$data[ 'parent' ] =$this->navigation_model->getnavigationdropdown();
			$data['before']=$this->navigation_model->beforeeditnavigation($this->input->post('id'));
			$data['page']='editnavigation';
			$data['title']='Edit navigation';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$name=$this->input->post('name');
			$link=$this->input->post('link');
			$target=$this->input->post('target');
			$status=$this->input->post('status');
			$order=$this->input->post('order');
			$parent=$this->input->post('parent');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
			}
			if($this->navigation_model->editnavigation($id,$name,$link,$target,$status,$order,$image,$parent)==0)
			$data['alerterror']="navigation Editing was unsuccesful";
			else
			$data['alertsuccess']="navigation edited Successfully.";
			$data['table']=$this->navigation_model->viewnavigation();
			$data['redirect']="site/viewnavigation";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			/*$data['page']='viewusers';
			$data['title']='View Users';
			$this->load->view('template',$data);*/
		}
	}
	function deletenavigation()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->navigation_model->deletenavigation($this->input->get('id'));
		$data['table']=$this->navigation_model->viewnavigation();
		$data['alertsuccess']="navigation Deleted Successfully";
		$data['page']='viewnavigation';
		$data['title']='View navigation';
		$this->load->view('template',$data);
	}
	//currency
	public function createcurrency()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'isdefault' ] =$this->currency_model->getisdefault();
		$data[ 'country' ] =$this->currency_model->getcountry();
		$data[ 'page' ] = 'createcurrency';
		$data[ 'title' ] = 'Create currency';
		$this->load->view( 'template', $data );	
	}
	function createcurrencysubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('conversionrate','conversionrate','trim|');
		$this->form_validation->set_rules('isdefault','isdefault','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'isdefault' ] =$this->currency_model->getisdefault();
			$data[ 'country' ] =$this->currency_model->getcountry();
			$data[ 'page' ] = 'createcurrency';
			$data[ 'title' ] = 'Create currency';
			$this->load->view('template',$data);
		}
		else
		{
			$name=$this->input->post('name');
			$isdefault=$this->input->post('isdefault');
			$conversionrate=$this->input->post('conversionrate');
			$country=$this->input->post('country');
			if($this->currency_model->createcurrency($name,$isdefault,$conversionrate,$country)==0)
			$data['alerterror']="New currency could not be created.";
			else
			$data['alertsuccess']="currency  created Successfully.";
			$data['table']=$this->currency_model->viewcurrency();
			$data['redirect']="site/viewcurrency";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
	function viewcurrency()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->currency_model->viewcurrency();
		$data['page']='viewcurrency';
		$data['title']='View currency';
		$this->load->view('template',$data);
	}
	function editcurrency()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->currency_model->beforeeditcurrency($this->input->get('id'));
		$data[ 'isdefault' ] =$this->currency_model->getisdefault();
			$data[ 'country' ] =$this->currency_model->getcountry();
		$data['page']='editcurrency';
		$data['title']='Edit currency';
		$this->load->view('template',$data);
	}
	function editcurrencysubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('conversionrate','conversionrate','trim|');
		$this->form_validation->set_rules('isdefault','isdefault','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['before']=$this->currency_model->beforeeditcurrency($this->input->post('id'));
			$data[ 'isdefault' ] =$this->currency_model->getisdefault();
			$data[ 'country' ] =$this->currency_model->getcountry();
			$data['page']='editcurrency';
			$data['title']='Edit currency';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$name=$this->input->post('name');
			$isdefault=$this->input->post('isdefault');
			$conversionrate=$this->input->post('conversionrate');
			$country=$this->input->post('country');
			if($this->currency_model->editcurrency($id,$name,$isdefault,$conversionrate,$country)==0)
			$data['alerterror']="currency Editing was unsuccesful";
			else
			$data['alertsuccess']="currency edited Successfully.";
			$data['table']=$this->currency_model->viewcurrency();
			$data['redirect']="site/viewcurrency";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			/*$data['currency']='viewusers';
			$data['title']='View Users';
			$this->load->view('template',$data);*/
		}
	}
	function deletecurrency()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->currency_model->deletecurrency($this->input->get('id'));
		$data['table']=$this->currency_model->viewcurrency();
		$data['alertsuccess']="currency Deleted Successfully";
		$data['page']='viewcurrency';
		$data['title']='View currency';
		$this->load->view('template',$data);
	}
	//paymentgateway
	public function createpaymentgateway()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'isdefault' ] =$this->paymentgateway_model->getisdefault();
		$data[ 'status' ] =$this->paymentgateway_model->getstatusdropdown();
		$data[ 'page' ] = 'createpaymentgateway';
		$data[ 'title' ] = 'Create paymentgateway';
		$this->load->view( 'template', $data );	
	}
	function createpaymentgatewaysubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('order','order','trim|');
		$this->form_validation->set_rules('isdefault','isdefault','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'isdefault' ] =$this->paymentgateway_model->getisdefault();
			$data[ 'status' ] =$this->paymentgateway_model->getstatusdropdown();
			$data[ 'page' ] = 'createpaymentgateway';
			$data[ 'title' ] = 'Create paymentgateway';
			$this->load->view('template',$data);
		}
		else
		{
			$name=$this->input->post('name');
			$isdefault=$this->input->post('isdefault');
			$order=$this->input->post('order');
			$status=$this->input->post('status');
			if($this->paymentgateway_model->createpaymentgateway($name,$isdefault,$order,$status)==0)
			$data['alerterror']="New paymentgateway could not be created.";
			else
			$data['alertsuccess']="paymentgateway  created Successfully.";
			$data['table']=$this->paymentgateway_model->viewpaymentgateway();
			$data['redirect']="site/viewpaymentgateway";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
	function viewpaymentgateway()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->paymentgateway_model->viewpaymentgateway();
		$data['page']='viewpaymentgateway';
		$data['title']='View paymentgateway';
		$this->load->view('template',$data);
	}
	function editpaymentgateway()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->paymentgateway_model->beforeeditpaymentgateway($this->input->get('id'));
		$data[ 'isdefault' ] =$this->paymentgateway_model->getisdefault();
		$data[ 'status' ] =$this->paymentgateway_model->getstatusdropdown();
		$data['page']='editpaymentgateway';
		$data['title']='Edit paymentgateway';
		$this->load->view('template',$data);
	}
	function editpaymentgatewaysubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('order','order','trim|');
		$this->form_validation->set_rules('isdefault','isdefault','trim|');
		$this->form_validation->set_rules('status','status','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['before']=$this->paymentgateway_model->beforeeditpaymentgateway($this->input->post('id'));
			$data[ 'isdefault' ] =$this->paymentgateway_model->getisdefault();
			$data[ 'status' ] =$this->paymentgateway_model->getstatusdropdown();
			$data['page']='editpaymentgateway';
			$data['title']='Edit paymentgateway';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$name=$this->input->post('name');
			$isdefault=$this->input->post('isdefault');
			$order=$this->input->post('order');
			$status=$this->input->post('status');
			if($this->paymentgateway_model->editpaymentgateway($id,$name,$isdefault,$order,$status)==0)
			$data['alerterror']="paymentgateway Editing was unsuccesful";
			else
			$data['alertsuccess']="paymentgateway edited Successfully.";
			$data['table']=$this->paymentgateway_model->viewpaymentgateway();
			$data['redirect']="site/viewpaymentgateway";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			/*$data['paymentgateway']='viewusers';
			$data['title']='View Users';
			$this->load->view('template',$data);*/
		}
	}
	function deletepaymentgateway()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->paymentgateway_model->deletepaymentgateway($this->input->get('id'));
		$data['table']=$this->paymentgateway_model->viewpaymentgateway();
		$data['alertsuccess']="paymentgateway Deleted Successfully";
		$data['page']='viewpaymentgateway';
		$data['title']='View paymentgateway';
		$this->load->view('template',$data);
	}
	//discountcoupon
	public function creatediscountcoupon()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'coupontype' ] =$this->discountcoupon_model->getcoupontype();
		$data[ 'product' ] =$this->discountcoupon_model->getproducts();
		$data[ 'page' ] = 'creatediscountcoupon';
		$data[ 'title' ] = 'Create discountcoupon';
		$this->load->view( 'template', $data );	
	}
	function creatediscountcouponsubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('coupontype','coupontype','trim|');
		$this->form_validation->set_rules('discountpercent','discountpercent','trim|');
		$this->form_validation->set_rules('discountamount','discountamount','trim|');
		$this->form_validation->set_rules('minamount','minamount','trim|');
		$this->form_validation->set_rules('xproducts','xproducts','trim|');
		$this->form_validation->set_rules('yproducts','yproducts','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'coupontype' ] =$this->discountcoupon_model->getcoupontype();
			$data[ 'product' ] =$this->discountcoupon_model->getproducts();
			$data[ 'page' ] = 'creatediscountcoupon';
			$data[ 'title' ] = 'Create discountcoupon';
			$this->load->view('template',$data);
		}
		else
		{
			$coupontype=$this->input->post('coupontype');
			$discountpercent=$this->input->post('discountpercent');
			$discountamount=$this->input->post('discountamount');
			$minamount=$this->input->post('minamount');
			$xproducts=$this->input->post('xproducts');
			$yproducts=$this->input->post('yproducts');
			$couponcode=$this->input->post('couponcode');
			$product=$this->input->post('product');
			if($this->discountcoupon_model->creatediscountcoupon($coupontype,$discountpercent,$discountamount,$minamount,$xproducts,$yproducts,$couponcode,$product)==0)
			$data['alerterror']="New discountcoupon could not be created.";
			else
			$data['alertsuccess']="discountcoupon  created Successfully.";
			$data['table']=$this->discountcoupon_model->viewdiscountcoupon();
			$data['redirect']="site/viewdiscountcoupon";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
	function viewdiscountcoupon()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->discountcoupon_model->viewdiscountcoupon();
		$data['page']='viewdiscountcoupon';
		$data['title']='View discountcoupon';
		$this->load->view('template',$data);
	}
	function editdiscountcoupon()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->discountcoupon_model->beforeeditdiscountcoupon($this->input->get('id'));
		$data[ 'coupontype' ] =$this->discountcoupon_model->getcoupontype();
		$data[ 'product' ] =$this->discountcoupon_model->getproducts();
		$data['page']='editdiscountcoupon';
		$data['title']='Edit discountcoupon';
		$this->load->view('template',$data);
	}
	function editdiscountcouponsubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('coupontype','coupontype','trim|');
		$this->form_validation->set_rules('discountpercent','discountpercent','trim|');
		$this->form_validation->set_rules('discountamount','discountamount','trim|');
		$this->form_validation->set_rules('minamount','minamount','trim|');
		$this->form_validation->set_rules('xproducts','xproducts','trim|');
		$this->form_validation->set_rules('yproducts','yproducts','trim|');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['before']=$this->discountcoupon_model->beforeeditdiscountcoupon($this->input->post('id'));
			$data[ 'coupontype' ] =$this->discountcoupon_model->getcoupontype();
			$data[ 'product' ] =$this->discountcoupon_model->getproducts();
			$data['page']='editdiscountcoupon';
			$data['title']='Edit discountcoupon';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$coupontype=$this->input->post('coupontype');
			$discountpercent=$this->input->post('discountpercent');
			$discountamount=$this->input->post('discountamount');
			$minamount=$this->input->post('minamount');
			$xproducts=$this->input->post('xproducts');
			$yproducts=$this->input->post('yproducts');
			$couponcode=$this->input->post('couponcode');
			$product=$this->input->post('product');
			if($this->discountcoupon_model->editdiscountcoupon($id,$coupontype,$discountpercent,$discountamount,$minamount,$xproducts,$yproducts,$couponcode,$product)==0)
			$data['alerterror']="discountcoupon Editing was unsuccesful";
			else
			$data['alertsuccess']="discountcoupon edited Successfully.";
			$data['table']=$this->discountcoupon_model->viewdiscountcoupon();
			$data['redirect']="site/viewdiscountcoupon";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			/*$data['discountcoupon']='viewusers';
			$data['title']='View Users';
			$this->load->view('template',$data);*/
		}
	}
	function deletediscountcoupon()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->discountcoupon_model->deletediscountcoupon($this->input->get('id'));
		$data['table']=$this->discountcoupon_model->viewdiscountcoupon();
		$data['alertsuccess']="discountcoupon Deleted Successfully";
		$data['page']='viewdiscountcoupon';
		$data['title']='View discountcoupon';
		$this->load->view('template',$data);
	}
	function editprice()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->product_model->beforeeditproduct($this->input->get('id'));
		$data['page']='editprice';
		$data['page2']='block/productblock';
		$data['title']='Edit price';
		$this->load->view('template',$data);
	}
	function editpricesubmit()
	{
		$this->form_validation->set_rules('price','price','trim|');
		$this->form_validation->set_rules('wholesaleprice','wholesaleprice','trim|');
		$this->form_validation->set_rules('firstsaleprice','firstsaleprice','trim|');
		$this->form_validation->set_rules('secondsaleprice','secondsaleprice','trim|');
		$this->form_validation->set_rules('specialpricefrom','specialpricefrom','trim|');
		$this->form_validation->set_rules('specialpriceto','specialpriceto','trim|');
		
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['before']=$this->product_model->beforeeditproduct($this->input->post('id'));
			$data['page']='editprice';
			$data['page2']='block/productblock';
			$data['title']='Edit price';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			
			$price=$this->input->post('price');
			$wholesaleprice=$this->input->post('wholesaleprice');
			$firstsaleprice=$this->input->post('firstsaleprice');
			$secondsaleprice=$this->input->post('secondsaleprice');
			$specialpricefrom=$this->input->post('specialpricefrom');
			$specialpriceto=$this->input->post('specialpriceto');
			if($specialpricefrom != "")
				$specialpricefrom = date("Y-m-d",strtotime($specialpricefrom));
			if($specialpriceto != "")
				$specialpriceto = date("Y-m-d",strtotime($specialpriceto));
			$specialpriceto=$this->input->post('specialpriceto');
			
			if($this->product_model->editprice($id,$price,$wholesaleprice,$firstsaleprice,$secondsaleprice,$specialpricefrom,$specialpriceto)==0)
			$data['alerterror']="price Editing was unsuccesful";
			else
			$data['alertsuccess']="price edited Successfully.";
			$data['redirect']="site/editprice?id=".$id;
			//$data['other']="template=$template";
			$this->load->view("redirect2",$data);
		}
	}
	function editrelatedproducts()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->product_model->beforeeditproduct($this->input->get('id'));
		$data['product']=$this->product_model->getproducts($this->input->get('id'));
		$data['page']='relatedproducts';
		$data['page2']='block/productblock';
		$data['title']='Edit Related Products';
		$this->load->view('template',$data);
	}
	function editrelatedproductssubmit()
	{
		$this->form_validation->set_rules('price','price','trim|');
		$this->form_validation->set_rules('wholesaleprice','wholesaleprice','trim|');
		$this->form_validation->set_rules('firstsaleprice','firstsaleprice','trim|');
		$this->form_validation->set_rules('secondsaleprice','secondsaleprice','trim|');
		$this->form_validation->set_rules('specialpricefrom','specialpricefrom','trim|');
		$this->form_validation->set_rules('specialpriceto','specialpriceto','trim|');
		
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['before']=$this->product_model->beforeeditproduct($this->input->post('id'));
			$data['product']=$this->product_model->getproducts($this->input->get('id'));
			$data['page']='relatedproducts';
			$data['page2']='block/productblock';
			$data['title']='Edit Related Products';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			
			$relatedproduct=$this->input->post('relatedproduct');
			
			if($this->product_model->editrelatedproduct($id,$relatedproduct)==0)
			$data['alerterror']="Related Product Editing was unsuccesful";
			else
			$data['alertsuccess']="Related Product edited Successfully.";
			
			$data['redirect']="site/editrelatedproducts?id=".$id;
			//$data['other']="template=$template";
			$this->load->view("redirect2",$data);
		}
	}
	function viewproductwaiting()
	{
		$access = array("1");
		$this->checkaccess($access);
//		$data['before']=$this->product_model->beforeeditproduct($this->input->get('id'));
		$data['table']=$this->product_model->viewproductwaiting();
		$data['page']='viewproductwaiting';
//		$data['page2']='block/productblock';
		$data['title']='Product waiting';
		$this->load->view('template',$data);
	}
    
	//Newsletter
	public function createnewsletteruser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->newsletter_model->getstatusdropdown();
		$data[ 'user' ] =$this->newsletter_model->getuserdropdown();
		$data[ 'page' ] = 'createnewsletteruser';
		$data[ 'title' ] = 'Create newsletter';
		$this->load->view( 'template', $data );	
	}
	public function createnewsletterusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('status','status','trim|');
		
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->newsletter_model->getstatusdropdown();
			$data[ 'user' ] =$this->newsletter_model->getuserdropdown();
			$data[ 'page' ] = 'createnewsletteruser';
			$data[ 'title' ] = 'Create newsletteruser';
			$this->load->view('template',$data);
		}
		else
		{
			$email=$this->input->post('email');
			$user=$this->input->post('user');
			$status=$this->input->post('status');
			if($this->newsletter_model->createnewsletteruser($email,$user,$status)==0)
			$data['alerterror']="New newsletteruser could not be created.";
			else
			$data['alertsuccess']="newsletteruser  created Successfully.";
			$data['redirect']="site/viewnewsletteruser";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
	//Newsletter
	public function editnewsletteruser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->celebcorner_model->beforeeditcelebcorner($this->input->get('id'));
		$data[ 'status' ] =$this->newsletter_model->getstatusdropdown();
		$data[ 'user' ] =$this->newsletter_model->getuserdropdown();
		$data[ 'page' ] = 'editnewsletteruser';
		$data[ 'title' ] = 'Edit newsletter';
		$this->load->view( 'template', $data );	
	}
	//Order
    function createorder()
	{
		$access = array("1");
		$this->checkaccess($access);
		//$data[ 'category' ] =$this->order_model->getcategorydropdown();
		$data[ 'user' ] =$this->order_model->getuser();
		$data[ 'country' ] =$this->user_model->getcountry();
		$data[ 'orderstatus' ] =$this->order_model->getorderstatus();
		$data[ 'currency' ] =$this->currency_model->getcurrencydropdown();
		$data['before']=$this->order_model->beforeedit($this->input->get('id'));
		$data['page']='createorder';
		//$data['page2']='block/orderblock';
		$data['title']='Create order';
		$this->load->view('template',$data);
	}
	function createordersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('orderstatus','orderstatus','trim|');
		$this->form_validation->set_rules('firstname','Firstname','trim|required');
		$this->form_validation->set_rules('lastname','Lastname','trim|required');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('billingaddress','billingaddress','trim');
		$this->form_validation->set_rules('billingcity','billingcity','trim');
		$this->form_validation->set_rules('billingstate','billingstate','trim');
		$this->form_validation->set_rules('billingcountry','billingcountry','trim');
		$this->form_validation->set_rules('shippingaddress','shippingaddress','trim');
		$this->form_validation->set_rules('shippingcity','shippingcity','trim');
		$this->form_validation->set_rules('shippingstate','shippingstate','trim');
		$this->form_validation->set_rules('shippingcountry','shippingcountry','trim');
		$this->form_validation->set_rules('shippingpincode','shippingpincode','trim');
		$this->form_validation->set_rules('currency','currency','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'user' ] =$this->order_model->getuser();
			$data[ 'country' ] =$this->user_model->getcountry();
			$data[ 'orderstatus' ] =$this->order_model->getorderstatus();
			$data[ 'currency' ] =$this->currency_model->getcurrencydropdown();
			$data['before']=$this->order_model->beforeedit($this->input->get('id'));
			$data['page']='createorder';
			$data['page2']='block/orderblock';
			$data['title']='Edit order';
			$this->load->view('template',$data);
		}
		else
		{
			
			$user=$this->input->post('user');
			$firstname=$this->input->post('firstname');
			$lastname=$this->input->post('lastname');
			$email=$this->input->post('email');
			$billingaddress=$this->input->post('billingaddress');
			$billingcity=$this->input->post('billingcity');
			$billingstate=$this->input->post('billingstate');
			$billingcountry=$this->input->post('billingcountry');
			$shippingaddress=$this->input->post('shippingaddress');
			$shippingcity=$this->input->post('shippingcity');
			$shippingstate=$this->input->post('shippingstate');
			$shippingcountry=$this->input->post('shippingcountry');
			$shippingpincode=$this->input->post('shippingpincode');
			$currency=$this->input->post('currency');
			$orderstatus=$this->input->post('orderstatus');
			$trackingcode=$this->input->post('trackingcode');
			if(($this->order_model->createorder($user,$firstname,$lastname,$email,$billingaddress,$billingcity,$billingstate,$billingcountry,$shippingaddress,$shippingcity,$shippingstate,$shippingcountry,$shippingpincode,$currency,$orderstatus,$trackingcode))==0)
				$data['alerterror']="Order could not be Created.";
			else
				$data['alertsuccess']="Order  edited Successfully.";
			$data['redirect']="site/vieworder";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
			
	}
    
    
	function editorder()
	{
		$access = array("1");
		$this->checkaccess($access);
		//$data[ 'category' ] =$this->order_model->getcategorydropdown();
		$data[ 'user' ] =$this->order_model->getuser();
		$data[ 'country' ] =$this->user_model->getcountry();
		$data[ 'orderstatus' ] =$this->order_model->getorderstatus();
		$data[ 'currency' ] =$this->currency_model->getcurrencydropdown();
		$data['before']=$this->order_model->beforeedit($this->input->get('id'));
		$data['page']='editorder';
		$data['page2']='block/orderblock';
		$data['title']='Edit order';
		$this->load->view('template',$data);
	}
	function editordersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('orderstatus','orderstatus','trim|');
		$this->form_validation->set_rules('firstname','Firstname','trim|required');
		$this->form_validation->set_rules('lastname','Lastname','trim|required');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('billingaddress','billingaddress','trim');
		$this->form_validation->set_rules('billingcity','billingcity','trim');
		$this->form_validation->set_rules('billingstate','billingstate','trim');
		$this->form_validation->set_rules('billingcountry','billingcountry','trim');
		$this->form_validation->set_rules('shippingaddress','shippingaddress','trim');
		$this->form_validation->set_rules('shippingcity','shippingcity','trim');
		$this->form_validation->set_rules('shippingstate','shippingstate','trim');
		$this->form_validation->set_rules('shippingcountry','shippingcountry','trim');
		$this->form_validation->set_rules('shippingpincode','shippingpincode','trim');
		$this->form_validation->set_rules('currency','currency','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'user' ] =$this->order_model->getuser();
			$data[ 'country' ] =$this->user_model->getcountry();
			$data[ 'orderstatus' ] =$this->order_model->getorderstatus();
			$data[ 'currency' ] =$this->currency_model->getcurrencydropdown();
			$data['before']=$this->order_model->beforeedit($this->input->get('id'));
			$data['page']='editorder';
			$data['page2']='block/orderblock';
			$data['title']='Edit order';
			$this->load->view('template',$data);
		}
		else
		{
			
			$id=$this->input->post('id');
			$user=$this->input->post('user');
			$firstname=$this->input->post('firstname');
			$lastname=$this->input->post('lastname');
			$email=$this->input->post('email');
			$billingaddress=$this->input->post('billingaddress');
			$billingcity=$this->input->post('billingcity');
			$billingstate=$this->input->post('billingstate');
			$billingcountry=$this->input->post('billingcountry');
			$shippingaddress=$this->input->post('shippingaddress');
			$shippingcity=$this->input->post('shippingcity');
			$shippingstate=$this->input->post('shippingstate');
			$shippingcountry=$this->input->post('shippingcountry');
			$shippingpincode=$this->input->post('shippingpincode');
			$currency=$this->input->post('currency');
			$orderstatus=$this->input->post('orderstatus');
			$trackingcode=$this->input->post('trackingcode');
			if(($this->order_model->edit($id,$user,$firstname,$lastname,$email,$billingaddress,$billingcity,$billingstate,$billingcountry,$shippingaddress,$shippingcity,$shippingstate,$shippingcountry,$shippingpincode,$currency,$orderstatus,$trackingcode))==0)
				$data['alerterror']="Order could not be edited.";
			else
            {
				$data['alertsuccess']="Order  edited Successfully.";
                $query1=$this->order_model->getorderstatus1($orderstatus);
                //echo $state=$query1;
                //$email=$this->input->get('email');
                $this->load->library('email');
                $email=$email;
                $this->email->from('lyla@lylaloves.co.uk', 'Lyla');
                $this->email->to($email);
                $this->email->cc('another@another-example.com');
                $this->email->bcc('them@their-example.com');

                $this->email->subject('Welcome to Lyla');
                $this->email->message('<img src="http://zibacollection.co.uk/lylalovecouk/img/dispatchedbylyla.jpg" width="560px" height="398px"><br><b>YOUR ORDER IS '.$query1->name.'</b>');

                $this->email->send();

            }
			$data['redirect']="site/vieworder";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
			
	}
	function vieworder()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->order_model->vieworder();
		$data['page']='vieworder';
		$data['title']='View order';
		$this->load->view('template',$data);
	}
	function viewpendingorder()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->order_model->viewpendingorder();
		$data['page']='vieworder';
		$data['title']='View Pending order';
		$this->load->view('template',$data);
	}
    function deleteorder()
    {
        $access = array("1");
        $this->checkaccess($access);
        $id=$this->input->get('id');
        $data['table']=$this->order_model->deleteorder($id);
        $data['redirect']="site/vieworder";
        //$data['other']="template=$template";
        $this->load->view("redirect",$data);
    }
	//Order
   
	function newsletter()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->newsletter_model->viewnewsletter();
		$data['page']='viewnewsletter';
		$data['title']='View newsletter';
		$this->load->view('template',$data);
	}
	//newsletter
	function limitedstock()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->newsletter_model->limitedstock();
		$data['page']='limitedstock';
		$data['title']='View Limited Stock Newsletter';
		$this->load->view('template',$data);
	}
	function viewcontact()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->newsletter_model->viewcontact();
		$data['page']='viewcontact';
		$data['title']='View Contact';
		$this->load->view('template',$data);
	}
   
    public function createorderitems()
	{
		$access = array("1");
		$this->checkaccess($access);
        $id=$this->input->get('id');
		$data['order']=$this->order_model->getorderitem($this->input->get('id'));
		$data['before']=$this->order_model->beforeedit($this->input->get('id'));
		$data[ 'product' ] =$this->product_model->getproductdropdown();
		$data[ 'category' ] =$this->category_model->getcategorydropdown();
		$data[ 'page' ] = 'createorderitem';
		$data['page2']='block/orderblock';
		$data[ 'title' ] = 'Create Orderitem';
		$this->load->view( 'template', $data );	
	}
    function createorderitemsubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('product','Product','trim|');
		$this->form_validation->set_rules('price','Price','trim|required');
		$this->form_validation->set_rules('quantity','Lastname','trim|required');
		$this->form_validation->set_rules('discount','Discount','trim|required');
		$this->form_validation->set_rules('finalprice','Finalprice','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
        $id=$this->input->get('id');
		$data['order']=$this->order_model->getorderitem();
		$data['before']=$this->order_model->beforeedit($this->input->get('id'));
		$data[ 'product' ] =$this->product_model->getproductdropdown();
		$data[ 'category' ] =$this->category_model->getcategorydropdown();
			$data['page']='createorderitems';
			$data['page2']='block/orderblock';
			$data['title']='Create order';
			$this->load->view('template',$data);
		}
		else
		{
			
			$order=$this->input->get_post('id');
			$product=$this->input->post('product');
			$price=$this->input->post('price');
			$quantity=$this->input->post('quantity');
			$discount=$this->input->post('discount');
			$finalprice=$this->input->post('finalprice');
			
			if(($this->order_model->createorderitems($order,$product,$price,$quantity,$discount,$finalprice))==0)
				$data['alerterror']="Orderitem could not be Created.";
			else
				$data['alertsuccess']="Orderitem  edited Successfully.";
			$data['redirect']="site/editorderitems";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
			
	}
    
    
	function printorderinvoice()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'category' ] =$this->category_model->getcategorydropdown();
		$data[ 'table' ] =$this->order_model->getorderitem($this->input->get('id'));
		$data['before']=$this->order_model->beforeedit($this->input->get('id'));
        $data['id']=$this->input->get('id');
		$data['page']='orderinvoice';
		$this->load->view('templateinvoice',$data);
	}
    
	function printorderlabel()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'category' ] =$this->category_model->getcategorydropdown();
		$data[ 'table' ] =$this->order_model->getorderitem($this->input->get('id'));
		$data['before']=$this->order_model->beforeedit($this->input->get('id'));
        $data['id']=$this->input->get('id');
		$data['page']='templatelabel';
		$data['title']='Edit order items';
		$this->load->view('templatelabel',$data);
	}
    
	function editorderitems()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'category' ] =$this->category_model->getcategorydropdown();
		$data[ 'table' ] =$this->order_model->getorderitem($this->input->get('id'));
		$data['before']=$this->order_model->beforeedit($this->input->get('id'));
        $data['id']=$this->input->get('id');
		$data['page']='editorderitems';
		$data['page2']='block/orderblock';
		$data['title']='Edit order items';
		$this->load->view('template',$data);
	}
	function editorderitem()
	{
		$access = array("1");
		$this->checkaccess($access);
        $id=$this->input->get('id');
		$data['order']=$this->order_model->getorderitem();
		$data['before']=$this->order_model->beforeedititem($this->input->get('id'));
		$data[ 'product' ] =$this->product_model->getproductdropdown();
		$data[ 'category' ] =$this->category_model->getcategorydropdown();
		$data[ 'table' ] =$this->order_model->getorderitem();
		$data['page']='editorderitem';
		$data['page2']='block/orderblock';
		$data['title']='Edit order item';
		$this->load->view('template',$data);
	}
    function editorderitemsubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('product','Product','trim|');
		$this->form_validation->set_rules('price','Price','trim|required');
		$this->form_validation->set_rules('quantity','Lastname','trim|required');
		$this->form_validation->set_rules('discount','Discount','trim|required');
		$this->form_validation->set_rules('finalprice','Finalprice','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
        $id=$this->input->get('id');
		$data['order']=$this->order_model->getorderitem();
		$data['before']=$this->order_model->beforeedititem($this->input->get('id'));
		$data[ 'product' ] =$this->product_model->getproductdropdown();
		$data[ 'category' ] =$this->category_model->getcategorydropdown();
		$data[ 'table' ] =$this->order_model->getorderitem();
		$data['page']='editorderitems';
		$data['page2']='block/orderblock';
		$data['title']='Edit order item';
		$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->get_post('id');
			//$order=$this->input->get_post('id');
			$product=$this->input->post('product');
			$order=$this->input->get_post('order');
			$price=$this->input->post('price');
			$quantity=$this->input->post('quantity');
			$discount=$this->input->post('discount');
			$finalprice=$this->input->post('finalprice');
            //echo $order;
			
			if(($this->order_model->updateorderitem($id,$order,$product,$price,$quantity,$discount,$finalprice))==0)
				$data['alerterror']="Orderitem could not be Updated.";
			else
				$data['alertsuccess']="Orderitem  edited Successfully.";
			$data['redirect']="site/editorderitems?id=".$order;
			$data['order']="id=$order";
			$this->load->view("redirect",$data);
		}
			
	}
    
    
	function getproductbycategory()
	{
		$category = $this->input->get_post('category');
		$data['message']=$this->order_model->getproductbycategory($category);
		$this->load->view('json',$data);
	}
	function getproductdetails()
	{
		$category = $this->input->get_post('category');
		$product = $this->input->get_post('product');
		$data['message']=$this->order_model->getproductdetails($category,$product);
		$this->load->view('json',$data);
	}
    function deleteorderitem()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->order_model->deleteorderitem($this->input->get('id'));
		$data[ 'table' ] =$this->order_model->getorderitem();
		$data['alertsuccess']="Orderitem Deleted Successfully";
		$data['page']='editorderitems';
		$data['page2']='block/orderblock';
		$data['title']='Edit orderitems';
		$this->load->view('template',$data);
	}
    
    //Pick Of Weak
    
	function viewpickofweak()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['table']=$this->pickofweak_model->viewpickofweak();
		$data['page']='viewpickofweak';
		$data['title']='View pickofweak';
		$this->load->view('template',$data);
	}
    
	public function createpickofweak()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['order']=$this->order_model->getorderdropdown();
		$data[ 'page' ] = 'createpickofweak';
		$data[ 'title' ] = 'Create pickofweak';
		$this->load->view( 'template', $data );	
	}
    
	function createpickofweaksubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('order','Order','trim|required');
		
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
            $data['order']=$this->order_model->getorderdropdown();
			$data[ 'page' ] = 'createpickofweak';
			$data[ 'title' ] = 'Create pickofweak';
			$this->load->view('template',$data);
		}
		else
		{
			$order=$this->input->post('order');
			
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
			}
			
			if($this->pickofweak_model->createpickofweak($order,$image)==0)
			$data['alerterror']="New pickofweak could not be created.";
			else
			$data['alertsuccess']="pickofweak  created Successfully.";
			$data['table']=$this->pickofweak_model->viewpickofweak();
			$data['redirect']="site/viewpickofweak";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
		}
	}
    
    
	function editpickofweak()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->pickofweak_model->beforeeditpickofweak($this->input->get('id'));
        $data['order']=$this->order_model->getorderdropdown();
		$data['page']='editpickofweak';
		$data['title']='Edit pickofweak';
		$this->load->view('template',$data);
	}
	function editpickofweaksubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('order','order','trim|required');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
            $data['before']=$this->pickofweak_model->beforeeditpickofweak($this->input->get('id'));
            $data['order']=$this->order_model->getorderdropdown();
			$data['page']='editpickofweak';
			$data['title']='Edit pickofweak';
			$this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$order=$this->input->post('order');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
			}
			
			if($this->pickofweak_model->editpickofweak($id,$order,$image)==0)
			$data['alerterror']="pickofweak Editing was unsuccesful";
			else
			$data['alertsuccess']="pickofweak edited Successfully.";
			$data['table']=$this->pickofweak_model->viewpickofweak();
			$data['redirect']="site/viewpickofweak";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			/*$data['page']='viewusers';
			$data['title']='View Users';
			$this->load->view('template',$data);*/
		}
	}
    
	function deletepickofweak()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->pickofweak_model->deletepickofweak($this->input->get('id'));
		$data['table']=$this->pickofweak_model->viewpickofweak();
		$data['alertsuccess']="pickofweak Deleted Successfully";
		$data['page']='viewpickofweak';
		$data['title']='View pickofweak';
		$this->load->view('template',$data);
	}
    
    
	function editproductwaiting()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['before']=$this->product_model->beforeeditproductwaiting($this->input->get('id'));
		$data['product']=$this->product_model->getproductdropdown();
		$data[ 'user' ] =$this->newsletter_model->getuserdropdownproductwaiting();
		$data['page']='editproductwaiting';
		$data['title']='Edit product Waiting';
		$this->load->view('template',$data);
	}
    
	function editproductwaitingsubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('email','Email','trim|valid_email');
		$this->form_validation->set_rules('product','product','trim');
		$this->form_validation->set_rules('user','user','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['before']=$this->product_model->beforeeditproductwaiting($this->input->get('id'));
            $data['product']=$this->product_model->getproductdropdown();
            $data[ 'user' ] =$this->newsletter_model->getuserdropdownproductwaiting();
            $data['page']='editproductwaiting';
            $data['title']='Edit product Waiting';
            $this->load->view('template',$data);
		}
		else
		{
			$id=$this->input->post('id');
			$email=$this->input->post('email');
			$product=$this->input->post('product');
			$user=$this->input->post('user');
//			print_r($_POST);
			if($this->product_model->editproductwaiting($id,$product,$user,$email)==0)
			$data['alerterror']="Product Waiting Editing was unsuccesful";
			else
			$data['alertsuccess']="productwaiting edited Successfully.";
			$data['table']=$this->product_model->viewproductwaiting();
            $data['page']='viewproductwaiting';
    //		$data['page2']='block/productblock';
            $data['title']='Product waiting';
            $this->load->view('template',$data);
		}
	}
    
	function deleteproductwaiting()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->product_model->deleteproductwaiting($this->input->get('id'));
		$data['alertsuccess']="Product Waiting Deleted Successfully";
		$data['table']=$this->product_model->viewproductwaiting();
        $data['page']='viewproductwaiting';
//		$data['page2']='block/productblock';
        $data['title']='Product waiting';
        $this->load->view('template',$data);
	}
    //csv
    
    	public function exportusercsv()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->exportusercsv();
            
        $data['table']=$this->user_model->viewusers();
		$data['page']='viewusers';
		$data['title']='View Users';
		$this->load->view('template',$data);
	}
    	public function exportnewslettercsv()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->newsletter_model->exportnewslettercsv();
         
	}
    	public function exportordercsv()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->order_model->exportordercsv();
         
	}
    	public function exportorderitemcsv()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->order_model->exportorderitemcsv();
         
	}
    	public function exportproductcsv()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->product_model->exportproductcsv();
        $data['redirect']="site/viewproduct";
        $this->load->view("redirect",$data);
	}
    
    function uploadproductcsv()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'page' ] = 'uploadproductcsv';
		$data[ 'title' ] = 'Upload product';
		$this->load->view( 'template', $data );
	} 
    
    function uploadproductcsvsubmit()
	{
        $access = array("1");
		$this->checkaccess($access);
        
//        $config['upload_path'] = './uploads/';
//        $config['allowed_types'] = '*';
//        $this->load->library('upload', $config);
//        $filename="file";
//        $file="";
//        if (  $this->upload->do_upload($filename))
//        {
//            $uploaddata = $this->upload->data();
//            $file=$uploaddata['file_name'];
//            $filepath=$uploaddata['file_path'];
//        }
//        $fullfilepath=$filepath."".$file;
        //"http://storage.googleapis.com/lylalovescsv/product.csv"
        
		$this->form_validation->set_rules('url','url','trim');
        $path=$this->input->get_post('url');
//        $fullfilepath=file_get_contents($path); 
        $file = $this->csvreader->parse_file($path);
//        print_r($file);
        
//        $file = $this->csvreader->parse_file($fullfilepath);
        $id1=$this->product_model->createbycsv($file);
//        echo $id1;
        if($id1==0)
        $data['alerterror']="New products could not be Uploaded.";
		else
		$data['alertsuccess']="products Uploaded Successfully.";
        
        $data['redirect']="site/viewproduct";
        $this->load->view("redirect",$data);
    }
   
}
?>