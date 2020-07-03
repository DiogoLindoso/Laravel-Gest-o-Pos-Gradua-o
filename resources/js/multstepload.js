$(document).ready(function () {
    var user = $('.formmultstep').data('documento');
    //Carregar dados do formulário de documentos
    
    var nascimentoPais
    var nascimentoEstado
    var municipioNascimento
    var titulo_municipio
    var titulo_estado

    $.ajax({
        url:'documento/'+user,
        type:'get',
        dataType: 'json',
        success: function(response){
            titulo_municipio = response.titulo_municipio;
            municipioNascimento = response.nascimento_municipio;
            $('input[name="nome"]').attr('value',response.nome);
            $('select[name="sexo"] > option[value="'+response.sexo+'"]').attr('selected','selected');
            $('input[name="cpf"]').attr('value',response.cpf);
            $('input[name="nascimento"]').attr('value',response.data_nascimento);
            $('select[name="estado_civil"] > option[value="'+response.estado_civil+'"]').attr('selected','selected');
            $('input[name="mae"]').attr('value',response.nome_mae);
            $('input[name="pai"]').attr('value',response.nome_pai);
            $('select[name="tipo"] > option[value="'+response.tipo_documento+'"]').attr('selected','selected');
            $('input[name="num"]').attr('value',response.num_documento);
            $('input[name="data_emissao"]').attr('value',response.data_emissao_documento);
            $('input[name="orgao_emissor"]').attr('value',response.orgao_emissor_documento);
            $('select[name="uf_documento"] > option[value="'+response.uf_documento+'"]').attr('selected','selected');
            $('input[name="titulo_num"]').attr('value',response.titulo_num);
            $('input[name="titulo_emissao"]').attr('value',response.titulo_emissao);
        }
    }).done(getMunicipios)
    function getMunicipios() {
        $.ajax({
            url: 'municipiogetestado/'+municipioNascimento,
            type: 'get',
            dataType: 'json',
            success: function(response){
                nascimentoEstado = response.estado.id;
                $('#naturalidade').empty();
                $('#naturalidade').removeAttr('disabled');
                $.each(response.municipios,function(index, municipio){
                    $('#naturalidade').append('<option value="'+municipio.id+'">'+municipio.nome+'</option>');
                });  
                $('#naturalidade > option[value="'+ municipioNascimento+'"]').attr('selected','selected');
            }

        }).done(function(){
            $.ajax({
                url: 'estadogetpais/'+nascimentoEstado,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    nascimentoPais = response.pais.id;
                    $('#estado').empty();
                    $('#estado').removeAttr('disabled');
                    $.each(response.estados,function(index, estado){
                        $('#estado').append('<option value="'+estado.id+'">'+estado.nome+'</option>');
                    });  
                    $('#estado > option[value="'+nascimentoEstado+'"]').attr('selected','selected');
                    $('#nacionalidade > option[value="'+nascimentoPais+'"]').attr('selected','selected');  
                }
            });
            municipioTitulo();
        });
    }
    
    function municipioTitulo() {
        $('#titulo_municipio').empty();
        $('#titulo_municipio').removeAttr('disabled');
        $.ajax({
            url:'municipiogetestado/'+titulo_municipio,
            type:'get',
            dataType:'json',
            success:function(response){
                titulo_estado = response.estado.id;
                $.each(response.municipios, function(index, municipio){
                    $('#titulo_municipio').append('<option value="'+municipio.id+'">'+municipio.nome+'</option>');
                });
                $('#titulo_municipio > option[value="'+titulo_municipio+'"]').attr('selected','selected');
            }
        }).done(function(){
            $.ajax({
                url: 'estadogetpais/'+titulo_estado,
                type: 'get',
                dataType:'json',
                success: function(response){
                    $.each(response,function(index, estado){
                        $('#titulo_uf').append('<option value"'+ estado.id+'">'+estado.uf+'</option>')
                    })
                    $('#titulo_uf > option[value="'+titulo_estado+'"]').attr('selected','selected');
                }
            })
        })
    }
    //Carregar dados do formulário de endereço
    var municipioEndereco
    $.ajax({
        url: 'endereco/'+user,
        type: 'get',
        dataType: 'json',
        success: function(response){
            municipioEndereco = response.municipio_id;
            $('#endereco_logradouro').attr('value',response.logradouro);
            $('#endereco_cep').attr('value',response.cep);
            $('#endereco_bairro').attr('value',response.bairro);
            $('#endereco_num_casa').attr('value',response.num);
            $('#endereco_complemento').attr('value',response.complemento);
            $('#contato_celular').attr('value',response.celular)
            $('#contato_fixo').attr('value',response.telefone_fixo);
        }
    }).done(function()
    {

        $.ajax({
            url:'municipiogetestado/'+municipioEndereco,
            type:'get',
            dataType:'json',
            success:function(response){
                $('#endereco_municipio').empty();
                $('#endereco_municipio').removeAttr('disabled');
                estadoEndereco = response.estado.id;
                $.each(response.municipios, function(index, municipio){
                    $('#endereco_municipio').append('<option value="'+municipio.id+'">'+municipio.nome+'</option>');
                });
                $('#endereco_municipio > option[value="'+municipioEndereco+'"]').attr('selected','selected');
                $('#endereco_uf > option[value="'+response.estado.id+'"]').attr('selected','selected');
            }
        })
    })

    //carregar dados formulário de inscricao
    $.ajax({
        url: '/home/inscricao/'+user,
        type: 'get',
        dataType: 'json',
        success: function(response){
            
            periodo = $.parseJSON(response.periodo_servico);
            console.log(response);
            $('#curso > option[value="'+response.curso_id+'"]').attr('selected','selected');
            $('#turma > option[value="'+response.turma_id+'"]').attr('selected','selected');
            $('#cota > option[value="'+response.cota_id+'"]').attr('selected','selected');
            $('input[name="comprovante"]').attr('value','/storage/'+response.compravante_tempo_servico);
            if (Object.keys(periodo).length) {
                $('input[name="tempoInicial-1"]').attr('value', periodo["1"].dI)
                $('input[name="tempoFinal-1"]').attr('value', periodo["1"].dF).removeAttr('disabled');
                if (Object.keys(periodo).length > 1) {
                    var indice = 2; 
                   // $('#forminscricao > fieldset > div:last-child() > div:last-child()').remove();
                    $('#forminscricao > fieldset').append(        
                        '<div class="form-group row" id="P-'+indice+'">'+
                        '<label class="col-md-2 col-form-label text-md-right">'+indice+'º Período</label>'+
                        '<div class="col-md-3">'+
                        '<input type="date" name="tempoInicial-'+indice+'" class="form-control" value="'+periodo[indice].dI+'" required>'+
                        '<small class="form-text text-muted">Inserir data de início.</small>'+
                        '</div>'+
                        '<div class="col-md-3">'+
                        '<input type="date" name="tempoFinal-'+indice+'" class="form-control" value="'+periodo[indice].dF+'" required>'+
                        '<small class="form-text text-muted">Inserir data de fim.</small>'+
                        '</div>'
                    );
                    $('#forminscricao > fieldset').after('<a href="/storage/'+response.compravante_tempo_servico+'" target="_blank">'+response.compravante_tempo_servico+'</a> ');
                    $('#forminscricao > div:nth-child(7) > div > label').text('Substituir comprovante de tempo de serviços em PDF');
                    $('#comprovante').removeAttr('required');
                }
            }

        }
    })
});