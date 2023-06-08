function price(form){
var total = 0;
for (i=0; i<document.getElementsByTagName("input").length; i++) {
if (document.getElementsByTagName("input")[i].checked) {
var b=parseFloat(document.getElementsByTagName("input")[i].value);}
else {
b=0;
}


total+=b;
}


	 
		 




//Два поля с разных способов подсчёта один с списка, другой с текстового поля, мы их оба складываем если они присцтствуют.
total+=+document.getElementById("total_sum").value; 
total+=+document.getElementById("total_select").value; 
//Проверка поля проценты
if (document.getElementById("percent").value==1) {
if (total>=document.getElementById("percent_bill").value) {
total = total - document.getElementById("percent_number").value*(total/100);
}}
//Перевод в строку
total = String(total);
//Делаем разбиение чисел
var simbol=document.getElementById("simbol").value;
var sdfsdf = total.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1'+simbol);

document.getElementById("total_price").value=sdfsdf;
document.getElementById("total_priceobshee").value=sdfsdf;
document.getElementById("total_priceobsheemail").value=sdfsdf;
}





//js полсчёт поля селект	 
function select1(updElemId) {
//Получаем значение текущего элемента списка
var select=document.getElementById(updElemId+'-select2').value;
//Переводим всё в числа
var a = parseInt(select);
//Общая сумма
var b = parseInt(document.getElementById("total_select").value);

//Дополнительное поле со стоимостью
var u = parseInt(document.getElementById(updElemId+'-select3').value);
if (u>0) {}
else {u=0;}

//Вычитаем сначла стоимость если она есть в поле select3
var y = b-u;

//Присваиваем значение переменной b 
b = y;

if (b>0) {}
else {b=0;}


//И только после этого прибавляем новое значение
var r = b+a;

var s = document.getElementById(updElemId+'-select2'),
i = s.selectedIndex // или номер нужного option по порядку

//Обновляем данные в полях
document.getElementById(updElemId+'-select4').value=s.options[i].text;
document.getElementById(updElemId+'-select3').value=select;




		 //проверяем имеется ли значение в поле и если да то ничего не вычитаем. Но если значение ==0 то вычитаем из общей стоимости
		 //значение дополнительных полей и диактивируем кнопку. Кнопка доступна только если значение больше 0.
		 if (document.getElementById(updElemId+'-select3').value==0) {
		 if (document.getElementById('optional_a'+updElemId).checked) {
		 document.getElementById('optional_a'+updElemId).checked = false;
		 }
		 
		 if (document.getElementById('optional_b'+updElemId).checked) {
		 document.getElementById('optional_b'+updElemId).checked = false;
		 }
		 
		 if (document.getElementById('optional_c'+updElemId).checked) {
		 document.getElementById('optional_c'+updElemId).checked = false;
		 }	

		 if (document.getElementById('optional_d'+updElemId).checked) {
		 document.getElementById('optional_d'+updElemId).checked = false;
		 }

		 if (document.getElementById('optional_e'+updElemId).checked) {
		 document.getElementById('optional_e'+updElemId).checked = false;
		 }

		 if (document.getElementById('optional_f'+updElemId).checked) {
		 document.getElementById('optional_f'+updElemId).checked = false;
		 }	

		 if (document.getElementById('optional_g'+updElemId).checked) {
		 document.getElementById('optional_g'+updElemId).checked = false;
		 }	

		 if (document.getElementById('optional_h'+updElemId).checked) {
		 document.getElementById('optional_h'+updElemId).checked = false;
		 }

		 if (document.getElementById('optional_i'+updElemId).checked) {
		 document.getElementById('optional_i'+updElemId).checked = false;
		 }

		 if (document.getElementById('optional_j'+updElemId).checked) {
		 document.getElementById('optional_j'+updElemId).checked = false;
		 }	

document.getElementById('big-link'+updElemId).className = 'big-link';
		 
		 }
else { document.getElementById('big-link'+updElemId).className = ''; }	

document.getElementById("total_select").value=r;

}


//Вывод сообщения о том что не выбрано ни одного поля.
function submit_text(updElemId) {
if (document.getElementById('total_priceobshee').value>0) {} 
else {
var dis = document.getElementById('submit_textr');
alert (document.getElementById('textcaptcha_otpravit').value);
dis.disabled = true;}
}