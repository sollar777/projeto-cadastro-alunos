$(".cep-aluno").on("change", function () { 
    cep = $(this).val()

    if(cep){
        $.ajax({
            url: "/alunos/buscarcep/" + cep,
            type: "get",
            dataType: "json"
        }).done(function (data) { 
            $.each(data, function (e) { 
                $(".endereco-aluno").val(data[e].logradouro)
                $(".bairro-aluno").val(data[e].bairro)
                $(".cidade-aluno").val(data[e].localidade)
                $(".uf-aluno").val(data[e].uf)
             })
         }).fail(function (e) { 
             console.log("erro: " + e)
          })
    }

    
 })