/* Gantt chart
---------------------------
    - Following Src : https://dhtmlx.com/docs/products/dhtmlxGantt/07_export.html

    - Variables
        - let nodeName
        - let chardData

*/
$(window).on("load", function () {

    gantt.config.readonly = true;

    gantt.init(nodeName);

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
            name: "progress",
            label: "Progress",
            align: "center",
        }
    ];

    gantt.parse(chartData);


});

function exportGantt(mode){
    if (mode == "png")
        gantt.exportToPNG({
            header:'<link rel="stylesheet" href="//dhtmlx.com/docs/products/dhtmlxGantt/common/customstyles.css" type="text/css">'
        });
    else if (mode == "pdf")
        gantt.exportToPDF({
            header:'<link rel="stylesheet" href="//dhtmlx.com/docs/products/dhtmlxGantt/common/customstyles.css" type="text/css">'
        });
}
