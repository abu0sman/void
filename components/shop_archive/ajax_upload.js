$("form#data").submit(function(e) {
    var progressBar = $('#progress_bar');
	e.preventDefault();    
    var formData = new FormData(this);
      $.ajax({
        url: '../shop_archive/backend.php?uploadfiles',
        type: 'POST',
        data: formData,
        success: function (data) {
            alert(data)
        },
        cache: false,
        contentType: false,
        processData: false,
		success: function( respond, textStatus, jqXHR ){
			// ���� ��� ��
			if( typeof respond.error === 'undefined' ){
				// ����� ������� ���������, ������ ��� ������ �����
				$("#d_add_order").modal("hide");
				// ������� ���� � ����������� ������ � ���� '.ajax-respond'
				var files_path = respond.files;
				var html = '';
				
				$.each( files_path, function( key, val ){ html += val +'<br>'; } )
				$('.ajax-respond').html( html );
			}
			else{
				console.log('������ ������ �������: ' + respond.error );
			}
		}, 
		error: function( jqXHR, textStatus, errorThrown ){
			console.log('������ AJAX �������: ' + textStatus );
		},
		xhr: function(){
			var xhr = $.ajaxSettings.xhr(); // �������� ������ XMLHttpRequest
			xhr.upload.addEventListener('progress', function(evt){ // ��������� ���������� ������� progress (onprogress)
				if (evt.lengthComputable) { // ���� �������� ���������� ����
				// ����������� ������� ������������
					var percentComplete = Math.ceil(evt.loaded / evt.total * 100);
					// ������������� �������� � ������� value ���� progress
					// � ��� �� �������� �������������� ������� ��� ���������, �� �������������� &lt;progress&gt;
					progressBar.val(percentComplete).text('��������� ' + percentComplete + '%');
				}
			}, false);
			return xhr;
		}
    });
	
	
	//var act_shop_page = $("#page_id").val();
	//var find_string = $('#find_area').val();
	/* alert(find_string); */
	$.ajax({
		url: "../shop_archive/shop_archive_current.php",
		data: {page_id: act_shop_page, find_string: find_string},
		/* data: {page_id: act_shop_page}, */
		type: "POST",
		cache: false,
		success: function(res) {
			$('#shop_archive_current').html(res);
		}
	});
	
});
