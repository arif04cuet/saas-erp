/* Gantt chart
---------------------------
    - Following - Baseline Src : https://docs.dhtmlx.com/gantt/samples/04_customization/15_baselines.html
    - Following - TaskLayer Src : https://dhtmlx.com/docs/products/dhtmlxGantt/02_features.html
    - Following - Custom Style Src : https://dhtmlx.com/docs/products/dhtmlxGantt/common/customstyles.css

    - Variables
        - let nodeName = "GanttChartDIV";
        - let chartData = {
            "data": [],
            "links": []
        };

*/

var GanttChartCustomCSSUrl = window.location.protocol + window.location.host + '/theme/css/plugins/dhtmlx-gantt/chart-pro.css';

$(window).on("load", function () {
    gantt.config.readonly = true;

    gantt.config.scale_unit = "week";
    gantt.config.xml_date = "%Y-%m-%d %H:%i:%s";
    gantt.config.task_height = 12;
    gantt.config.row_height = 35;

    // adding baseline display
    gantt.addTaskLayer(function draw_planned(task) {
        if (task.planned_start && task.planned_end) {
            var sizes = gantt.getTaskPosition(task, task.planned_start, task.planned_end);
            var el = document.createElement('div');
            el.className = 'baseline';
            el.style.left = sizes.left + 'px';
            el.style.width = sizes.width + 'px';
            el.style.top = sizes.top + gantt.config.task_height + 13 + 'px';
            el.setAttribute('title', gantt.templates.task_date(task.planned_end));

            return el;
        }
        return false;
    });

    gantt.templates.task_class = function (start, end, task) {
        if (task.planned_end) {
            var classes = ['has-baseline'];
            if (end.getTime() > task.planned_end.getTime()) {
                classes.push('overdue');
            }
            return classes.join(' ');
        }
    };

    gantt.templates.rightside_text = function (start, end, task) {
        if (task.planned_end) {
            if (end.getTime() > task.planned_end.getTime()) {
                var overdue = Math.ceil(Math.abs((end.getTime() - task.planned_end.getTime()) / (24 * 60 * 60 * 1000)));
                var text = "<b>Overdue: " + overdue + " days</b>";
                return text;
            }
        }
    };

    gantt.config.columns = [
        {
            name: "text",
            label: "Task name",
            width: "*"
        },
        {
            name: "start_date",
            label: "Start time",
            align: "center"
        },
        {
            name: "duration",
            label: "Duration",
            align: "center"
        },
    ];


    gantt.attachEvent("onTaskLoading", function (task) {
        task.planned_start = gantt.date.parseDate(task.planned_start, "xml_date");
        task.planned_end = gantt.date.parseDate(task.planned_end, "xml_date");
        return true;
    });

    gantt.init(nodeName);
    gantt.parse(chartData);
    zoomTasks("year");

});

function exportGantt(mode) {
    if (mode == "png")
        gantt.exportToPNG({
            header: `<link rel="stylesheet" href="${GanttChartCustomCSSUrl}" type="text/css">`,
            raw:true
        });
    else if (mode == "pdf")
        gantt.exportToPDF({
            header: `<link rel="stylesheet" href="${GanttChartCustomCSSUrl}" type="text/css">`,
            raw:true
        });
}

function zoomTasks(scale){
    console.log(scale);
    switch(scale){
        case "hours":
            gantt.config.scale_unit = "day";
            gantt.config.date_scale = "%d %M";

            gantt.config.scale_height = 60;
            gantt.config.min_column_width = 30;
            gantt.config.subscales = [
                {unit:"hour", step:1, date:"%H"}
            ];
            break;
        case "day":
            gantt.config.min_column_width = 70;
            gantt.config.scale_unit = "day";
            gantt.config.date_scale = "%d %M";
            gantt.config.subscales = [ ];
            gantt.config.scale_height = 35;
            break;
        case "week":
            gantt.config.min_column_width = 70;
            gantt.config.scale_unit = "week";
            gantt.config.date_scale = "Week %W";
            gantt.config.subscales = [
                {unit:"day", step:1, date:"%D"}
            ];
            gantt.config.scale_height = 60;
            break;
        case "month":
            gantt.config.min_column_width = 70;
            gantt.config.scale_unit = "month";
            gantt.config.date_scale = "%M";
            gantt.config.scale_height = 60;
            gantt.config.subscales = [
                {unit:"week", step:1, date:"%W"}
            ];
            break;
        case "year":
            gantt.config.min_column_width = 70;
            gantt.config.scale_unit = "year";
            gantt.config.date_scale = "%Y";
            gantt.config.scale_height = 60;
            gantt.config.subscales = [
                {unit:"month", step:1, date:"%M"}
            ];
            break;
    }

    gantt.render();
}

