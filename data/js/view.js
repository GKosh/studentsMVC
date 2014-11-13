



$(document).ready(function(){

function addStudent(){
	if (/^[А-ЯЁ][а-яё]+(-[А-ЯЁ][а-яё]+)? [А-ЯЁ][а-яё]+( [А-ЯЁ][а-яё]+)?$/.test($('#edit-form').find('#name').val())){
	 if (($('#edit-form').find('#sex').val() == "м") || ($('#edit-form').find('#sex').val() == "ж")){
		if (Number($('#edit-form').find('#age').val())<100){
		if(window.confirm("Вы уверены, что хотите добаивть в базу нового студента\n"+ $('#edit-form').find('#name').val())){
				$.ajax({
				type	: 'POST',
				url 	:$('#users_form').attr("action")+'/add', 
				data	:{
					'name'	:$('#edit-form').find('#name').val(),
					'sex'	:$('#edit-form').find('#sex').val(),
					'age'	:$('#edit-form').find('#age').val(),
					'grp'	:$('#edit-form').find('#group').val(),
					'faculty':$('#edit-form').find('#faculty').val(),
				}
				}).done(function(result){
					$('#tableBody').html(result);
				});
				}
			
		
		
		} else alert('Пожалуйста введите возратс цифрами.\n Максимальный возраст студета - 100')
	 } else { alert('Пожалуйста обозначте пол кирилицей буквами:\n м или ж\n')}
	} else { alert('Пожалуйста, ведите ФИО  кирилицей  в формате:\n Фамилию Имя Отчество\n')}

}

function updateStudent(){
	if ($('#edit-form').find('#id').text() !== ""){
	if (/^[А-ЯЁ][а-яё]+(-[А-ЯЁ][а-яё]+)? [А-ЯЁ][а-яё]+( [А-ЯЁ][а-яё]+)?$/.test($('#edit-form').find('#name').val())){
	 if (($('#edit-form').find('#sex').val() == "м") || ($('#edit-form').find('#sex').val() == "ж")){
		if (Number($('#edit-form').find('#age').val())<100){
		if(window.confirm("Вы уверены, что хотите перепистаь данные студента\n"+ $('#edit-form').find('#name').val()+"\nID:"+$('#edit-form').find('#id').text())){
				$.ajax({
				type	: 'POST',
				url 	:$('#users_form').attr("action")+'/update', 
				data	:{
					'id'	:$('#edit-form').find('#id').text(),
					'name'	:$('#edit-form').find('#name').val(),
					'sex'	:$('#edit-form').find('#sex').val(),
					'age'	:$('#edit-form').find('#age').val(),
					'grp'	:$('#edit-form').find('#group').val(),
					'faculty':$('#edit-form').find('#faculty').val(),
				}
				}).done(function(result){
					$('#tableBody').html(result);
				});
				}
		} else alert('Пожалуйста введите возратс циврами.\n Максимальный возраст студета - 100')
	 } else { alert('Пожалуйста обозначте пол кирилицей буквами:\n м или ж\n')}
	} else { alert('Пожалуйста, ведите ФИО  кирилицей  в формате:\n Фамилию Имя Отчество\n')}
	} else { alert('Выберите студента')}

}
	
function selectStudent(row){

	$('#edit-form').find('#id').text(row.find(".radio").val());
	$('#edit-form').find('#name').val(row.find('.name').text());
	$('#edit-form').find('#sex').val(row.find('.sex').text());
	$('#edit-form').find('#age').val(row.find('.age').text());
	$('#edit-form').find('#group').val(row.find('.group').text());
	$('#edit-form').find('#faculty').val(row.find('.faculty').text());
}

function cleanForm(){

	$('#edit-form').find('#id').text('');
	$('#edit-form').find('#name').val('');
	$('#edit-form').find('#sex').val('');
	$('#edit-form').find('#age').val('');
	$('#edit-form').find('#group').val('');
	$('#edit-form').find('#faculty').val('');
}


	$('body').on('click','.student-row',function(){
	
	var radio = $(this).find(".radio");
	
	if (radio.is(':checked')) {
	 	radio.prop( "checked", false );
		cleanForm()
	} else {
		radio.prop("checked", true);
		selectStudent($(this));
	};
	
	
	
	});

	$('body').on('click','.delete',function(){	
			$(this).parent().find( ".radio").prop( "checked", true );
			var selected_id = parseInt($('#radio:checked').val());
			if (typeof selected_id ==="undefined"){alert('Выберите студента');}
			else{
			if(window.confirm("Вы уверены, что хотите удалить студента из базы?")){
				$.ajax({
				type	: 'POST',
				url 	: $('#users_form').attr("action")+'/delete', 
				data	: {
				'id'	:selected_id
				}
				}).done(function(result){
					$('#tableBody').html(result);
				});
				}
			}
	});
	
	$('body').on('click','#addNew',function(){
		addStudent();
	});
	
	$('body').on('click','#update',function(){
		updateStudent();
	});

 
});

