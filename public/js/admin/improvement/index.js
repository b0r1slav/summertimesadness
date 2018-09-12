(function () {

    /**
     * Render DataTable
     */
    $('#evaluations-users').DataTable({
        serverSide: true,
        responsive: true,
        ajax: window.location.href + '/data',
        columnDefs: [
            { "width": "5%", "targets": 3 }
        ],
        columns: [
            {title: 'id', data: 'id', visible: false},
            {title: 'Username', data: 'name', name: 'name'},
            {title: 'Email', data: 'email', name: 'email'},
            {title: 'Action', data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

})();