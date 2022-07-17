class HostelCalender {
    constructor(calenderElement) {
        this.calenderEl = calenderElement;

    }

    reInitCalender(resources, events, resourceColumns) {
        this.calender = new FullCalendar.Calendar(this.calenderEl, {
            plugins: ['resourceTimeline', 'interaction'],
            header: {
                left: 'today prev,next',
                center: 'title',
                right: 'resourceTimelineDay,resourceTimelineWeek,resourceTimelineMonth'
            },
            aspectRatio: 1.5,
            defaultView: 'resourceTimelineMonth',
            resourceAreaWidth: '40%',
            resourceColumns: resourceColumns,
            displayEventTime: false,
            resources: resources,
            contentHeight: "auto",
            eventRender: function (info) {
                var checkin = "<strong>" + info.event.extendedProps.status_checkin + ": </strong>" + info.event.start.toLocaleDateString();
                var checkout = "";
                if (info.event.end !== null) {
                    checkout += "<strong> " + info.event.extendedProps.status_checkout + ": </strong>" + info.event.end.toLocaleDateString();
                }
                $(info.el).popover({
                    title: 'Hostel Booking',
                    content: checkin + "<br />" + checkout,
                    placement: 'top',
                    trigger: 'hover',
                    container: 'body',
                    html: true
                });
            },
            events: events,
            eventColor: 'green',
            eventTextColor: 'white',
        });

        this.renderCalender();
    }

    renderCalender() {
        this.calender.render();
    }

    destroyCalender() {
        $(this.calenderEl).html('');
    }


}
