$(function () {
    $('#datetimepicker1').datetimepicker();
});

$('#league_id').on('change', function(e){
    // console.log(e);
    var league_id = e.target.value;

    $.get('/ajax-team?league_id=' + league_id, function(data){
        // console.log(data);
        $('#team_id').prop('disabled', false);
        $('#team_id').empty();
        $.each(data, function(index, teamObj){
            $('#team_id').append('<option value="'+teamObj.id+'">'+teamObj.name+'</option>');
        });
    });
});

$('#fixture_league_id').on('change', function(e){
    console.log(e);
    var league_id = e.target.value;

    $.get('/ajax-team?league_id=' + league_id, function(data){
        console.log(data);
        $('#home_team').empty();
        $('#away_team').empty();
        $.each(data, function(index, teamObj){
            $('#home_team').append('<option value="'+teamObj.id+'">'+teamObj.name+'</option>');
            $('#away_team').append('<option value="'+teamObj.id+'">'+teamObj.name+'</option>');
        });
    });
});