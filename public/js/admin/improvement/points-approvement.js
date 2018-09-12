(function () {

    //get user token
    const _token = $('meta[name=csrf-token]').attr('content');

    /**
     * Render DataTable
     */
    const pointsApprovement = $('#points-approvement').DataTable({
        serverSide: true,
        ajax: window.location.href + '/data',
        columnDefs: [
            {"width": "5%", "targets": [1, 4, 6]},
            {"width": "10%", "targets": 5}
        ],
        columns: [
            {title: 'id', data: 'id', visible: false},
            {
                title: bulkCheckbox(),
                data: 'checkbox',
                name: 'checkbox',
                orderable: false,
                searchable: false
            },
            {title: 'user', data: 'name', name: 'name'},
            {title: 'evaluation', data: 'title', name: 'title'},
            {title: 'points', data: 'points', name: 'points'},
            {title: 'date', data: 'created_at', name: 'created_at'},
            {title: 'action', data: 'action', name: 'action', orderable: false, searchable: false}
        ]

    });

    //attach event to DataTable
    pointsApprovement.on('draw.dt', function () {

        //get currnet rows count
        let rowsCount = pointsApprovement.rows().count();

        cleanBulk();

        //approve or refuse points approvement
        $('form.approve-points, form.refuse-points').off().on('submit', function (e) {
            e.preventDefault();

            Promise.resolve({form: this})
                .then(getInputs)
                .then(saveResource)
                .then(reloadDataTable.bind(null, pointsApprovement, rowsCount))
                .then(getPointsApprovementCount);
        });

        //selects all points approvement on the page
        $('#bulk-checkbox').off().on('click', function () {

            if ($(this).is(':checked') && rowsCount > 0) {

                selectPageEntries(rowsCount);

            } else {
                cleanBulk();
            }
        });

    });

    /**
     *
     * @param resource
     * @returns the data when user select all points approvement
     */
    function allEntriesData(resource) {

        return {
            data: {
                _token: _token,
                bulkIds: ['all'],
                bulkValues: {all: 'all'},
                bulkLength: resource.countAll
            },
            form: {
                action: resource.action
            }
        };
    }


    //get the template of the custom checkbox
    function bulkCheckbox() {

        return $('#checkbox').html();
    }


    /**
     *
     * @param countAll - all records in the DataTable
     */
    function bulkUpdate(countAll) {

        $('#bulk-update').off().on('click', function () {
            let rows = $("input.points-approvement-checkbox:not(:checked)");

            Promise.resolve({action: this.dataset.action, countAll: countAll})
                .then(getBulkData)
                .then(saveResource)
                .then(reloadDataTable.bind(null, pointsApprovement, rows.length + 1))
                .then(getPointsApprovementCount);
        });

    }

    function cleanBulk() {

        $('#bulk-checkbox').prop('checked', false);
        $('.points-approvement-checkbox').prop('checked', false);
        $('div.x_title').remove();

    }

    function getBulkData(resource) {

        if (resource.countAll) {

            return allEntriesData(resource)

        }

        return pageEntriesData(resource);
    }


    //get all selected points approvement
    function pageEntriesData(resource) {

        let evaluations = {};
        let bulkIds = [];

        $('input.points-approvement-checkbox:checked').each(function (index, checkbox) {

            let sptv = checkbox.value.split('|');

            bulkIds.push(checkbox.id);

            if (evaluations.hasOwnProperty(sptv[0])) {
                evaluations[sptv[0]] += Number(sptv[1]);
            } else {
                evaluations[sptv[0]] = Number(sptv[1]);
            }
        });

        let inputData = {
            _token: _token,
            bulkIds: bulkIds,
            bulkValues: evaluations,
            bulkLength: bulkIds.length
        };

        return {data: inputData, form: {action: resource.action}};
    }


    /**
     * select points approvement
     * and shows notification and button to approve it
     *
     * @param rowsCount
     */
    function selectPageEntries(rowsCount) {

        let template = $('#bulk-notification').html();
        let countAll = pointsApprovement.page.info().recordsTotal;
        let templateKeys = {
            '#count#': rowsCount,
            '#countAll#': countAll
        };

        $('.points-approvement-checkbox').prop('checked', true);

        $('#notifications').after(template.allReplace(templateKeys));

        //add button to select all points approvement
        if (rowsCount < countAll) {
            $('#bulk-update + span').after(' <a id="select-all" href="javascript:">Select all</a>');
        }

        $('a#select-all').off().on('click', function () {

            selectAllEntries(template, countAll);

        });

        bulkUpdate();

    }

    function selectAllEntries(template, countAll) {

        let templateKeys = {
            '#count#': countAll,
            '#countAll#': countAll
        };

        $('div.x_title').remove();

        $('#notifications').after(template.allReplace(templateKeys));

        bulkUpdate(countAll);

    }

})();