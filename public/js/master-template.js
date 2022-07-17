((aside) => {
	if (aside) {
		var list = document.querySelectorAll('.master-aside-menus > li');
		if (list) {
			var toggle = document.querySelector('.aside-toggle');
			if (toggle) toggle.addEventListener('click', () => {
				document.querySelector('.master-aside').classList.toggle('close');
			});
			//
			Object.values(list).forEach((item) => {
				//
				var active_item = item.querySelector(".active ul");
				if (active_item) active_item.setAttribute('style', `height:${active_item.scrollHeight}px!important`);

				//
				item.addEventListener('click', () => {
					Object.values(list).forEach((init) => {
						init.classList.remove('open');
						init.classList.remove('active');
						//
						var init_next_tab = init.querySelector("ul");
						if (init_next_tab) {
							init_next_tab.removeAttribute('style');
						}
					});
					item.classList.toggle('open');
					var next_tab = item.querySelector("ul");
					if (next_tab) {
						next_tab.setAttribute('style', `height:${next_tab.scrollHeight}px!important`);
					}
				});
			});
		}
	}
})(document.querySelector('.master-aside'));



(() => {
	var ps = new PerfectScrollbar('#scrollbar');
	var container = window.document.querySelector("#scrollbar");
	if (container) {
		Object.values(container.querySelectorAll('li')).forEach((el) => {
			el.querySelector('a').addEventListener('click', function () {
				ps.update();
			});
		})
	}
})();

// 
(() => {
	window.addEventListener('load', () => {
		var dropdown_item = document.querySelectorAll('a.dropdown-item');
		if (dropdown_item) Object.values(dropdown_item).forEach(item => {
			item.addEventListener('click', () => {
				var url = item.getAttribute('href');
				if (url) window.location.href = url;
			});
		});
	});
})();





