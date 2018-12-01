function WannaDel(){
	var del = confirm('Bạn có thực sự muốn xóa?');
	if(del){
		return true;
	}else{
		return false;
	}
}

//Thêm dữ liệu vào mảng
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function($) {
	

	//Xử lý phần thêm dữ liệu vào div right
	$("#xong").click(function() {	
		var contentInput = $(".form_text textarea").val();
		var contentH3 = $(".learn_area h3").text();
		var eid = $("#eid").attr('value');
		$.ajax({
			url: url,
			method: 'POST',
			data: {content: contentInput, no:contentH3, eid : eid},
		})
	});


	//Insert data vào database
	$("#xong").click(function(){
		var listSen = [];
		var eid = $("#eid").val();
		var mount = $(".amount").text() ;
		contentH3 = $(".learn_area h3").text();
		contentInput = $(".form_text textarea").val();
		var stop = [5,10,20,30,40,50,60,70,80,90,100];
		listSen[contentH3] = contentInput;	
		$(".newSen").append(contentH3 + ". " + contentInput+"<br>");		 
		contentH3++;
		mount++;
		$(".learn_area h3").text(contentH3);
		$(".form_text textarea").val("");
		$(".amount").text(mount);

		for(var i = 0 ; i<stop.length; i++){
			if(mount == stop[i]){
				var stopOrNo = alert("Bạn đã thêm được " + stop[i] + " câu rồi.");
			}
		} 	

		$(".check").css('display','block');
	});


	//Xử lý thêm thể loại tai view add film

	$("#addKind").click(function(event) {
		event.preventDefault();
		$(".no_show").css('display','none');
		$(".div_add_kind").slideToggle('slow');
	});

	$("#selectOption").change(function(event) {
		var seOp = $(this).val();
		if(seOp != 0){
			$(".no_show").slideDown('slow');
		}else{
			$(".no_show").css('display','none');
			alert("Bạn vui lòng chọn một thể loại");
		}
	});

	$("#xong_add_kind").click(function(event) {
		var nameKind = $('#text_name_kind').val();
		if(nameKind != ""){
			$.ajax({
				url: url,
				method: 'POST',
				data: {nameKind: nameKind},
			})
			.done(function(){
				window.location="http://localhost/learnByMovie1.1/lbm_admin/film/addfilm";
			});
		}else{
			alert("Bạn hãy nhập tên thể loại muốn thêm vào");
		}
	});

	$("#icon-hamburger .glyphicon-menu-hamburger").click(function(event){
		$("#middle-check").slideToggle('slow');
	});

	//Sửa bản Engish gốc
	$("#editEnFile").click(function(event){
		event.preventDefault();
		$(".editEn").slideToggle("slow");
	});

	// Nhấn vào đúng
	$(".action #right").click(function(event) {
		event.preventDefault();
		$(this).css('border-bottom','1px solid red');
		$(this).closest('li').find('#enterEnRight').fadeOut('slow');
		$(this).closest('.action').find('#doneEnterEn').fadeOut('slow');
		$(this).closest('.action').find('#wrong').css('border-bottom','none');
		$(this).closest('li').find('#enterVi').css('display','block');
	});

	//Nhấn vào sai
	$(".action #wrong").click(function(event) {
		event.preventDefault();
		$(this).css('border-bottom','1px solid red');
		$(this).closest(".action").find("#right").css('border-bottom','none');
		$(this).closest('li').find('#enterEnRight').fadeIn('slow');
		$(this).closest('li').find('#enterVi').fadeOut('slow');
		$(this).closest('li').find('#doneCheck').fadeOut('slow');
	});

	//Gõ chữ vào input sửa câu English
	$(".textEnter #enterEnRight").keyup(function(event) {
		$(this).closest('li').find('#doneEnterEn').css('display','block');
	});

	// Chỉnh sửa trong phần check 
	$(".action #edit").click(function(event) {
		event.preventDefault();
		$(this).closest('li').find('#edit').css('display','none');
		$(this).closest('li').find('#right').css('display','block');
		$(this).closest('li').find('#wrong').css('display','block');
	});

	//Xử lý dữ liệu khi nhấn vào nút nhập xong câu Enghlish
	$(".action #doneEnterEn").click(function(event) {
		event.preventDefault();
		var EnRight = $(this).closest('li').find('#enterEnRight').val();
		var numOrderWrong = $(this).closest('li').find('#numOrder').text();
		var eid = $(this).closest('li').find('#eid').val();
		$(this).closest('li').find('#enRight').text("");
		$(this).closest('li').find('#enRight').text(EnRight);
		$(this).closest('li').find('#enterEnRight').fadeOut('slow');
		$(this).closest('.action').find('#doneEnterEn').fadeOut('slow');
		$(this).closest('.action').find('#wrong').css('border-bottom','none');
		$(this).closest('.action').find('#right').css('border-bottom','1px solid red');
		$(this).closest('li').find('#enterVi').css('display','block');
		$.ajax({
			url: wrong,
			method: 'POST',
			data: {eid:eid, numOrderWrong:numOrderWrong},
		});
		
	});

	//Gõ chữ vào input nhập câu tiếng Việt
	$('.textEnter #enterVi').keyup(function(event) {
		$(this).closest('li').find('#doneCheck').css('display','block');
	});

	//Duyệt
	$('.action #doneCheck').click(function(event) {
		event.preventDefault();
		var numOrder= $(this).closest('li').find('#numOrder').text();
		var en = $(this).closest('li').find('#enRight').text();
		var vi = $(this).closest('li').find('#enterVi').val();
		var eid = $(this).closest('li').find('#eid').val();
		$.ajax({
			url: url,
			method: 'POST',
			data: {numOrder:numOrder, en:en, vi:vi, eid:eid},
		});
		$(this).closest('li').find('#enterVi').fadeOut('slow');
		$(this).closest('li').find('#doneCheck').fadeOut('slow');
		$(this).closest('li').find('#viet').text(vi).fadeIn('slow');
		$(this).closest('li').find('#right').css('display','none');
		$(this).closest('li').find('#wrong').css('display','none');
		$(this).closest('li').find('#edit').css('display','block');
	});

	//Hiển thị nút xong nhập tiếng anh trong chức năng wrong
	$('#practiceEN').keyup(function(event) {
		event.preventDefault();
		$(".action #okWrong").css('display','block');
	});

	//Hiển thị video theo từng tập phim
	$('#openVideo').click(function(event) {
		event.preventDefault();
		var eid = $('#openVideo').attr('class');
		window.open('lbm_admin/sentence/videoPage/'+eid,"","width=700,height=500");
	});

	//edit sentence
	$('table tr td #editSen').click(function(event) {
		event.preventDefault();
		$(this).closest('tr').find('.editSen').slideToggle('slow');
	});

	$('.editSen .XongEditSen').click(function(event) {
		event.preventDefault();
		var eid = $('#eid').val();
		var mid = $('#eid').attr('class');
		var numOrder = $(this).closest('tr').find('#numOrder').text();
		var en = $(this).closest('tr').find('.txten').val();
		var vi = $(this).closest('tr').find('.txtvi').val();

		$.ajax({
			url: editSentence,
			method: 'post',
			data: {eid:eid, numOrder:numOrder, en:en, vi:vi, mid:mid},
		})
		.done(function(){
			window.location="http://localhost/learnByMovie1.1/lbm_admin/sentence/listSen/"+mid+"/"+eid;
		});
	});

	//Thêm từ vựng tiếng anh
	$("#addVocabulary").click(function(event) {
		event.preventDefault();
		$(".divAddVocabulary").slideToggle('slow');
	});

	$("#okAddVoca").click(function(event) {
		event.preventDefault();
		var en = $("#txtEnVocabulary").val();
		var nghia = $("#txtNghia").val();
		if(en == "" || nghia == ""){
			alert('Bạn vui lòng không để trống mục nào');
		}else{
			$.ajax({
				url: addVocabulary,
				method: 'POST',
				data: {en:en, nghia:nghia},
			})
			.done(function(){
					window.location="http://localhost/learnByMovie1.1/lbm_admin/words/listVocabulary";
			});
		}
	});

	//Sửa từ vựng
	$(".XongEditVocabulary").click(function(event) {
		event.preventDefault();
		var en = $(this).closest('tr').find('.txten').val();
		var vi = $(this).closest('tr').find('.txtvi').val();
		$.ajax({
			url: editVocabulary,
			method: 'POST',
			data: {en:en, vi:vi},
		})
		.done(function(msg) {
			window.location="http://localhost/learnByMovie1.1/lbm_admin/words/listVocabulary";
		});
		
	});

	//Mở khóa và khóa episodes khi kết thúc một tập phim
	$(".glyphicon-lock").click(function(event) {
		event.preventDefault();
		lock = confirm("Tập phim này đã được bạn học xong. Bạn muốn khóa để không thêm bất cứ câu nào nữa?");
		if(lock){
			var complete = $(this).closest('.epWhat').find('.lock_episodes').attr('id');
			var eid = $(this).attr('id');
			var mid = $(".mid").attr('id');

			if(complete == 1){
				complete = 2;
			}else{
				complete = 1;
			}	

			$.ajax({
				url: lockUrl,
				method: 'POST',
				data: {complete: complete, eid: eid},
			})
			.done(function(msg) {
				window.location="http://localhost/learnByMovie1.1/lbm_admin/film/detail/"+mid;
			});
		}

	});

});


