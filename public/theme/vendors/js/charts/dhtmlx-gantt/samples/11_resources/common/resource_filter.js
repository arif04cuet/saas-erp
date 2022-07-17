(function(){
	function setupResourceFilter(gantt) {
		gantt.attachEvent("onGanttReady", function(){
			var resourcesStore = gantt.getDatastore(gantt.config.resource_store);

			var filterValue;
			function selectResource() {
				var node = this;
				filterValue = node.value;
				resourcesStore.refresh();
			}

			resourcesStore.attachEvent("onFilterItem", function(id, item) {
				if (filterValue) {
					return id == filterValue || resourcesStore.isChildOf(id, filterValue);
				}
				return true;
			});

			function updateSelect(options) {
				var select = gantt.$container.querySelector(".resource-select");
				var html = [];
				html.push("<option value=''>All</option>");
				options.forEach(function(option) {
					html.push("<option value='" + option.id + "'>" + option.text + "</option>");
				});
				select.innerHTML = html.join("");
			}

			resourcesStore.attachEvent("onParse", function() {
				updateSelect(resourcesStore.getItems());
			});

			var select = gantt.$container.querySelector(".resource-select");
			select.onchange = selectResource;

		});
	}

	if(window.Gantt){
		window.Gantt.plugin(setupResourceFilter);
	}else{
		setupResourceFilter(window.gantt);
	}

})();
