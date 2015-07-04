<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn())
  {
   Redirect::to('index.php');
  }

if(Input::exists())
	 {
	 	if(Token::check(Input::get('token')))
	 		 {
	 		 	echo 'OK';
	 		 	$validate = new Validate();
	 		 	$validation = $validate->check($_POST, array(
                     'name' => array(
                        'required' => true,
                        'min' => 2,
                        'max' => 50  
                     	) 
	 		 		));
	 		 	if($validation->passed())
	 		 		 {
	 		 		 	try
	 		 		 	 {
                           $user->update(array(
                             'name' => Input::get('name')
                           	));
                          Session::flash('home', 'Your details have been updated');
                          Redirect::to('index.php');
                          
	 		 		 	 } catch(Exception $e)
	 		 		 	   {
	 		 		 	   	die($e->getMessage());
	 		 		 	   }
	 		 		 }else
	 		 		  {
	 		 		  	foreach($validation->errors() as $error)
	 		 		  	{
	 		 		  		echo $error, '<br>';
	 		 		  	}
	 		 		  }
	 		 }
	 }


?>

<form action="" method="post">
  <div class="field">
	<label for="name">Name</label>
	<input type="text" name="name">
  </div>

  <div class="field">
    <label for="password_new">New password</label>
    <input type="password" name="password_new" id="password_new">
  </div>

  <div class="field">
   <label for="password_new_again">New Password Again</label>
   <input type="password" name="password_new_again" id="password_new_again">
  </div>

  <input type="submit" value="Change">
  <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

</form>