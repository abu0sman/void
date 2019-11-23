$("form#data").submit(function(e) {
    var progressBar = $('#progress_bar');
	e.preventDefault();    
    var formData = new FormData(this);
      $.ajax({
        url: '../shop_note/backend.php?uploadfiles',
        type: 'POST',
        data: formData,
        success: function (data) {
            alert(data)
        },
        cache: false,
        contentType: false,
        processData: false,
		success: function( respond, textStatus, jqXHR ){
			// Если все ОК
			if( typeof respond.error === 'undefined' ){
				// Файлы успешно загружены, делаем что нибудь здесь
				$("#d_add_note").modal("hide");
				//Перегружаем станицу
				/* $.ajax({
					url: "../shop_note/shop_note_current.php",
					//data: {actual_order: actual_order},
					type: "POST",
					cache: false,
					success: function(res) {
						$('#shop_note_current').html(res);
					}
				}); */
				
				// выведем пути к загруженным файлам в блок '.ajax-respond'
				var files_path = respond.files;
				var html = '';
				
				$.each( files_path, function( key, val ){ html += val +'<br>'; } )
				$('.ajax-respond').html( html );
			}
			else{
				console.log('ОШИБКИ ОТВЕТА сервера: ' + respond.error );
			}
		}, 
		error: function( jqXHR, textStatus, errorThrown ){
			console.log('ОШИБКИ AJAX запроса: ' + textStatus );
		},
		xhr: function(){
			var xhr = $.ajaxSettings.xhr(); // получаем объект XMLHttpRequest
			xhr.upload.addEventListener('progress', function(evt){ // добавляем обработчик события progress (onprogress)
				if (evt.lengthComputable) { // если известно количество байт
				// высчитываем процент загруженного
					var percentComplete = Math.ceil(evt.loaded / evt.total * 100);
					// устанавливаем значение в атрибут value тега progress
					// и это же значение альтернативным текстом для браузеров, не поддерживающих &lt;progress&gt;
					progressBar.val(percentComplete).text('Загружено ' + percentComplete + '%');
				}
			}, false);
			return xhr;
		}
    });	
});