function vote1(updElemId) {
document.getElementById('vote_id_one').value = document.getElementById(updElemId+'-vote').value;
            $.ajax({
            type:'GET',
            cache:false,
            dataType:'html',
            url:$('#ajaxForm_one').attr('action'),
            data:$('#ajaxForm_one').serializeArray(),
            success:function (data) {
			//data = data.split('-');
			document.getElementById(updElemId+'vote_total_one_id').value ++;
			document.getElementById(updElemId+'vote_knopka_plus').disabled = true;
			document.getElementById(updElemId+'vote_knopka_minus').disabled = true;
            }
        });

  document.getElementById("ajaxSubmit_one").click();

  };



function vote2(updElemId) {
document.getElementById('vote_id_two').value = document.getElementById(updElemId+'-vote').value;
            $.ajax({
            type:'GET',
            cache:false,
            dataType:'html',
            url:$('#ajaxForm_two').attr('action'),
            data:$('#ajaxForm_two').serializeArray(),
            success:function (data) {
			document.getElementById(updElemId+'vote_total_two_id').value ++;
			document.getElementById(updElemId+'vote_knopka_plus').disabled = true;
			document.getElementById(updElemId+'vote_knopka_minus').disabled = true;
            }
        });
		
		  document.getElementByClassName("ajaxSubmit_two").click();
    };