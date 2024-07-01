window.addEventListener('DOMContentLoaded', event => {
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

document.addEventListener('DOMContentLoaded', function () {
	var sortables = document.querySelectorAll('.sortable');
	var i = 0;
	sortables.forEach(function (sortable) {
		Sortable.create(sortable, {
			group: 'shared',
			animation: 150,
			onEnd: function (evt) {
				var ids = [];
				var tasks = document.querySelectorAll('#'+ evt.to.id + ' .card');
				tasks.forEach(function(task){
					ids.push(task.id.replace("id_",""));
				});
				var sequence = ids.join(",");
				$.ajax({
					url: "update_status.php",
					type: "POST",
					dataType: "json",
					data: {"id": evt.item.id.replace("id_",""), "status": evt.to.id, "sequence": sequence},
					success: function(data){
						
					}
				});
			}
		});
	});
});