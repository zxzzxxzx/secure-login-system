<?php
require_once 'core/init.php';

if(!$username = Input::get('user'))
  {
    Redirect::to('index.php');
  }else{
$user = new User();
    if(!$user->exists())
        {
         Redirect::to(404);
        }else
           {
              if(Token::check(Input::get('token')))
               {
                 $data = $user->data();
                 echo escape($data->username);
                 echo escape($data->name);
      
                }else 

                 {
                    echo 'No data';
                 }
            
           }
    }
            ?>
      
    <?php

  
  ?>

<form action="" method="post">
  <div class="field">

  <input type="submit" value="Change">
  <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</div>
</form>