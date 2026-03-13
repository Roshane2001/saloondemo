<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />

<div class="row calender widget-shadow" style="margin-top: 20px;">
    <h3 class="title1" style="padding: 10px 15px;">Appointments Calendar</h3>
    <div class="mt-3" style="padding: 15px;">
        <div id="calendar"></div>
    </div>
</div>

<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        events: 'fetch-appointments.php' // 🔄 Dynamic endpoint
    });
    calendar.render();
});
</script>