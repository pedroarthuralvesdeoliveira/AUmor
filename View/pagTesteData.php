<!DOCTYPE html>
<html>
<head>
	<title> </title>
</head>

<script>

function validadata(){
   var data = document.getElementById("nascimento").value; // pega o valor do input
   data = data.replace(/\//g, "-"); // substitui eventuais barras (ex. IE) "/" por hífen "-"
   var data_array = data.split("-"); // quebra a data em array
   
   // para o IE onde será inserido no formato dd/MM/yyyy
   if(data_array[0].length != 4){
      data = data_array[2]+"-"+data_array[1]+"-"+data_array[0]; // remonto a data no formato yyyy/MM/dd
   }
   
   // comparo as datas e calculo a idade
   var hoje = new Date();
   var nasc  = new Date(data);
   var idade = hoje.getFullYear() - nasc.getFullYear();
   var m = hoje.getMonth() - nasc.getMonth();
   if (m < 0 || (m === 0 && hoje.getDate() < nasc.getDate())) idade--;
   
   if(idade < 18){
      alert("Pessoas menores de 18 não podem se cadastrar.");
      return false;
   }

   if(idade >= 18 && idade <= 60){
      alert("Maior de 18, pode se cadastrar.");
      return true;
   }
   
   // se for maior que 60 não vai acontecer nada!
   return false;
}


</script>
<body>

<input type="date" name="nascimento" id="nascimento">
<button type="button" onclick='return validadata()'>Validar</button>



</body>
</html>