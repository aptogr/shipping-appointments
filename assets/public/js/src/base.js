(function ($) {
    'use strict';

    var excludedDatesSelected = new Array();
    var excludedDatesSelectedTemp = new Array();



    $(document).ready(function(){

        // console.log('public script loaded');

        var excludedDatesSelectedInput = $('#excluded_dates').val();

        if (excludedDatesSelectedInput.length > 0) {
            excludedDatesSelected = excludedDatesSelectedInput.split(",");
        }

        console.log(excludedDatesSelectedInput);

        $('input.timepicker').timepicker({
            timeFormat: 'HH:mm',
            // scrollbar: true,
            change: timeChange
        });

        //

        if ($('.calendar').data('disabledates')) {
            var disabledatesHTML = $('.calendar').data('disabledates');
            var disabledatesHTML = disabledatesHTML.split(",");
        }


        // console.log('disabledates from html',disabledatesHTML);


        if ($('.calendar').data('scheduledates')) {
            var scheduledatesHTML = $('.calendar').data('scheduledates');
            var scheduledatesHTML = scheduledatesHTML.split(",");
        }


        // console.log(scheduledatesHTML);



        var disabledWeekdaysHTML = $('.calendar').attr('data-disabledweekdays')

        if (!disabledWeekdaysHTML) {
            var disabledWeekdaysHTML = "-1";
        }

        var disabledWeekdaysHTML = disabledWeekdaysHTML.split(",").map(Number);
        // console.log(disabledWeekdaysHTML);


        var schedules = [];

        scheduledatesHTML.forEach(function(entry) {

            var namedate = entry.split("/");
            var namedate = {
                name: namedate[0],
                date: namedate[1]
            }

            schedules.push(namedate);

        });

        var schedules = schedules.sort((a, b) => (a.date > b.date) ? 1 : -1)

        // console.log(schedules);


        $('.calendar').pignoseCalendar({
            week: 1,
            format:             'YYYY-MM-DD',
            schedules:          schedules,
            disabledDates:      disabledatesHTML,
            disabledWeekdays:   disabledWeekdaysHTML,

            init: function(context) {

                Object.keys(schedules).forEach(function(key) {

                    var daName = schedules[key].name;
                    var daDate = schedules[key].date;

                    $('#scheduleList').append('<div class="schedule schedule-' + key + '" data-eventdate="' + daDate + '">' + daName + ' / ' + daDate + '</div>')
                    $('[data-date='+daDate+']').find('a').css('border','1px solid');
                    $('[data-date='+daDate+']').find('a').css('border-color','#059100');

                });
            },

            select: function(date, context) {

                if (context.storage.schedules.length > 0) {

                    console.log('Events for this date: ', context.storage.schedules[0].name);
                    $('.schedule').css('background-color','#fff')
                    $('[data-eventdate='+context.storage.schedules[0].date+']').css('background-color','#059100');

                }

            },

            click: function(event, context) {

                var that = $(this);
                var date = that[0].dataset.date;
                event.preventDefault();


                if (excludedDatesSelected.indexOf(date) === -1) {

                    excludedDatesSelected.push(date);
                    console.log(excludedDatesSelected);
                    $('#excluded_dates').val(excludedDatesSelected);
                    var dateDiv = "<div class='exludeDaysBox' data-selecteddate='"+ date +"'>" + date + " <div class='selectedDateDelete' data-selecteddate='"+ date +"' >x</div></div>";
                    $('#excludedDatesDiv').append(dateDiv)

                } else {
                    console.log("This date already exists");
                    // excludedDatesSelectedTemp = excludedDatesSelected.filter(function(x){
                    //     return x !== date;
                    // });
                    //
                    // excludedDatesSelected = excludedDatesSelectedTemp;
                    //
                    // $('#excluded_dates').val(excludedDatesSelected);
                    // $('*[data-selecteddate='+date+']').remove();
                }

            }

        });




        $( "#excludedDatesDiv" ).on( "click", ".selectedDateDelete", function() {


            var that = $(this);

            var date = that.parent().data('selecteddate');

            // console.log(date);

            excludedDatesSelectedTemp = [];

            excludedDatesSelectedTemp = excludedDatesSelected.filter(function(x){
                return x !== date;
            });

            excludedDatesSelected = excludedDatesSelectedTemp;
            $('#excluded_dates').val(excludedDatesSelected);
            that.parent().remove();



        });

        // $( ".weekDay" ).change(function() {
        //
        //     var that = $(this),
        //         timediv = "#" + that.data('timediv');
        //     // timedivov = "#" + that.data('timediv') + "_ov";
        //
        //
        //     if(that.is(":checked")){
        //         $(timediv).addClass('display-block')
        //         // $(timedivov).addClass('display-block')
        //     }
        //     else if(that.is(":not(:checked)")){
        //         $(timediv).removeClass('display-block')
        //         // $(timedivov).removeClass('active')
        //     }
        //
        // });


        function timeChange() {
            var that = $(this)
            that.attr('value', that.val())
            // console.log(that.val());
        }

        $( ".dayBox" ).on( "click",function() {
            var  that = $(this);

            if (that.find('.weekDay').prop("checked")) {

                that.find('.weekDay').attr('checked', false)
                that.parent().find('.timeFromTo').removeClass('display-block')

            } else {

                that.find('.weekDay').attr('checked', true);
                that.parent().find('.timeFromTo').addClass('display-block')

            }

        })

        // $( ".timeFromTo" ).on( "submit", ".timeSelect", function() {
        //
        //     var that = $(this);
        //     var id = that.attr('id');
        //
        //
        //
        //     // console.log(that.val());
        //     // console.log(id);
        //
        //     // $('.'+id+'_ov').find('span').html(that.val())
        // })

    });

})( jQuery );