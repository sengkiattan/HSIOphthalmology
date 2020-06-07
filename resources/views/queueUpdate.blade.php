<div id="queueUpdatesDiv" class="row mb-3 justify-content-center" v-if="queueUpdates.length > 0">
	<div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="border-bottom: 0px; background-color: transparent;">
                    <div class="row">
                        <div class="col-md-6 text-center" style="display: flex; align-items: center; justify-content: center;">
                            <span>Currently Serving (Clinic No.)</span>
                        </div>
                        <div class="col-md-6 text-center">
                            <span style="font-size: x-large; font-weight: bold; color: #FD6A07">@{{ queueUpdates[0].queue_no }} (@{{ queueUpdates[0].clinic_no }})</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2 col-12" v-if="queueUpdates.length > 1">
        <div class="col-4" v-for="(update, index) in queueUpdates" v-if="index">
            <div class="card">
                <div class="card-header" style="border-bottom: 0px; background-color: transparent;">
                    <div class="row">
                        <div class="col text-center">
                            <span>@{{ update.queue_no }} (@{{ update.clinic_no }})</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.queueUpdates = @json($queueUpdates);
</script>