        function validar() {
            var erro = 0;
            
            var nome = document.formulario.nome.value;
            var sobrenome = document.formulario.sobrenome.value;
            var email = document.formulario.email.value;
            var rg = document.formulario.rg.value;
            var rua = document.formulario.rua.value;
            var dataNasc = document.formulario.dataNasc.value;
            var telefone = document.formulario.telefone.value;
            var email = document.formulario.email.value;
            var senha = document.formulario.senha.value;
            var confirm_senha = document.formulario.confirm_senha.value;
            var cep = document.formulario.cep.value;
            var numero = document.formulario.numero.value;
            var bairro = document.formulario.bairro.value;
            var rua = document.formulario.rua.value;
            var hoje = new Date();
            var nasc = new Date(data);
            var idade = hoje.getFullYear() - nasc.getFullYear();
            var m = hoje.getMonth() - nasc.getMonth();
            var data = document.getElementById("nascimento").value; // pega o valor do input
            data = data.replace(/\//g, "-"); // substitui eventuais barras (ex. IE) "/" por hífen "-"
            var data_array = data.split("-"); // quebra a data em array
            // para o IE onde será inserido no formato dd/MM/yyyy
            if (data_array[0].length != 4) {
                data = data_array[2] + "-" + data_array[1] + "-" + data_array[0]; // remonto a data no formato yyyy/MM/dd

            }

            if (m < 0 || (m === 0 && hoje.getDate() < dataNasc.getDate())) {
                idade--;

            if (nome == "") {
                alert("Nome não informado");
                formulario.nome.focus();
                // return false;
                erro++;
            }else if (sobrenome == "") {
                alert("Sobrenome não informado");
                formulario.sobrenome.focus();
                // return false;
                erro++;
            }else if(rg == "") {
                alert("RG não informado");
                formulario.rg.focus();
                // return false;
                erro++;
            }else if (dataNasc == "") {
                alert("Data de nascimento não informada");
                formulario.dataNasc.focus();
                // return false;
                erro++;
            }else if (telefone == "" || telefone.value < 15) {
                alert("Número de telefone não informado");
                formulario.telefone.focus();
                // return false;
                erro++;
            }else if (email == "") {
                alert("E-mail não informado");
                formulario.email.focus();
                // return false;
                erro++;
            }else if (senha == "") {
                alert("Senha não informada");
                formulario.senha.focus();
                // return false;
                erro++;
            }else if (cep == "") {
                alert("Cep não informado");
                formulario.cep.focus();
                // return false;
                erro++;
            }else if (bairro == "") {
                alert("Bairro não informado");
                formulario.bairro.focus();
                // return false;
                erro++;
            }else if (rua == "") {
                alert("Rua não informada");
                formulario.rua.focus();
                // return false;
                erro++;
            }else if (numero == "") {
                alert("Numero não informado");
                formulario.numero.focus();
                // return false;
                erro++;
            }

            //VALIDAR IDADE
    
            // comparo as datas e calculo a idade
    
            } else if (idade < 18) {
                alert("Pessoas menores de 18 não podem se cadastrar.");
                erro++;
            } else if (confirm_senha != senha) {
                alert("As senhas não são iguais. Tente novamente.");
                formulario.confirm_senha.value.focus();
                // return false;
                erro++;
            } else 
                document.formulario.submit();
            

        } 

        function mascaraTelefone(telefone) {
            if (telefone.value.length == 0)
                telefone.value = '(' + telefone.value;
            if (telefone.value.length == 3)
                telefone.value = telefone.value + ') ';
            if (telefone.value.length == 9)
                telefone.value = telefone.value + '-';
        }

        function mascaraCep(cep) {
            if (cep.value.length == 5)
                cep.value = cep.value + '-';
        }