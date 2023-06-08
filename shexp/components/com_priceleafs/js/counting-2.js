     /*
     * Входные параметры функции:
     *    quant     - количество товара
     *    prise     - стоимость за единицу
     *    updElemId - идентификатор элемента, в котором требуется обновить данные (по конкретному товару)
     **/
     function calculate(quant, prise, total_tovar, updElemId, id){
             // данное регулярное выражение проверяет, является ли введенное значение числом
             // учтите, что дробное число тоже является корректным!!! (ведь можно же продавать по полторы тонны чего-либо?)
         var anum = /(^\d+$)|(^\d+\.\d+$)/;
         if (!anum.test(quant)) {
             // если данные не валидны - выводим предупреждение и прерываем выполнение функции
			 document.getElementById('big-link'+id).className = 'big-link';
			 quant=0;
             alert(document.getElementById("textcounting").value);			 
             //return; 
         }
		 
		     if (quant>total_tovar) {
             // если данные не валидны - выводим предупреждение и прерываем выполнение функции
			 document.getElementById(updElemId).innerHTML=0;
			 document.getElementById(id+'-col').value = 0;
			 quant=0;
			 alert(document.getElementById("textcounting_two").value);
             //return;
         } 
		 
		 
		 
             // сумма по наименованию = количество * цену
         goodSum = quant * prise;
             // обновляем элемент - выводим в нем полученную сумму
             // если непонятно: вместо параметра применяемой функции - updElemId
             // у нас подставляется ID конкретного элемента страницы, с которым эта функция была вызвана.
             // Про innerHTML можете самостоятельно поискать в сети - информации море
         document.getElementById(updElemId).innerHTML = goodSum;
             // "вытаскиваем" все, что есть внутри нашей формы с id = "me_order_form"
         var meForm   = document.getElementById("me_order_form");
             // затем как бы фильтруем эти данные - берем только то, что в контейнерах <bdo></bdo>
         var bdoArray  = meForm.getElementsByTagName("bdo");
             // устанавливаем начальное нулевое значение ОБЩЕЙ суммы
         var allSumm = 0;
             // и в цикле прибавляем к ней сумму каждого товара
         for (j = 0; j < bdoArray.length; j++) {
                 // функция parseFloat преобразует данные в число с плавающей запятой
                 // без этого сумма не считалась бы, а использовалась КОНКАТЕНАЦИЯ -
                 // то есть 100 и 200 будет не 300 (как нужно нам), а 100200 - что нам совсем не нужно :)
             allSumm = allSumm + parseFloat(bdoArray[j].innerHTML);
         } 
		 
		 //проверяем имеется ли значение в поле и если да то ничего не вычитаем. Но если значение ==0 то вычитаем из общей стоимости
		 //значение дополнительных полей и диактивируем кнопку. Кнопка доступна только если значение больше 0.
		 if (document.getElementById(id+'-col').value==0) {
		 if (document.getElementById('optional_a'+id).checked) {
		 document.getElementById('optional_a'+id).checked = false;
		 }
		 
		 if (document.getElementById('optional_b'+id).checked) {
		 document.getElementById('optional_b'+id).checked = false;
		 }
		 
		 if (document.getElementById('optional_c'+id).checked) {
		 document.getElementById('optional_a'+c).checked = false;
		 }	

		 if (document.getElementById('optional_d'+id).checked) {
		 document.getElementById('optional_d'+id).checked = false;
		 }

		 if (document.getElementById('optional_e'+id).checked) {
		 document.getElementById('optional_e'+id).checked = false;
		 }

		 if (document.getElementById('optional_f'+id).checked) {
		 document.getElementById('optional_f'+id).checked = false;
		 }	

		 if (document.getElementById('optional_g'+id).checked) {
		 document.getElementById('optional_g'+id).checked = false;
		 }	

		 if (document.getElementById('optional_h'+id).checked) {
		 document.getElementById('optional_h'+id).checked = false;
		 }

		 if (document.getElementById('optional_i'+id).checked) {
		 document.getElementById('optional_i'+id).checked = false;
		 }

		 if (document.getElementById('optional_j'+id).checked) {
		 document.getElementById('optional_j'+id).checked = false;
		 }	

document.getElementById('big-link'+id).className = 'big-link';
		 
		 }
else { document.getElementById('big-link'+id).className = ''; }		 
		 
		 
             // и обновляем содержимое контейнера с id = total_sum
         document.getElementById("total_sum").value = allSumm;

     }
	 
	 
	 
//Подсчёт товаров стрелками увеличение	 
function cols1(updElemId) {
var col=document.getElementById(updElemId+'-col').value;

if (col==document.getElementById(updElemId+'-coltotal').value) {
//alert(document.getElementById('textcounting_three').value);
}
else {
//Делаем фокус на элементе что бы увеличить сумму без перезагрузки
document.getElementById(updElemId+'-col').focus();
col++;
document.getElementById(updElemId+'-col').value = col;
//Как увеличили значение так сразуже убираем фокус с элемента что бы обновить значение
document.getElementById(updElemId+'-col').blur();


}

}



//Подсчёт товаров стрелками уменьшение
function cols2(updElemId) {
		var col=document.getElementById(updElemId+'-col').value;
		var rr=document.getElementById(updElemId+'-col').id;
		if(col>=1) {
document.getElementById(updElemId+'-col').focus();
//Делаем фокус на элементе что бы увеличить сумму без перезагрузки
				var col=document.getElementById(updElemId+'-col').value;
				col--;
				document.getElementById(updElemId+'-col').value = col;
				//Как увеличили значение так сразуже убираем фокус с элемента что бы обновить значение
document.getElementById(updElemId+'-col').blur();
		}
		
		else {document.getElementById(updElemId+'-col').value = ''; }

}	 
	 