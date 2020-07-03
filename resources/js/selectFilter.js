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