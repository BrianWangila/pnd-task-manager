import '../calendar/fullcalendar';
import '../calendar/jquery-1.10.2';
import '../calendar/jquery-ui.custom.min';


const calendar = ('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listWeek'
        },
        defaultDate: '2018-11-16',
        navLinks: true,
        editable: true,
        eventLimit: true,
        events: [{
                title: 'All Day Event',
                start: '2018-11-01'
            },
            {
                title: 'Long Event',
                start: '2018-11-07',
                end: '2018-11-10'
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: '2018-11-09T16:00:00'
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: '2018-11-16T16:00:00'
            },
            {
                title: 'Conference',
                start: '2018-11-11',
                end: '2018-11-13'
            },
            {
                title: 'Meeting',
                start: '2018-11-12T10:30:00',
                end: '2018-11-12T12:30:00'
            },
            {
                title: 'Lunch',
                start: '2018-11-12T12:00:00'
            },
            {
                title: 'Meeting',
                start: '2018-11-12T14:30:00'
            },
            {
                title: 'Happy Hour',
                start: '2018-11-12T17:30:00'
            },
            {
                title: 'Dinner',
                start: '2018-11-12T20:00:00'
            },
            {
                title: 'Birthday Party',
                start: '2018-11-13T07:00:00'
            },
            {
                title: 'Click for Google',
                url: 'https://google.com/',
                start: '2018-11-28'
            }
        ]
    });



export default calendar