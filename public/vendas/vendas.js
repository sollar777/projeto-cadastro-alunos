var getUrlVendas = $("#url_vendas").val()

$(".form-cabecalho-vendas").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
        url: getUrlVendas + "/vendas/criar",
        type: "post",
        data: $(this).serialize(),
        dataType: "json"
    }).done(function (data) {
        $.each(data, function (e, element) {
            $(".codVenda").html(element["id"]);
            $(".hidden-codVenda-finalizar").val(element["id"]);
            $(".btn-vendas-iniciar").attr("disabled", true);
            $("#form-add-item").removeClass("d-none")
            $(".div-table-produtos-venda").removeClass("d-none")
            $(".btn-finalizar-venda").removeClass("d-none")
        })
    }).fail(function (e) {
        console.log("erro: " + e);
    })
})

$(".select-aluno-venda").on("change", function () {
    if ($(this).val() > 0) {
        var id = $(this).val();
        $.ajax({
            url: getUrlVendas + "/vendas/produto/buscar/" + id,
            type: "get",
            dataType: "json"
        }).done(function (data) {
            $.each(data, function (e, element) {
                if (element.length > 0) {
                    popularSelectProdutos(element)
                }
            })
        }).fail(function (e) {
            console.log("erro: " + e);
        })
    }
})

function popularSelectProdutos(data) {
    $(".select-produtos-venda option").remove();
    var cols = ""
    cols = "<option value='0'></option>"
    $.each(data, function (e, element) {
        cols += "<option value='" + element.id + "'>" + element.nome + "</option>"
    })

    $(".select-produtos-venda").append(cols);
}

$(".select-produtos-venda").on("change", function () {
    if ($(this).val() > 0) {
        var id = $(this).val();

        $.ajax({
            url: getUrlVendas + "/produtos/buscar/" + id,
            type: "get",
            dataType: "json"
        }).done(function (data) {
            $.each(data, function (e, element) {
                atualizarCamposProdutoVenda(element)
            })
        }).fail(function (e) {
            console.log("erro: " + e);
        })
    }
})

function atualizarCamposProdutoVenda(data) {
    $(".input-preco-vendas").val(data.preco);
    $(".input-hidden-produto").val($(".codVenda").html());
}

$("#form-add-item").on("submit", function (e) {
    e.preventDefault();

    if ($(".select-produtos-venda").val() > 0) {
        $.ajax({
            url: getUrlVendas + "/vendasitens/adicionar",
            type: "post",
            data: $(this).serialize(),
            dataType: "json"
        }).done(function (data) {
            $.each(data, function (e, element) {
                popularTableVendasItens(element)
            })

        }).fail(function (e) {
            console.log("erro: " + e);
        })
    }
})

function popularTableVendasItens(dados) {
    var cols = ""
    $(".tbody-vendas-itens tr").remove();
    $.each(dados, function (a, element) {
        cols += "<tr>";
        cols += "<td>" + dados[a].produto_id + "</td>";
        cols += "<td>" + dados[a].nome + "</td>";
        cols += "<td>" + dados[a].quantidade + "</td>";
        cols += "<td>" + dados[a].preco + "</td>";
        cols += "<td>" + (dados[a].preco * dados[a].quantidade).toLocaleString('pt-BR') + "</td>";
        cols += "<td>" + "<a href='javascript:modalEditarProduto(" + dados[a].id + ")' onclick='modalEditarProduto(" + dados[a].id + ")' id='" + dados[a].id + "' class='fas fa-edit btn btn-primary btn-modal-vendas-edit'" +
            "data-toggle='modal' data-target='#modalVendaEditProduct'></a>" +
            "<button type='submit' onclick='modalRemoverProduto(" + dados[a].id + ")' class='fas fa-trash-alt btn btn-danger btn-modal-vendas-excluir'></button>" + "</td>";
        cols += "</tr>";
    })
    $(".tbody-vendas-itens").append(cols);
}

function modalEditarProduto(id) {
    if (!$(".form-check-input").is("checked")) {
        if (id > 0) {
            $.ajax({
                url: getUrlVendas + "/vendasitens/editar/" + id,
                type: "get",
                dataType: "json"
            }).done(function (data) {
                $.each(data, function (e, element) {
                    popularModalVendaItem(element);
                })
            }).fail(function (e) {
                console.log("erro: " + e)
            })
        }
    }
}

function popularModalVendaItem(dados) {
    $(".modal-nome-produto").val(dados.nome);
    $(".modal-quantidade-produto").val(dados.quantidade);
    $(".modal-preco-produto").val(dados.preco);
    $(".modal-tot-produto").val(dados.preco * dados.quantidade);
    $(".modal-hidden-vendaitem-id").val(dados.id);
}

$(".modal-item-venda").on("submit", function (e) {
    e.preventDefault();

    var id = $(".modal-hidden-vendaitem-id").val()

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("input[name=_token").val()
        }
    })

    $.ajax({
        url: getUrlVendas + "/vendasitens/editar/" + id,
        type: "put",
        data: $(this).serialize(),
        dataType: "json"
    }).done(function (dados) {
        $.each(dados, function (e, element) {
            if (element.length > 0) {
                popularTableVendasItens(element)
                $(".btn-modal-fechar").trigger("click");
            }
        })
    }).fail(function (e) {
        console.log("erro: " + e);
    })
})

function modalRemoverProduto(id) {
    if(!$(".form-check-input").is("checked")) {
        if (id > 0) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $(".hidden-table-token").val()
                }
            })

            $.ajax({
                url: getUrlVendas + "/vendasitens/excluir/" + id,
                type: "delete",
                dataType: "json"
            }).done(function (data) {
                $.each(data, function (e, element) {
                    if (element.length > 0) {
                        popularTableVendasItens(element)
                    } else {
                        $(".tbody-vendas-itens tr").remove();
                    }
                })
            }).fail(function (e) {
                console.log("erro: " + e)
            })

        }
    }
}

$(".form-finalizar-venda").on("submit", function (e) {
    e.preventDefault()

    var id = $(".hidden-codVenda-finalizar").val();

    if (id > 0) {
        $.ajax({
            url: getUrlVendas + "/vendas/finalizar/" + id,
            type: "put",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                if (response[0].success === true) {
                    $(".form-check-input").attr("checked", true);
                    $(".btn-finalizar-venda").attr("disabled", true);
                    $(".b-adicionar-prod-venda").attr("disabled", true);
                    window.location.href = getUrlVendas + "/vendas/exibir"
                }
            }
        })
    }

})

