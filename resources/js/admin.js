$(document).ready(function () {
alunos();
municipios();
    function alunos(){
        if ($('#turma').val()) {
            $.ajax({
                url:'/admin/alunos/turma/' + $('#turma').val(),
                type: 'get',
                dataType: 'json',
                beforeSend: function(){
                    $('#alunos').empty();
                },
                success: function (data) {
                    $('#alunos').append(
                    '<table class="table table-striped">'+
                    '            <thead>'+
                    '                <tr>'+
                    '                    <th scope="col">Nº Inscricao</th>'+
                    '                    <th scope="col">Turma</th>'+
                    '                    <th scope="col">Cota</th>'+
                    '                    <th scope="col">Tempo de Serviço</th>'+
                    '                    <th scope="col">Nome</th>'+
                    '                </tr>'+
                    '            </thead>'+
                    '            <tbody>'+
                    '            </tbody>');
                    data.forEach(element => {
                        $('#alunos > table > tbody').append(
                        '<tr>'+
                        '    <th scope ="row">'+
                                element.inscricao+
                        '    </th>'+
                        '    <td>'+
                                element.municipioNome+
                        '    </td>'+
                        '    <td>'+
                                element.cotaNome+
                        '    </td>'+
                        '    <td>'+
                                element.tempo_servico_dias+
                        '    </td>'+
                        '    <td>'+
                                element.docNome+
                        '    </td>'+
                        '</tr>');
                    });
                    
                }

            })
        }
    }
    $('#turma').on('change', alunos);
    function municipios() {
        var idEstado = $('#estado').val();
        if(idEstado)
        {
            $.ajax({
                url:'/admin/municipios/'+ idEstado,
                type: 'get',
                dataType: 'json',
                beforeSend: function(){
                    $('#municipio').empty();
                },
                success: function(data) {
                    $.each(data, function(key, item) {
                        $('#municipio').append('<option value="'+item.id+'">'+item.nome+'</option>');
                    });
                }

            })
        }
    }
    $('#estado').on('change', municipios);
});