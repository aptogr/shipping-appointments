(function ($) {
    'use strict';

    var excludedDatesSelected = new Array();
    var excludedDatesSelectedTemp = new Array();

    $(document).ready(function(){

        console.log('public script loaded');

        $('input.timepicker').timepicker({
            timeFormat: 'HH:mm',
            // scrollbar: true,
            change: timeChange
        });

        //

        var disabledatesHTML = $('.calendar').data('disabledates');
        var disabledatesHTML = disabledatesHTML.split(",");

        // console.log('disabledates from html',disabledatesHTML);



        var scheduledatesHTML = $('.calendar').data('scheduledates');
        var scheduledatesHTML = scheduledatesHTML.split(",");

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

                } else {

                    $('.schedule').css('background-color','#fff')
                    console.log('No Events');

                }

            },

            click: function(event, context) {

                var that = $(this);
                event.preventDefault();

                if (!that.hasClass("pignose-calendar-unit-disabled")) {

                    // console.log(that);

                    var date = that[0].dataset.date;

                    if (that.find('a').hasClass("dateSelected")) {

                        that.find('a').removeClass('dateSelected');

                        // var index = excludedDatesSelected.indexOf(date);
                        // if (index !== -1) {
                        //     excludedDatesSelected.splice(index, 1);
                        // }


                        excludedDatesSelectedTemp = excludedDatesSelected.filter(function(x){
                            return x !== date;
                        });

                        excludedDatesSelected = excludedDatesSelectedTemp;

                        $('#excluded_dates').val(excludedDatesSelected);
                        $('*[data-selecteddate='+date+']').remove();

                    } else {

                        that.find('a').addClass('dateSelected');
                        excludedDatesSelected.push(date);
                        $('#excluded_dates').val(excludedDatesSelected);

                        var dateDiv = "<div data-selecteddate='"+ date +"'>" + date + " <div class='selectedDateDelete' data-selecteddate='"+ date +"' >x</div></div>";

                        $('#excludedDatesDiv').append(dateDiv)

                    }

                }

            }


        });



        $( "#excludedDatesDiv" ).on( "click", ".selectedDateDelete", function() {


            var that = $(this);

            date = that.parent().data('selecteddate');

            excludedDatesSelectedTemp = [];

            excludedDatesSelectedTemp = excludedDatesSelected.filter(function(x){
                return x !== date;
            });

            excludedDatesSelected = excludedDatesSelectedTemp;
            $('#excluded_dates').val(excludedDatesSelected);
            that.parent().remove();

            console.log(date);

        });

        $( ".weekDay" ).change(function() {

            var that = $(this),
                timediv = "#" + that.data('timediv');
            // timedivov = "#" + that.data('timediv') + "_ov";

            // console.log()

            if(that.is(":checked")){
                $(timediv).addClass('display-block')
                // $(timedivov).addClass('display-block')
            }
            else if(that.is(":not(:checked)")){
                $(timediv).removeClass('display-block')
                // $(timedivov).removeClass('active')
            }

        });


        function timeChange() {
            var that = $(this);
            var id = that.attr('id');

            console.log(that.val());
            console.log(id);
        }

        $( ".timeFromTo" ).on( "submit", ".timeSelect", function() {

            var that = $(this);
            var id = that.attr('id');

            console.log(that.val());
            console.log(id);

            $('.'+id+'_ov').find('span').html(that.val())
        })

    });

})( jQuery );


