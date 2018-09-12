(function () {

    function createItem(form, rules, tableInit) {

        Promise.resolve({form: form, rules: rules()})
            .then(getInputs)
            .then(validate)
            .then(saveResource)
            .then(reloadDataTable.bind(null, tableInit))
            .catch(function (errors) {
                displayErrors(errors, form)
            });

    }


    function updateItem(input, rules) {

        let validationRules = rules();
        let inputRules = {};
        inputRules[input.name] = validationRules[input.name];

        Promise.resolve({input: input, rules: inputRules})
            .then(getInput)
            .then(validate)
            .then(updateSingleResource)
            .catch(function (errors) {
                displayError(errors, input)
            });
    }


    /**
     * Returns validation rules
     *
     * @returns {object}
     */
    function evaluationRules() {

        return {
            title: 'required|string|min:3|max:191',
            must: 'required|numeric',
            current: 'numeric'
        };
    }


    /**
     * Render Evaluations DataTable
     */
    const userEvaluations = $('#user-evaluations').DataTable({
        serverSide: true,
        ajax: window.location.href + '/data',
        columnDefs: [
            { "width": "5%", "targets": [2,3,4] }
        ],
        columns: [
            {title: 'id', data: 'id', visible: false},
            {title: 'subject title', data: 'title', name: 'title'},
            {title: 'must points', data: 'must', name: 'must'},
            {title: 'current points', data: 'current', name: 'current'},
            {title: 'delete', data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    /**
     * Render Tasks DataTable
     */
    const userTasks = $('#user-tasks').DataTable({
        serverSide: true,
        ajax: tasksUrl('data'),
        columnDefs: [
            { "width": "5%", "targets": [2,3] }
        ],
        columns: [
            {title: 'id', data: 'id', visible: false},
            {title: 'task name', data: 'name', name: 'name'},
            {title: 'active', data: 'is_active', name: 'is_active', searchable: false},
            {title: 'delete', data: 'delete', name: 'delete', orderable: false, searchable: false}
        ]
    });


    //create new evaluation
    $('form[id=add-evaluation]').off().on('submit', function (e) {
        e.preventDefault();

        createItem(this, evaluationRules, userEvaluations);

    });


    //create new task
    $('form[id=add-task]').off().on('submit', function (e) {
        e.preventDefault();

        createItem(this, taskRules, userTasks)

    });


    //attach event to DataTable
    userEvaluations.on('draw.dt', function () {

        //update evaluation
        $('input.evaluation').off().on('focusout', function () {

            updateItem(this, evaluationRules);

        });

        //change evaluation status
        $('form.delete-evaluation').off().on('submit', function (e) {
            e.preventDefault();

            let rowsCount = userEvaluations.rows().count();

            Promise.resolve({form: this})
                .then(getInputs)
                .then(saveResource)
                .then(reloadDataTable.bind(null, userEvaluations, rowsCount));
        });
    });


    //attach event to DataTable
    userTasks.on('draw.dt', function () {

        //delete task
        $('form.delete-task').off().on('submit', function (e) {
            e.preventDefault();

            let rowsCount = userTasks.rows().count();

            Promise.resolve({form: this})
                .then(getInputs)
                .then(deleteResource)
                .then(reloadDataTable.bind(null, userTasks, rowsCount))
        });

        //change task status
        $('input.task-status').off().on('change', function () {

            let input = this;
            input.value = changeStatus(input);

            Promise.resolve({input: this})
                .then(getInput)
                .then(updateSingleResource)
        });

        //update task
        $('input.task').off().on('focusout', function () {

            updateItem(this, taskRules);

        });
        
    });


    /**
     * define validation rules
     *
     * @returns {object}
     */
    function taskRules() {

        return {
            name: 'required|string|min:3|max:191'
        };
    }

    function tasksUrl(action) {

        return window.location.href.replace('evaluations', 'tasks') + '/' + action;
    }

})();