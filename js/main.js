$(function(){
	$(".start").on('click',function(){
		arr = $('form').serializeArray();
		if(arr[0].value == '' || arr[1].value == -1){
			$(".jaut_error").show();
			return false;
		}else{
			$(".jaut_error").hide();
		}
	});
	$("body").on('click','.test_form .btn-info',function(e){
		e.preventDefault();
		$(".test_form .btn-info").removeClass("btn-dark");
		$(this).addClass('btn-dark');
		$(".jaut_error").hide();
	});
	$(".check_jaut").on('click',function(){
		if($(".test_form .btn-dark").length == 0){
			$(".jaut_error").show();
		}else{
			$(".jaut_error").hide();
			update($(".test_form .btn-dark").attr("value"));
			$.post('ajax.php',{ action: 'update_current'});
			generate();
		}
		return false;
	});
	function update(answer){
		$.post('ajax.php',{action: 'update', answer: answer});
	}
	function counter(){
		$.post('ajax.php',{action: 'get_count'},function(data){
			var data = JSON.parse(data);
			var total = 100/data[0];
			var count = Math.ceil(total)*data[1];
			$(".progress-bar").css("width",count+"%");
			$(".progress-bar").text(count+"%");
		});
	}
	function generate(){
		var i = 0;
		$.post('ajax.php',{ action: 'get_current_answ'},function(data){
			$(".magick").html("");
			try {
				data = JSON.parse(data);
			}catch(e){
				window.location.href="results.php";
				return false;
			}
			$.each(data,function(index,value){
				if(i % 2 == 0){
					$(".magick").append("<div class='form-row'></div>");
				}
				$(".form-row").last().append("<div class='col-sm'><buton class='btn btn-primary btn-info' value='"+value.status+"'>"+value.answer+"</button></div>");
				i++;
			});
		});
		$.post('ajax.php',{ action: 'get_current_q'},function(data){
			try {
				data = JSON.parse(data);
			}catch(e){
				window.location.href="results.php";
				return false;
			}
			$(".question").html("");
			$(".question").text(data[0].question);
		});
		counter();
	}
	if($(".magick").length != 0){
		generate();
		counter();
	}
})