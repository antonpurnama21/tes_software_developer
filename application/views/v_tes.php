<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Tes</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css'?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/jquery.dataTables.css'?>">
</head>
<body>
<div class="container">
	<!-- Page Heading -->
        <div class="row">
            <h1 class="page-header">Data
                <small>Tes</small>
				
				<div class="pull-right"><button class="btn btn-sm btn-primary" id="btn-reload">Reload</button></div>
            </h1>
        </div>

    <?php 
      $data = $this->session->flashdata('sukses');
      if($data!=""){ ?>
        <div id="notifikasi" class="alert alert-success"><strong>Sukses ! </strong> <?=$data;?></div>
    <?php } ?>
	<div class="row">
		<div id="reload">
		<form method="POST" action="<?=base_url() ?>index.php/tes/save_data">
		<div style="margin-bottom: 5px;"  class="pull-right"><button type="submit" class="btn btn-sm btn-success">Simpan</button></div>
		<table class="table table-striped" id="mydata">
			<thead>
				<tr>
					<th>date</th>
                    <th>label</th>
                    <th>nb_visits</th>
                    <th>nb_hits</th>
                    <th>sum_time_spent</th>
                    <th>nb_hits_with_time_generation</th>
                    <th>sum_daily_exit_nb_uniq_visitors</th>
				</tr>
			</thead>
			<tbody id="show_data">
				
			</tbody>
		</table>
		</form>
		</div>
	</div>
</div>

<form style="display: none;" id="form-simpan">
	<input type="" name="" value="">
</form>

<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.dataTables.js'?>"></script>
<script type="text/javascript">
	$(document).ready(function(){
		tampil_data();
		
		$('#mydata').dataTable();
		 
		//fungsi tampil
		function tampil_data(){
		    $.ajax({
		        type  : 'ajax',
		        url   : '<?php echo base_url()?>index.php/tes/get',
		        async : false,
		        dataType : 'json',
		        success : function(data){
		        	//console.log(data.item);
		        	let menu = data;
		        	let html = '';
					$.each(menu, function (i, data) {
						//console.log(data.length)
						if (data.length == 0) {
							html += '<tr>'+
		            	   		'<td>'+i+'<input type="hidden" value="'+i+'" name="date[]"></td>'+
		                        '<td>'+null+'<input type="hidden" value="'+null+'" name="label[]"></td>'+
		                        '<td>'+null+'<input type="hidden" value="'+null+'" name="visit[]"></td>'+
              		            '<td>'+null+'<input type="hidden" value="'+null+'" name="hits[]"></td>'+
              		            '<td>'+null+'<input type="hidden" value="'+null+'" name="spent[]"></td>'+
              		            '<td>'+null+'<input type="hidden" value="'+null+'" name="gen[]"></td>'+
              		            '<td>'+null+'<input type="hidden" value="'+null+'" name="uniq[]"></td>'+
		                        '</tr>';
						}else{
							html += '<tr>'+
		            	   		'<td>'+i+'<input type="hidden" value="'+i+'" name="date[]"></td>'+
		                        '<td>'+data[0].label+'<input type="hidden" value="'+data[0].label+'" name="label[]"></td></td>'+
		                        '<td>'+data[0].nb_visits+'<input type="hidden" value="'+data[0].nb_visits+'" name="visit[]"></td>'+
              		            '<td>'+data[0].nb_hits+'<input type="hidden" value="'+data[0].nb_hits+'" name="hits[]"></td>'+
              		            '<td>'+data[0].sum_time_spent+'<input type="hidden" value="'+data[0].sum_time_spent+'" name="spent[]"></td>'+
              		            '<td>'+data[0].nb_hits_with_time_generation+'<input type="hidden" value="'+data[0].nb_hits_with_time_generation+'" name="gen[]"></td>'+
              		            '<td>'+data[0].sum_daily_exit_nb_uniq_visitors+'<input type="hidden" value="'+data[0].sum_daily_exit_nb_uniq_visitors+'" name="uniq[]"></td>'+
		                        '</tr>';
						}

					});

		            $('#show_data').html(html);
		        }

		    });
		}

		$('#btn-reload').on('click',function(){
            tampil_data();
        });

        //Simpan Barang
		$('#btn-simpan').on('click',function(){
            
        });

	});

</script>
</body>
	<script>   
        $('#notifikasi').slideDown('slow').delay(4000).slideUp('slow');
    </script>
</html>