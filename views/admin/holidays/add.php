<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>
<?php  
	
?>
<?php vendor_html_helper::contentheader('Quản lý ngày kỷ niệm', [
    [
      'title' =>  'Index Holidays',
      'urlp'=>['ctl'=>$app['ctl']]
    ],
    ['urlp'  =>  ['ctl'=>$app['ctl'], 'act'=>$app['act']]]
]); ?>

<section class="content">
	<?php 
		include_once 'views/admin/holidays/_form.php';
	?>

</section>


  <!-- /.box -->
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>