// BS-Stepper Init
document.addEventListener('DOMContentLoaded', function () {
  window.stepper = new Stepper(document.querySelector('.bs-stepper'))
});

function layoutPadraoModal() {
  document.getElementById('labeldescricao').innerHTML = "Descrição";
  document.getElementById('labelgrupo').innerHTML = "Grupo";
  document.getElementById('labelmarca').innerHTML = "Marca";
  document.getElementById('descricao').classList.remove("is-invalid");
  document.getElementById('idgrupo').classList.remove("is-invalid");
  document.getElementById('idmarca').classList.remove("is-invalid");
  document.getElementById("salvarecontinuar").disabled = false;
}

function validarCampos() {
  console.log('Entrei na função de validação de campos');
  layoutPadraoModal();
  if (document.getElementById("descricao").value == '') {
    document.getElementById('labeldescricao').innerHTML = "<FONT COLOR='red'>A descrição é obrigatória</FONT>";
    document.getElementById('descricao').classList.remove("is-valid");
    document.getElementById('descricao').classList.add("is-invalid");
    $("#descricao").focus();
  } else if (document.getElementById("idmarca").value == 0) {
    document.getElementById('labelmarca').innerHTML = "<FONT COLOR='red'>A marca é obrigatória</FONT>";
    document.getElementById('idmarca').classList.remove("is-valid");
    document.getElementById('idmarca').classList.add("is-invalid");
  } else if (document.getElementById("idgrupo").value == 0) {
    document.getElementById('labelgrupo').innerHTML = "<FONT COLOR='red'>O grupo é obrigatório</FONT>";
    document.getElementById('idgrupo').classList.remove("is-valid");
    document.getElementById('idgrupo').classList.add("is-invalid");
  } else {
    gravarDados();
  }
}

function gravarDados() {
  layoutPadraoModal();
  document.getElementById("salvarecontinuar").disabled = true;
  var url = window.location.pathname.substring(0, window.location.pathname.indexOf("/", 2)) + "/produto";
  var dados = "";
  dados = "idproduto=" + document.getElementById("idproduto").value
    + "&descricao=" + document.getElementById("descricao").value
    + "&ncm=" + document.getElementById("ncm").value
    + "&unidademedida=" + document.getElementById("unidademedida").value
    + "&idmarca=" + document.getElementById("idmarca").value
    + "&idgrupo=" + document.getElementById("idgrupo").value
    + "&descricaodetalhada=" + document.getElementById("descricaodetalhada").value;

  if (document.getElementById("idsubgrupo").value != "0") {
    dados += "&idsubgrupo=" + document.getElementById("idsubgrupo").value;
  }

  $.ajax({
    asyc: false,
    type: "POST",
    url: url + "/cadastrar",
    data: dados,
    dataType: "json",
    error: function (xhr) {
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Erro',
        text: 'Não foi possível salvar o produto!',
        showConfirmButton: true,
        timer: 10000
      }).then(function () {
        window.location.href = window.location.href = url;
        document.getElementById("salvarecontinuar").disabled = false; //se der erro habilitar o salvar de novo
      })
    },
    success: function (data) {
      if (data.resultado == 'ok' && data.idproduto != '') {
        document.getElementById("idproduto").value = data.idproduto; //passar o campo do idproduto cadastrado para o campo do formulario que está escondido.
        buscarCodigoBarraProduto(data.idproduto);
        stepper.next();
        layoutPadraoModal();
      }
    }
  });
}

function layoutPadraoModalCodigoBarraProduto() {
  document.getElementById('labelcodigobarraproduto').innerHTML = "Código de Barras";
  document.getElementById('codigobarraproduto').classList.remove("is-invalid");
  document.getElementById("adicionarcodigobarraproduto").disabled = false;
}

function validarCamposCodigoBarraProduto() {
  console.log('Entrei na função de validação de campos do código de barras');
  layoutPadraoModalCodigoBarraProduto();
  if (document.getElementById("codigobarraproduto").value == '') {
    document.getElementById('labelcodigobarraproduto').innerHTML = "<FONT COLOR='red'>O código de barras é obrigatório</FONT>";
    document.getElementById('codigobarraproduto').classList.remove("is-valid");
    document.getElementById('codigobarraproduto').classList.add("is-invalid");
    $("#codigobarraproduto").focus();
  } else {
    gravarDadosCodigoBarraProduto();
  }

}

