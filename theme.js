// Printer functions
// Supports the UAGB blocks specifically
addEventListener("beforeprint", (event) => { Array.from(document.getElementsByClassName('wp-block-uagb-tabs')).forEach(tabset => {
	Array.from(tabset.getElementsByClassName('uagb-tab')).forEach(tab => {
			const a = tab.getElementsByTagName('a')[0]
			const tab_id = a.getAttribute("href").replace("#","")
			const label = a.textContent
			try {
				document.querySelector(`[aria-labelledby="${tab_id}"]`).insertAdjacentHTML("afterbegin", `<h2 class="print_label">${label}</h2>`)
			} catch(e) {
				console.log(e)
			}
		})
	})
})
addEventListener("afterprint", (event) => { Array.from(document.getElementsByClassName('print_label')).forEach(i => i.remove() )})
