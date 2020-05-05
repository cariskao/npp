<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   <h2>Sent Email Using SMTP</h2><br>


   <?php if ($error = $this->session->flashdata('msg')) {?>
   <p style="color: green;"><strong>Success!</strong> <?php echo $error; ?><p>
         <?php }?>


         <form action="<?php echo base_url(); ?>fend/email_send/send" method="post">
            <input type="email" name="from" class="form-control" placeholder="Enter Email" required><br>
            <textarea name="message" class="form-control" placeholder="Enter message here" required></textarea><br>
            <button type="submit" class="btn btn-primary">Send Message</button>
         </form>
</body>

</html>