function buscarCodigoBarraProduto(idproduto) {
  $.getJSON({
    asyc: false,
    type: "GET",
    url: "/painel/codigobarraproduto/buscar/" + idproduto,
    error: function (xhr) {
      alert("Problemas ao  carregar! Erro: " + xhr.status);
    },
    success: function (data) {
      $.each(data, function (index, value) {
        addLinhaCodBarraHTML(value.idcodigobarraproduto, value.codigobarra);
      });

    }
  });
}

function gravarDadosCodigoBarraProduto() {
  console.log("entrei na gravarDadosCodigoBarraProduto");
  document.getElementById("adicionarcodigobarraproduto").disabled = true;
  var url = window.location.pathname.substring(0, window.location.pathname.indexOf("/", 2)) + "/codigobarraproduto";
  var dados = "";
  dados = "idproduto=" + document.getElementById("idproduto").value
    + "&codigobarra=" + document.getElementById("codigobarraproduto").value;

  console.log("variavel dados: " + dados);

  $.ajax({
    asyc: false,
    type: "POST",
    url: url + "/cadastrar",
    data: dados,
    dataType: "json",
    error: function (xhr) {
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Erro',
        text: 'Não foi possível salvar o codigo de barras do produto!',
        showConfirmButton: true,
        timer: 10000
      }).then(function () {
        window.location.href = url;
        document.getElementById("adicionarcodigobarraproduto").disabled = false; //se der erro habilitar o salvar de novo
      })
    },
    success: function (data) {
      if (data.resultado == 'ok' && data.idproduto != '' && data.codigobarra != '' && data.idcodigobarraproduto != '') {
        document.getElementById("codigobarraproduto").value = '';
        $("#codigobarraproduto").focus();
        addLinhaCodBarraHTML(data.idcodigobarraproduto, data.codigobarra);
        document.getElementById("adicionarcodigobarraproduto").disabled = false;
      } else {
        Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'Erro',
          text: 'Esse código de barras já está cadastrado no produto: ' + data.idproduto + ' - ' + data.descricao,
          showConfirmButton: true,
          timer: 10000
        }).then(function () {
          //window.location.href = url;
          document.getElementById("adicionarcodigobarraproduto").disabled = false; //se der erro habilitar o salvar de novo
          $("#codigobarraproduto").focus();
        })

      }
    }
  });


}

function addLinhaCodBarraHTML(idcodigobarraproduto, codigobarra) {
  var html = '<div id="div_' + idcodigobarraproduto + '">'
    + '<div class="form-group"></div><div class="form-line row">'
    + '<div class="col-sm">'
    + '<div class="input-group input-group-mb-3">'
    + '<input type="text" class="form-control" id="' + idcodigobarraproduto + '" value="' + codigobarra + '" disabled/>'
    + '<span class="input-group-append">'
    + '<button type="button" onclick="deletar(' + idcodigobarraproduto + ')" class="btn btn-danger btn-flat">Remover</button>'
    + '</span></div></div></div> '
    + '</div>';
  $("#espacoadd").append(html);
}

function removeLinhaCodBarraHTML(idcodigobarraproduto) {
  var id = "div_" + idcodigobarraproduto;
  // Removendo um nó a partir do pai
  var node = document.getElementById(id);
  if (node.parentNode) {
    node.parentNode.removeChild(node);
  }

}

function deletar(idcodigobarraproduto) {
  var url = window.location.pathname.substring(0, window.location.pathname.indexOf("/", 2)) + "/codigobarraproduto";
  var dados = "idcodigobarraproduto=" + idcodigobarraproduto;

  Swal.fire({
    title: 'Você tem certeza?',
    text: 'Deseja excluir o código de barras?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sim',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        asyc: false,
        type: "POST",
        url: url + "/deletar",
        data: dados,
        dataType: "json",
        error: function (xhr) {
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Erro',
            text: 'Não foi possível excluir o codigo de barras do produto!',
            showConfirmButton: true,
            timer: 10000
          }).then(function () {
            window.location.href = url;
          })
        },
        success: function (data) {
          if (data.resultado == 'ok') {
            removeLinhaCodBarraHTML(idcodigobarraproduto);
          }
        }
      });

    }
    ;
  });

}