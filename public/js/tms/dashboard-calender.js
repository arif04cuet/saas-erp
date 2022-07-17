class DashboardCalender {

    constructor(elementId, events, resources, resourceColumns) {
        this.element = document.getElementById(elementId);
        this.events = events;
        this.resources = resources;
        this.resourceColumns = resourceColumns;
    }

    init() {
        let classRef = this;
        let calendar = new FullCalendar.Calendar(this.element, {
            plugins: ['resourceTimeline', 'interaction'],
            header: {
                left: 'prevButton,nextButton',
                center: 'title',
                right: 'today'
            },
            views:
                {
                    Year: {
                        type: 'resourceTimeline',
                        slotDuration: {months: 1},
                        slotWidth: '80%',
                        labelText: 'Year',
                        visibleRange: function (currentDate) {
                            let year = currentDate.getFullYear();
                            let month = currentDate.getMonth();
                            let date = currentDate.getDate();
                            if (month + 1 > 6) year += 1; // month is  0 - 11
                            let startDate = new Date(year - 1, '06', '01');
                            let endDate = new Date(year, '05', '31');
                            return {start: startDate, end: endDate};
                        }
                    }
                },
            customButtons: {
                nextButton: {
                    icon: 'chevron-right',
                    click: function () {
                        calendar.incrementDate({
                            years: 1,
                            months: 1
                        });
                    }
                },
                prevButton: {
                    icon: 'chevron-left',
                    click: function () {
                        calendar.prev();
                    }
                }
            },
            aspectRatio: 1.6,
            defaultView: 'Year',
            contentHeight: "auto",
            resourceAreaWidth: '30%',
            resourceColumns: this.resourceColumns,
            resources: this.resources,
            events: this.events,
            eventTextColor: 'white',
            eventRender: function (info) {
                let hoverContent;
                try {
                    hoverContent = classRef.getHoverContent(info.event);
                } catch (e) {
                    hoverContent = "";
                }
                $(info.el).popover({
                    title: 'Training Calendar',
                    content: hoverContent,
                    placement: 'top',
                    trigger: 'hover',
                    container: 'body',
                    html: true
                });
            },
        });
        calendar.render();
    }

    getHoverContent(event) {
        return `
         <strong>Title:</strong> ${event.title} </br>
        <strong>Start:</strong> ${event.start.toLocaleString()} </br>
        <strong>End:</strong> ${event.end.toLocaleString()} </br>
        <strong>Trainee:</strong> ${event.extendedProps.no_of_trainee} </br>
        <strong>Level:</strong> ${event.extendedProps.level} </br>
        <strong>Sponsor:</strong> ${event.extendedProps.sponsor}`;
    }
}
