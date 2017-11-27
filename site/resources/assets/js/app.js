
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


window.$ = window.jQuery = require('jquery');

require('./bootstrap');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));

// const app = new Vue({
//     el: '#app'
// });

$(function () {
    $('#datetimepicker1').datetimepicker({
        defaultDate: moment(),
        useCurrent: false
    });
});

$('#league_id').on('change', function(e){
    var league_id = e.target.value;
    $.get('/ajax-team?league_id=' + league_id, function(data){
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
    $.get('/ajax-fixture/' + league_id, function(data){
        console.log(data);
        $('#home_team').empty();
        $('#away_team').empty();
        $.each(data.homeTeams, function(index, team){
            $('#home_team').append('<option value="'+team.id+'">'+team.name+'</option>');
        });
        $.each(data.awayTeams, function(index, team){
            $('#away_team').append('<option value="'+team.id+'">'+team.name+'</option>');
        });
    });
});

// $('#home_team').on('change', function(e){
//     var team_id = e.target.value;
//         $.get('/ajax-change-home-team?team_id=' + team_id, function(data){
//             console.log(data);
//             $('#away_team').empty();
//             $.each(data, function(index, team){
//                 $('#away_team').append('<option value="'+team.id+'">'+team.name+'</option>');
//             });
//         });
// });

(function() {
    'use strict';
  
    // window.addEventListener('load', function() {
    //   var form = document.getElementById('form-fixture');
    //   console.log(form.team);
    //   return false;
    //   form.addEventListener('submit', function(event) {
    //       console.log(form);
    //       return false;
    //     if (form.checkValidity() === false) {
    //       event.preventDefault();
    //       event.stopPropagation();
    //     }
    //     form.classList.add('was-validated');
    //   }, false);
    // }, false);

    $("#form-fixture").validate({
        rules: {
            home_team: { notEqual: true },
            away_team: { notEqual: true },
        },
        // submitHandler: function(form) {
        //   // some other code
        //   // maybe disabling submit button
        //   // then:
        //   $(form).submit();
        // }
    });


    jQuery.validator.addMethod("notEqual", function(value, element, param) {
        return this.optional(element) || value != param;
        return $('#home_team').val() != $('#away_team').val()
    }, "Please specify a different (non-default) value");

  })();
