<script src="http://localhost/cdn/jquery/jquery.min.js"></script>
    <script src="http://localhost/cdn/jquery/jquery.autocomplete.min.js"></script>
    <script>
						$(function () {
        $("#lokasi").autocomplete({    //id kode sebagai key autocomplete yang akan dibawa ke source url
            minLength:0,
            delay:0,
            source:'<?php echo site_url('health/findlocation'); ?>',   //nama source kita ambil langsung memangil fungsi get_allkota
				select:function(event, ui){
					$('#lokasi').val("Blah");
				//$('#nama').val(ui.item.nama);
				//$('#ibukota').val(ui.item.ibukota);
				//$('#ket').val(ui.item.keterangan);
				}
				});
				});

    </script>
    <style type="text/css">
		.autocomplete-suggestions {
			border: 1px solid #999;
			background: #fff;
			cursor: default;
			overflow: auto;
		}
		.autocomplete-suggestion {
			padding: 10px 5px;
			font-size: 1.2em;
			white-space: nowrap;
			overflow: hidden;
		}
		.autocomplete-selected {
			background: #f0f0f0;
		}
		.autocomplete-suggestions strong {
			font-weight: normal;
			color: #3399ff;
		}
    </style>
    <input type="text" id="lokasi">
