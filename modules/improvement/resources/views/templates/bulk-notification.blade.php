<template id="bulk-notification">
    <div class="x_title">
        <button id="bulk-update" class="btn btn-primary btn-xs"
                data-action="{{ route('points-approvement.bulk-update') }}">Approve
        </button>
        <span>Selected #count# entries from #countAll#</span>
        <div class="clearfix"></div>
    </div>
</template>