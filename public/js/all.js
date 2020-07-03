$(document).ready(function(){
    
    //$('#formdocumentos').hide();$('#formconfirmacao').show();//carrega fim do formulario para testes
    //$('#formdocumentos').hide();$('#forminscricao').show()
    var current_form, next_form, previous_form; //forms
    var opacity;
    $('.formmultstep').submit(function(event){
        event.preventDefault();
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        let formid = event.currentTarget.id;
        switch (event.currentTarget.id) {
            case 'formdocumentos':
                formaction = '/home/documento';
                break;
            case 'formendereco':
                formaction = '/home/endereco';
                break;
            case 'forminscricao':
                formaction = '/home/inscricao';
                break;
            default:
                break;
        }
        if (formaction == '/home/inscricao') {
            var periodos = new Object();

            for (i = 1; i <= indice; i++)
            {   
                var p = new Object();
                p.dI = $('input[name="tempoInicial-'+i+'"]').val();
                p.dF = $('input[name="tempoFinal-'+i+'"]').val();
                periodos[i] = p;
            }
            periodos = JSON.stringify(periodos);
            $.ajax({
                url: formaction,
                type: 'post',
                data: myform = new FormData(this),
                dataType: 'json',
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                timeout: 60000,
                beforeSend: function ()
                {
                    myform.append('periodos',periodos);
                },
                success: function(data) 
                {
                    proximo(formid);  
                },
                error: function (data) {
                    $.each(data.responseJSON.errors, function(key, item){
                        $('#'+key).addClass('is-invalid');
                        $('#'+key).after('<div class="invalid-feedback">'+item+'</div>');
                    });
                }
            });
        }
        else
        {
            $.ajax({
                url: formaction,
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                
                success: function(data) 
                {
                    proximo(formid);   
                },
                error: function (data) {
                    $.each(data.responseJSON.errors, function(key, item){
                        console.log(data);
                        $('#'+key).addClass('is-invalid');
                        $('#'+key).after('<div class="invalid-feedback">'+item+'</div>');
                    });
                }
            });
        }
    });
    function proximo(formid) {

        current_form = $('#'+formid);
        next_form = $('#'+formid).next();
        //Add Class Active
        $("#progressbar li").eq($("form.formmultstep").index(next_form)).addClass("active");
        //show the next form
        next_form.show();

        //hide the current form with style
        current_form.animate({opacity: 0}, {
        step: function(now)
        {
            // for making fielset appear animation
            opacity = 1 - now;
            
            current_form.css(
            {
                'display': 'none',
                'position': 'relative'
            });
            next_form.css({'opacity': opacity});
        },
        duration: 600
        });
    }

    $(".previous").click(function(){
    
        current_form = $(this).parents().eq(2);
        previous_form = $(this).parents().eq(2).prev();
        console.log(current_form,previous_form);
        //Remove class active
        $("#progressbar li").eq($("form.formmultstep").index(current_form)).removeClass("active");
        //Add Class Active
        $("#progressbar li").eq($("form.formmultstep").index(previous_form)).addClass("active");
        
        //show the previous form
        previous_form.show();
        
        //hide the current form with style
        current_form.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;
                
                current_form.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_form.css({'opacity': opacity});
            },
            duration: 600
        });
    });
    function diferencaDias(dI, dF)
    {
        diferenca = Math.abs(dF-dI);
        return Math.ceil(diferenca/(1000*60*60*24));
    }
    
    $('#P-1').parent().children('div').length
    var indice = $('#P-1').parent().children('div').length;
    
    function addBtnRemover(){
        $('#forminscricao > fieldset > div:last-child()').append(
            '<div class="col-md-3">'+
            '<input type="button" class="btn btn-danger" value="Remover"/>'+
            '</div>'+
            '</div>'
        );
    }
    if (indice > 1) {
        addBtnRemover();
    }
    $('#plus').on('click', function(){
        ++indice;
        indice > 2 ? $('#forminscricao > fieldset > div:last-child() > div:last-child()').remove() : null;
        $(this).parent().append(        
            '<div class="form-group row" id="P-'+indice+'">'+
            '<label class="col-md-2 col-form-label text-md-right">'+indice+'º Período</label>'+
            '<div class="col-md-3">'+
            '<input type="date" name="tempoInicial-'+indice+'" class="form-control" required>'+
            '<small class="form-text text-muted">Inserir data de início.</small>'+
            '</div>'+
            '<div class="col-md-3">'+
            '<input type="date" name="tempoFinal-'+indice+'" class="form-control" disabled="disabled" required>'+
            '<small class="form-text text-muted">Inserir data de fim.</small>'+
            '</div>'
        );
        addBtnRemover();

    });
    $('#forminscricao > fieldset > div > div:nth-child(2) > input').each(function(){
        if ($(this).val()) {
            $(this).parents().eq(1).find('p').remove();
            pI = new Date($(this).val());
            pF = new Date($(this).parent().next().children().eq(0).removeAttr('disabled').val());
            if ($(this).parent().next().children().eq(0).val()) {
                //console.log(pI,pF);
                dias = diferencaDias(pI,pF);
                $(this).parents().eq(0).siblings().eq(1).after('<p>'+dias+': dia(s)</p>');
            }
        }else
        {   
            $(this).parents().eq(1).find('p').remove();
        }
    });
    $(document).on('change','#forminscricao > fieldset > div > div:nth-child(2) > input',function(){
        if ($(this).val()) {
            $(this).parents().eq(1).find('p').remove();
            pI = new Date($(this).val());
            pF = new Date($(this).parent().next().children().eq(0).removeAttr('disabled').val());
            if ($(this).parent().next().children().eq(0).val()) {
                //console.log(pI,pF);
                dias = diferencaDias(pI,pF);
                $(this).parents().eq(0).siblings().eq(1).after('<p>'+dias+': dia(s)</p>');
            }
        }else
        {   
            $(this).parents().eq(1).find('p').remove();
        }
    });
    $(document).on('change','#forminscricao > fieldset > div > div:nth-child(3) > input', function(){
        if($(this).val())
        {
            $(this).parents().eq(1).find('p').remove();
            dF = new Date($(this).val());
            dI = new Date($(this).parent().prev().children(0).val());
            dias = diferencaDias(dI,dF);
            $(this).parents().eq(0).after('<p>'+dias+': dia(s)</p>');

        }else
        {
            $(this).parents().eq(1).find('p').remove();
        }
    });
    $(document).on('click','#forminscricao > fieldset > div > div > input[value=Remover]',function()
    {   
        if(indice > 2)
        {
            $(this).parents().eq(1).prev().append(
                '<div class="col-md-3">'+
                '<input type="button" class="btn btn-danger" value="Remover"/>'+
                '</div>'+
                '</div>'
            );
        }     
        $(this).parents().eq(1).remove();
        indice--;
    });
    $('input[name="Imprimir"]').on('click',function(){
        window.print();
    });

    $('#cpf').mask('000.000.000-00');
    $('#endereco_cep').mask('00.000-000');
    $('#contato_celular').mask('(00) 00000-0000');
    $('#contato_fixo').mask('(00) 0000-0000');
    $('#titulo_num').mask('0000 0000 0000');
});
$(document).ready(function(){
    carregarEstados();
    carregarTituloMunicipios();
    carregarEnderecoMunicipio();
    
    function limpaNaturalidade() {
        $('#naturalidade').attr('disabled','disabled');
        $('#naturalidade').empty();
    }
    function limpaEstado() {
        $('#estado').attr('disabled','disabled');
        $('#estado').empty();
        $('#naturalidade').attr('disabled','disabled');
        $('#naturalidade').empty();
    }
    function limpaTituloMunicipio() {
        $('#titulo_municipio').attr('disabled','disabled');
        $('#titulo_municipio').empty();
    }
    function carregarEstados() {
        let idPais = $('#nacionalidade').val();
        let selecEstado = $('#estado').val() !== undefined ? $('#estado').val() : '';
        limpaEstado();
        if (idPais) {
            $.ajax({
                url:'/home/estados/' + idPais,
                type: 'get',
                dataType:'json',
                success: function(response){
                    $("#estado").append('<option value=""></option>');
                    $.each(response, function(key,item){
                        $("#estado").append('<option value="'+item.id+'"'+ (selecEstado == item.id ? 'selected': '') +'>'+item.nome+'</option>');
                    })
                    $('#estado').removeAttr('disabled');
                } 
            }).done( function() {
                carregarMunicipios();
            });
        }
        
    }
    function carregarMunicipios() {
        let idEstado = $('#estado').val();
        let selecMunicipio = $('#naturalidade').val() !== undefined ? $('#naturalidade').val() : '';
        limpaNaturalidade();
        if (idEstado) {
            $.ajax({
                url: '/home/municipios/' + idEstado,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    $("#naturalidade").append('<option value=""></option>');
                    $.each(response, function(key,item){
                        $("#naturalidade").append('<option value="' + item.id + '"'+ (selecMunicipio == item.id ? 'selected': '') +'>' + item.nome + '</option>');
                    });
                    $('#naturalidade').removeAttr('disabled');
                }
            });
        }

    }
    function carregarTituloMunicipios() {
        let idEstadoTitulo = $('#titulo_uf').val();
        let selecTituloMunicipio = $('#titulo_municipio').val() !== undefined ? $('#titulo_municipio').val() : '';
        limpaTituloMunicipio();
        if (idEstadoTitulo) {
            $.ajax({
                url: '/home/municipios/' + idEstadoTitulo,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    $("#titulo_municipio").append('<option value=""></option>');
                    $.each(response, function(key,item){
                        $("#titulo_municipio").append('<option value="'+item.id+'"'+ (selecTituloMunicipio == item.id ? 'selected': '') +'>' + item.nome + '</option>');
                    });
                    $('#titulo_municipio').removeAttr('disabled');
                }
            });
        }

    }
    $('#nacionalidade').on('change',function(){
        if ($(this).val()) {
            limpaNaturalidade();
            limpaEstado();
            carregarEstados();
        }else
        {
            limpaEstado();
            limpaNaturalidade();
        }
    });
    $('#estado').on('change',function(){
        if ($(this).val()) {
            limpaNaturalidade();
            carregarMunicipios();
        }else{
            limpaNaturalidade();
        }
    });
    $('#titulo_uf').on('change',function () {
        if($(this).val()){
            limpaTituloMunicipio();
            carregarTituloMunicipios();
        }else
        {
            limpaTituloMunicipio();
        }
    });function limpaEnderecoMunicipio() {
        $('#endereco_municipio').attr('disabled','disabled');
        $('#endereco_municipio').empty();
    }
    function carregarEnderecoMunicipio(params) {
        let idEnderecoUf = $('#endereco_uf').val();
        let selecEnderecoMunicipio = $('#endereco_municipio').val() !== undefined ? $('#endereco_municipio').val() : '';
        limpaEnderecoMunicipio();
        if (idEnderecoUf) {
            $.ajax({
                url: '/home/municipios/' + idEnderecoUf,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    $("#endereco_municipio").append('<option value=""></option>');
                    $.each(response, function(key,item){
                        $("#endereco_municipio").append('<option value="' + item.id + '"'+(selecEnderecoMunicipio == item.id ? 'selected': '')+'>' + item.nome + '</option>');
                    });
                    $('#endereco_municipio').removeAttr('disabled');
                }
            });  
        }

    }
    $('#endereco_uf').on('change',function(){
        if ($(this).val()) {
            limpaEnderecoMunicipio();
            carregarEnderecoMunicipio();
        }else{
            limpaEnderecoMunicipio();
        }
    });
});
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