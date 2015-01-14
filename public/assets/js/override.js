
		function loadingIcon(id){
			$(id).html('<p class="loading-icon">Loading.. <i class="ajax-loader">&nbsp;&nbsp;&nbsp;&nbsp;</i>');
		}

		function xhrSubmitButton(id,xurl,formid){
			$.ajax({
				beforeSend :function(){loadingIcon("#myModal")},
				success :function(result){$('#myModal').html(result)},
				type:'POST',
				url: xurl,
				data: $(formid).serialize(),
			});
			return false;
		}

		function newXhrSubmit(obj,formid){
			$.ajax({
				beforeSend :function(){loadingIcon("#myModal")},
				success :function(result){$('#myModal').html(result)},
				type:'POST',
				url: $(obj).attr('u-url'),
				data: $(formid).serialize(),
			});
			return false;
		}

		function oAjaxLink(xobj,activateModal){
			$.ajax({
				beforeSend : function(){if(activateModal == true){$('#myModal').modal();}loadingIcon("#myModal")},
				success : function(result){$('#myModal').html(result)},
				url:$(xobj).attr('u-url'),
				type: 'GET',
			});
			return false;
		}