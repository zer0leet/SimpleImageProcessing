<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/header');?>

<h3>Your file was successfully uploaded!</h3>


<p><?php echo anchor('imgprocess', 'Upload Another File!'); ?></p>
<form action="<?= base_url("imgprocess/process")?>" method="POST">
<button type="submit" class="btn btn-primary max-width">Submit!</button>
<?php
$this->load->view('templates/footer');
?>