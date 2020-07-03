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