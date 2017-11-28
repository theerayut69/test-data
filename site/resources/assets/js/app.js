
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

! function($) {
    "use strict";

    function sideNavToggle() {
        $(".side-nav-toggle").on("click", function(e) {
            $(".app").toggleClass("is-collapsed"), e.preventDefault()
        })
    }

    function submitForm() {
        $('#formSubmit').on('click', function(){
            var home_team = $('#home_team').val();
            var away_team = $('#away_team').val();
            if (home_team != away_team) {
                $('#form-fixture').submit();
            }else{
                alert('Sorry, home team is not equal to away team.');
            }
        });
    }

    function changeLeague() {
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
    }

    function changeFixtureLeague() {
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
    }

    function init() {
        sideNavToggle() ,
        submitForm() ,
        changeLeague() ,
        changeFixtureLeague() 
    }
    init()
}(jQuery);
