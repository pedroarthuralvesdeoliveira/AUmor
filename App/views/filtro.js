$('#filtrarAnimais').submit(function(e){
    e.preventDefault();
    sexo = $('#sexo').val();
    tipo = $('#tipo').val();
    porte = $('#porte').val();
    $.ajax({
        url: '../Controller/filtroAnimaisController.php',
        type: 'POST',
        data: {tipo, sexo, porte},
        dataType: 'json',
        success: function(response){
          $('#animalView').html("");
          $("#animalView").append(response);
        }, 
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          console.log("Status: " + textStatus); console.log("Error: " + errorThrown);
        }  
    });
});